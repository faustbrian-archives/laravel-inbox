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

namespace KodeKeep\Inbox\Tests\Unit\Actions;

use Facades\KodeKeep\Inbox\Tests\Factories\ThreadFactory;
use KodeKeep\Inbox\Actions\AddMessageToThread;
use KodeKeep\Inbox\Tests\TestCase;
use KodeKeep\Inbox\Tests\Unit\ClassThatHasInbox;

/**
 * @covers \KodeKeep\Inbox\Actions\AddMessageToThread
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
