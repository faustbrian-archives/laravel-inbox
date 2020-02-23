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

use KodeKeep\Inbox\Models\Message;
use KodeKeep\Inbox\Models\Participant;
use KodeKeep\Inbox\Models\Thread;

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
