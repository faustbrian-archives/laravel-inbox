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

namespace Konceiver\Inbox\Tests\Factories;

use Faker\Generator;
use Konceiver\Fabrik\Factory;
use Konceiver\Inbox\Models\Thread;

class ThreadFactory extends Factory
{
    protected string $modelClass = Thread::class;

    public function getData(Generator $generator): array
    {
        return [
            'subject' => $generator->word,
        ];
    }
}
