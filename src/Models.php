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

namespace KodeKeep\Inbox;

use Illuminate\Support\Facades\Config;

class Models
{
    public static function getThreadModel(): string
    {
        return Config::get('inbox.models.thread');
    }

    public static function getMessageModel(): string
    {
        return Config::get('inbox.models.message');
    }

    public static function getParticipantModel(): string
    {
        return Config::get('inbox.models.participant');
    }

    public static function getThreadsTable(): string
    {
        return Config::get('inbox.tables.threads');
    }

    public static function getMessagesTable(): string
    {
        return Config::get('inbox.tables.messages');
    }

    public static function getParticipantsTable(): string
    {
        return Config::get('inbox.tables.participants');
    }
}
