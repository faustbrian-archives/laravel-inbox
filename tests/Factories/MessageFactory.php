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

use Facades\KodeKeep\Inbox\Tests\Factories\ThreadFactory;
use Facades\KodeKeep\Inbox\Tests\Factories\UserFactory;
use Faker\Generator;
use KodeKeep\Fabrik\Factory;
use KodeKeep\Inbox\Models\Message;
use KodeKeep\Inbox\Models\Thread;
use KodeKeep\Inbox\Tests\Unit\ClassThatHasInbox;

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
