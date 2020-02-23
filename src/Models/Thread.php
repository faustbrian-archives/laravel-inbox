<?php

declare(strict_types=1);

/*
 * This file is part of Laravel Inbox.
 *
 * (c) KodeKeep <hello@kodekeep.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KodeKeep\Inbox\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use KodeKeep\Inbox\Contracts\Thread as Contract;
use KodeKeep\Inbox\Events\ThreadCreated;
use KodeKeep\Inbox\Events\ThreadDeleted;
use KodeKeep\Inbox\Events\ThreadUpdated;
use KodeKeep\Inbox\Models;

class Thread extends Model implements Contract
{
    use SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $dispatchesEvents = [
        'created' => ThreadCreated::class,
        'updated' => ThreadDeleted::class,
        'deleted' => ThreadUpdated::class,
    ];

    public function messages(): HasMany
    {
        return $this->hasMany(Models::getMessageModel());
    }

    public function participants(): HasMany
    {
        return $this->hasMany(Models::getParticipantModel());
    }

    public function creator(): Model
    {
        return $this->messages()->oldest()->first()->creator;
    }

    public function latestMessage(): Message
    {
        return $this->messages()->latest()->first();
    }

    public function scopeForModel($query, $participant)
    {
        $threadsTable      = Models::getThreadsTable();
        $participantsTable = Models::getParticipantsTable();

        return $query
            ->join($participantsTable, 'threads.id', '=', $participantsTable.'.thread_id')
            ->where($participantsTable.'.model_id', $participant->id)
            ->where($participantsTable.'.model_type', get_class($participant))
            ->where($participantsTable.'.deleted_at', null)
            ->select($threadsTable.'.*');
    }

    public function scopeForModelWithNewMessages($query, $participant)
    {
        $threadsTable      = Models::getThreadsTable();
        $participantsTable = Models::getParticipantsTable();

        return $query
            ->join($participantsTable, $threadsTable.'.id', '=', $participantsTable.'.thread_id')
            ->where($participantsTable.'.model_id', $participant->id)
            ->where($participantsTable.'.model_type', get_class($participant))
            ->whereNull($participantsTable.'.deleted_at')
            ->where(fn ($query) => $query
                ->where($threadsTable.'.updated_at', '>', $participantsTable.'.last_read_at')
                ->orWhereNull($participantsTable.'.last_read_at'))
            ->select($threadsTable.'.*');
    }

    public function isUnread(Model $participant): bool
    {
        return $this->updated_at > $this->getParticipant($participant)->last_read_at;
    }

    public function restoreAllParticipants(): void
    {
        $this->participants()->withTrashed()->get()->each->restore();
    }

    public function getParticipant(Model $participant): Participant
    {
        return $this
            ->participants()
            ->where('model_id', $participant->id)
            ->where('model_type', get_class($participant))
            ->firstOrFail();
    }

    public function hasParticipant(Model $participant): bool
    {
        return $this
            ->participants()
            ->where('model_id', '=', $participant->id)
            ->where('model_type', '=', get_class($participant))
            ->count() > 0;
    }

    public function getTable(): string
    {
        return Models::getThreadsTable();
    }
}
