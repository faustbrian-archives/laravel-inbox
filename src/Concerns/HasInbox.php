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

namespace Konceiver\Inbox\Concerns;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Konceiver\Inbox\Models;

trait HasInbox
{
    public function messages(): MorphMany
    {
        return $this->morphMany(Models::getMessageModel(), 'creator');
    }

    public function threads(): BelongsToMany
    {
        return $this->belongsToMany(Models::getThreadModel(), 'participants', 'model_id');
    }

    public function threadsWithNewMessages(): array
    {
        $threadsWithNewMessages = [];

        $threads = $this->threads;

        foreach ($threads as $thread) {
            $participant = $thread
                ->participants()
                ->where('model_id', $this->id)
                ->where('model_type', get_class($this))
                ->firstOrFail();

            if ($thread->updated_at > $participant->last_read_at) {
                $threadsWithNewMessages[] = $thread;
            }
        }

        return $threadsWithNewMessages;
    }

    // public function participated()
    // {
    //     //
    // }

    // public function received()
    // {
    //     //
    // }

    // public function sent()
    // {
    //     //
    // }

    // public function unread()
    // {
    //     //
    // }
}
