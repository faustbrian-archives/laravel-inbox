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

namespace KodeKeep\Inbox\Events;

use Illuminate\Foundation\Events\Dispatchable;
use KodeKeep\Inbox\Contracts\Thread;

class ThreadCreated
{
    use Dispatchable;

    public Thread $thread;

    public function __construct(Thread $thread)
    {
        $this->thread = $thread;
    }
}
