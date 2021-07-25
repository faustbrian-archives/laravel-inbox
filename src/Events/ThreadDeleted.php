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

namespace Konceiver\Inbox\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Konceiver\Inbox\Contracts\Thread;

class ThreadDeleted
{
    use Dispatchable;

    public Thread $thread;

    public function __construct(Thread $thread)
    {
        $this->thread = $thread;
    }
}
