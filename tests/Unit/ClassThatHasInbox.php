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

namespace Konceiver\Inbox\Tests\Unit;

use Illuminate\Foundation\Auth\User as BaseUser;
use Konceiver\Inbox\Concerns\HasInbox;

class ClassThatHasInbox extends BaseUser
{
    use HasInbox;

    public $table = 'users';

    public $guarded = [];
}
