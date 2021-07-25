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

use Facades\Konceiver\Inbox\Tests\Factories\ThreadFactory;
use Facades\Konceiver\Inbox\Tests\Factories\UserFactory;
use Faker\Generator;
use Konceiver\Fabrik\Factory;
use Konceiver\Inbox\Models\Message;
use Konceiver\Inbox\Models\Thread;
use Konceiver\Inbox\Tests\Unit\ClassThatHasInbox;

class MessageFactory extends Factory
{
    protected string $modelClass = Message::class;

    private ?Thread $thread = null;

    private ?ClassThatHasInbox $creator = null;

    public function getData(Generator $generator): array
    {
        return [
            'thread_id'    => $this->thread ? $this->thread->id : ThreadFactory::create()->id,
            'creator_id'   => $this->creator ? $this->creator->id : UserFactory::create()->id,
            'creator_type' => ClassThatHasInbox::class,
            'body'         => $generator->paragraph,
            'read_at'      => now(),
        ];
    }

    public function thread(Thread $thread): self
    {
        $this->thread = $thread;

        return $this;
    }

    public function creator(ClassThatHasInbox $creator): self
    {
        $this->creator = $creator;

        return $this;
    }
}
