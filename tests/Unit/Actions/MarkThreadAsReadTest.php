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
use Konceiver\Inbox\Actions\MarkThreadAsRead;
use Konceiver\Inbox\Tests\TestCase;

/**
 * @covers \Konceiver\Inbox\Actions\MarkThreadAsRead
 */
class MarkThreadAsReadTest extends TestCase
{
    /** @test */
    public function it_marks_the_thread_as_read_for_the_given_participant(): void
    {
        $thread = ThreadFactory::create();

        $user = $this->user();

        $participantData = [
            'model_id'     => $user->id,
            'model_type'   => get_class($user),
            'last_read_at' => null,
        ];

        (new AddParticipantToThread($thread))->execute($user);

        $this->assertDatabaseHas('participants', $participantData);

        (new MarkThreadAsRead($thread))->execute($user);

        $this->assertDatabaseMissing('participants', $participantData);
    }
}
