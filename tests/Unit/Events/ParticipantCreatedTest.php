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

namespace KodeKeep\Inbox\Tests\Unit\Events;

use Facades\KodeKeep\Inbox\Tests\Factories\ParticipantFactory;
use Illuminate\Support\Facades\Event;
use KodeKeep\Inbox\Events\ParticipantCreated;
use KodeKeep\Inbox\Tests\TestCase;

/**
 * @covers \KodeKeep\Inbox\Events\ParticipantCreated
 */
class ParticipantCreatedTest extends TestCase
{
    /** @test */
    public function it_dispatches_the_event(): void
    {
        $participant = ParticipantFactory::create();

        ParticipantCreated::dispatch($participant);

        Event::assertDispatched(ParticipantCreated::class, fn ($e) => $e->participant->id === $participant->id);
    }
}
