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

use Facades\Konceiver\Inbox\Tests\Factories\ParticipantFactory;
use Facades\Konceiver\Inbox\Tests\Factories\ThreadFactory;
use Konceiver\Inbox\Actions\RemoveParticipantFromThread;
use Konceiver\Inbox\Tests\TestCase;

/**
 * @covers \Konceiver\Inbox\Actions\RemoveParticipantFromThread
 */
class RemoveParticipantFromThreadTest extends TestCase
{
    /** @test */
    public function it_removes_a_participant_from_the_given_thread(): void
    {
        $thread = ThreadFactory::create();

        $participant = ParticipantFactory::thread($thread)->create();

        $this->assertDatabaseHas('participants', ['id' => $participant->id]);

        (new RemoveParticipantFromThread($thread))->execute($participant->model);

        $this->assertSoftDeleted('participants', ['id' => $participant->id]);
    }
}
