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

use Konceiver\Inbox\Models\Message;
use Konceiver\Inbox\Models\Participant;
use Konceiver\Inbox\Models\Thread;

return [

    'models' => [

        'thread' => Thread::class,

        'message' => Message::class,

        'participant' => Participant::class,

    ],

    'tables' => [

        'threads' => 'threads',

        'messages' => 'messages',

        'participants' => 'participants',

    ],

];
