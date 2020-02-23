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

namespace KodeKeep\Inbox\Tests\Factories;

use Faker\Generator;
use KodeKeep\Fabrik\Factory;
use KodeKeep\Inbox\Tests\Unit\ClassThatHasInbox;

class UserFactory extends Factory
{
    protected string $modelClass = ClassThatHasInbox::class;

    public function getData(Generator $generator): array
    {
        return [
            'name'     => $generator->name,
            'email'    => $generator->safeEmail,
            'password' => $generator->password,
        ];
    }
}
