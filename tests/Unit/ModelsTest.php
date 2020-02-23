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

namespace KodeKeep\Inbox\Tests\Unit;

use KodeKeep\Inbox\Models;
use KodeKeep\Inbox\Tests\TestCase;

/**
 * @covers \KodeKeep\Inbox\Models
 */
class ModelsTest extends TestCase
{
    /** @test */
    public function it_can_get_the_thread_model(): void
    {
        $this->assertIsString(Models::getThreadModel());
    }

    /** @test */
    public function it_can_get_the_message_model(): void
    {
        $this->assertIsString(Models::getMessageModel());
    }

    /** @test */
    public function it_can_get_the_participant_model(): void
    {
        $this->assertIsString(Models::getParticipantModel());
    }

    /** @test */
    public function it_can_get_the_threads_table(): void
    {
        $this->assertIsString(Models::getThreadsTable());
    }

    /** @test */
    public function it_can_get_the_messages_table(): void
    {
        $this->assertIsString(Models::getMessagesTable());
    }

    /** @test */
    public function it_can_get_the_participants_table(): void
    {
        $this->assertIsString(Models::getParticipantsTable());
    }
}
