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

namespace Konceiver\Inbox\Actions;

use Illuminate\Database\Eloquent\Model;
use Konceiver\Inbox\Models\Thread;

class AddMessageToThread
{
    private Thread $thread;

    public function __construct(Thread $thread)
    {
        $this->thread = $thread;
    }

    public function execute(Model $creator, string $body): void
    {
        $this->thread->messages()->create([
            'creator_id'   => $creator->id,
            'creator_type' => get_class($creator),
            'body'         => $body,
        ]);
    }
}
