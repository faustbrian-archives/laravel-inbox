<?php

declare(strict_types=1);

/*
 * This file is part of Laravel Inbox.
 *
 * (c) Konceiver <info@konceiver.dev>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Konceiver\Inbox\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Konceiver\Inbox\Contracts\Participant as Contract;
use Konceiver\Inbox\Events\ParticipantCreated;
use Konceiver\Inbox\Events\ParticipantDeleted;
use Konceiver\Inbox\Events\ParticipantUpdated;
use Konceiver\Inbox\Models;

class Participant extends Model implements Contract
{
    use SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $dates = ['last_read_at'];

    protected $dispatchesEvents = [
        'created' => ParticipantCreated::class,
        'updated' => ParticipantDeleted::class,
        'deleted' => ParticipantUpdated::class,
    ];

    public function thread(): BelongsTo
    {
        return $this->belongsTo(Models::getThreadModel());
    }

    public function model(): Morphto
    {
        return $this->morphTo();
    }

    public function getTable(): string
    {
        return Models::getParticipantsTable();
    }
}
