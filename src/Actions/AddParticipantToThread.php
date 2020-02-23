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

namespace KodeKeep\Inbox\Actions;

use Illuminate\Database\Eloquent\Model;
use KodeKeep\Inbox\Models\Thread;

class AddParticipantToThread
{
    private Thread $thread;

    public function __construct(Thread $thread)
    {
        $this->thread = $thread;
    }

    public function execute(Model $participant): void
    {
        $this->thread->participants()->create([
            'model_id'   => $participant->id,
            'model_type' => get_class($participant),
        ]);
    }
}
