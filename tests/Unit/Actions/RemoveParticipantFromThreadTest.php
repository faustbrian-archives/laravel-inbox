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

use Facades\KodeKeep\Inbox\Tests\Factories\ParticipantFactory;
use Facades\KodeKeep\Inbox\Tests\Factories\ThreadFactory;
use KodeKeep\Inbox\Actions\RemoveParticipantFromThread;
use KodeKeep\Inbox\Tests\TestCase;

/**
 * @covers \KodeKeep\Inbox\Actions\RemoveParticipantFromThread
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
