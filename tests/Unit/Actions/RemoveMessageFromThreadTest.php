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

namespace Konceiver\Inbox\Tests\Unit\Actions;

use Facades\Konceiver\Inbox\Tests\Factories\MessageFactory;
use Facades\Konceiver\Inbox\Tests\Factories\ThreadFactory;
use Konceiver\Inbox\Actions\RemoveMessageFromThread;
use Konceiver\Inbox\Tests\TestCase;

/**
 * @covers \Konceiver\Inbox\Actions\RemoveMessageFromThread
 */
class RemoveMessageFromThreadTest extends TestCase
{
    /** @test */
    public function it_removes_a_message_from_the_given_thread(): void
    {
        $thread = ThreadFactory::create();

        $message = MessageFactory::thread($thread)->create();

        $this->assertDatabaseHas('messages', ['id' => $message->id]);

        (new RemoveMessageFromThread($thread))->execute($message);

        $this->assertSoftDeleted('messages', ['id' => $message->id]);
    }
}
