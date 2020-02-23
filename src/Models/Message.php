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
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use KodeKeep\Inbox\Contracts\Message as Contract;
use KodeKeep\Inbox\Events\MessageCreated;
use KodeKeep\Inbox\Events\MessageDeleted;
use KodeKeep\Inbox\Events\MessageUpdated;
use KodeKeep\Inbox\Models;

class Message extends Model implements Contract
{
    use SoftDeletes;

    protected $touches = ['thread'];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $dispatchesEvents = [
        'created' => MessageCreated::class,
        'updated' => MessageDeleted::class,
        'deleted' => MessageUpdated::class,
    ];

    public function thread(): BelongsTo
    {
        return $this->belongsTo(Models::getThreadModel());
    }

    public function creator(): MorphTo
    {
        return $this->morphTo();
    }

    public function participants(): HasMany
    {
        return $this->hasMany(Models::getParticipantModel(), 'thread_id', 'thread_id');
    }

    public function recipients(): HasMany
    {
        return $this
            ->participants()
            ->where('participant_id', '!=', $this->participant_id)
            ->where('participant_type', '!=', $this->participant_type);
    }

    public function getTable(): string
    {
        return Models::getMessagesTable();
    }
}
