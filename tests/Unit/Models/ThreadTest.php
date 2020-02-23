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

namespace KodeKeep\Inbox\Tests\Unit\Models;

use Facades\KodeKeep\Inbox\Tests\Factories\MessageFactory;
use Facades\KodeKeep\Inbox\Tests\Factories\ParticipantFactory;
use Facades\KodeKeep\Inbox\Tests\Factories\ThreadFactory;
use Facades\KodeKeep\Inbox\Tests\Factories\UserFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use KodeKeep\Inbox\Models\Message;
use KodeKeep\Inbox\Models\Thread;
use KodeKeep\Inbox\Tests\TestCase;
use KodeKeep\Inbox\Tests\Unit\ClassThatHasInbox;

/**
 * @covers \KodeKeep\Inbox\Models\Thread
 */
class ThreadTest extends TestCase
{
    /** @test */
    public function a_thread_has_many_messages(): void
    {
        $thread = ThreadFactory::create();

        $this->assertInstanceOf(HasMany::class, $thread->messages());
    }

    /** @test */
    public function a_thread_has_many_participants(): void
    {
        $thread = ThreadFactory::create();

        $this->assertInstanceOf(HasMany::class, $thread->participants());
    }

    /** @test */
    public function a_thread_has_a_creator(): void
    {
        $creator = UserFactory::create();

        $thread = ThreadFactory::create();

        MessageFactory::thread($thread)->creator($creator)->create();

        $this->assertInstanceOf(ClassThatHasInbox::class, $thread->creator());
    }

    /** @test */
    public function a_thread_has_a_latest_message(): void
    {
        $thread = ThreadFactory::create();

        MessageFactory::thread($thread)->create();

        $this->assertInstanceOf(Message::class, $thread->latestMessage());
    }

    /** @test */
    public function it_should_get_all_threads_for_a_user(): void
    {
        $thread = ThreadFactory::create();

        $john = ParticipantFactory::thread($thread)->create();

        $this->assertCount(1, Thread::forModel($john->model)->get());
    }

    /** @test */
    public function it_should_get_all_threads_for_a_user_with_new_messages(): void
    {
        $thread = ThreadFactory::create();

        $john = ParticipantFactory::thread($thread)->create();

        $this->assertCount(1, Thread::forModelWithNewMessages($john->model)->get());
    }

    /** @test */
    public function it_should_determine_if_the_thread_is_unread_by_a_participant(): void
    {
        $thread = ThreadFactory::create();

        $john = ParticipantFactory::thread($thread)->create();
        $jane = ParticipantFactory::thread($thread)->create();

        $this->assertTrue($thread->isUnread($john->model));
        $this->assertTrue($thread->isUnread($jane->model));

        $john->update(['last_read_at' => $thread->updated_at->addHour()]);

        $this->assertFalse($thread->fresh()->isUnread($john->model));
        $this->assertTrue($thread->fresh()->isUnread($jane->model));
    }

    /** @test */
    public function it_restores_all_deleted_participants(): void
    {
        $thread = ThreadFactory::create();

        $john = ParticipantFactory::thread($thread)->create();
        $jane = ParticipantFactory::thread($thread)->create();

        $this->assertSame(2, $thread->participants()->count());

        $john->delete();

        $this->assertSame(1, $thread->participants()->count());

        $thread->restoreAllParticipants();

        $this->assertSame(2, $thread->participants()->count());
    }

    /** @test */
    public function it_gets_the_participant_for_the_given_model(): void
    {
        $thread = ThreadFactory::create();

        $john = ParticipantFactory::thread($thread)->create();

        $this->assertSame($john->id, $thread->getParticipant($john->model)->id);
    }

    /** @test */
    public function it_checks_if_a_model_is_a_participant(): void
    {
        $thread = ThreadFactory::create();

        $john = ParticipantFactory::thread($thread)->create();
        $jane = ParticipantFactory::thread($thread)->create();
        $carl = ParticipantFactory::thread(ThreadFactory::create())->create();

        $this->assertTrue($thread->hasParticipant($john->model));
        $this->assertTrue($thread->hasParticipant($jane->model));
        $this->assertFalse($thread->hasParticipant($carl->model));
    }
}
