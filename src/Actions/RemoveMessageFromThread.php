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

use Konceiver\Inbox\Contracts\Message;
use Konceiver\Inbox\Models\Thread;

class RemoveMessageFromThread
{
    private Thread $thread;

    public function __construct(Thread $thread)
    {
        $this->thread = $thread;
    }

    public function execute(Message $message): void
    {
        $this->thread->messages()->findOrFail($message->id)->delete();
    }
}
