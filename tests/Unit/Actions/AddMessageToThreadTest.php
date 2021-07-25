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

use Facades\Konceiver\Inbox\Tests\Factories\ThreadFactory;
use Konceiver\Inbox\Actions\AddMessageToThread;
use Konceiver\Inbox\Tests\TestCase;
use Konceiver\Inbox\Tests\Unit\ClassThatHasInbox;

/**
 * @covers \Konceiver\Inbox\Actions\AddMessageToThread
 */
class AddMessageToThreadTest extends TestCase
{
    /** @test */
    public function it_adds_a_new_message_for_the_given_thread(): void
    {
        $thread = ThreadFactory::create();

        $user = $this->user();

        $messageData = [
            'thread_id'    => $thread->id,
            'creator_id'   => 1,
            'creator_type' => ClassThatHasInbox::class,
            'body'         => 'Hello World',
        ];

        $this->assertDatabaseMissing('messages', $messageData);

        (new AddMessageToThread($thread))->execute($user, $messageData['body']);

        $this->assertDatabaseHas('messages', $messageData);
    }
}
