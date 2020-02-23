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
use KodeKeep\Inbox\Actions\AddParticipantToThread;
use KodeKeep\Inbox\Tests\TestCase;

/**
 * @covers \KodeKeep\Inbox\Actions\AddParticipantToThread
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
