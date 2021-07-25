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
use Konceiver\Inbox\Actions\AddParticipantToThread;
use Konceiver\Inbox\Tests\TestCase;

/**
 * @covers \Konceiver\Inbox\Actions\AddParticipantToThread
 */
class AddParticipantToThreadTest extends TestCase
{
    /** @test */
    public function it_adds_a_new_participant_for_the_given_thread(): void
    {
        $thread = ThreadFactory::create();

        $user = $this->user();

        $participantData = [
            'thread_id'  => 1,
            'model_id'   => $user->id,
            'model_type' => get_class($user),
        ];

        $this->assertDatabaseMissing('participants', $participantData);

        (new AddParticipantToThread($thread))->execute($user);

        $this->assertDatabaseHas('participants', $participantData);
    }
}
