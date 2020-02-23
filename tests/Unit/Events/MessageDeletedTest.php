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

use Facades\KodeKeep\Inbox\Tests\Factories\MessageFactory;
use Illuminate\Support\Facades\Event;
use KodeKeep\Inbox\Events\MessageDeleted;
use KodeKeep\Inbox\Tests\TestCase;

/**
 * @covers \KodeKeep\Inbox\Events\MessageDeleted
 */
class MessageDeletedTest extends TestCase
{
    /** @test */
    public function it_dispatches_the_event(): void
    {
        $message = MessageFactory::create();

        MessageDeleted::dispatch($message);

        Event::assertDispatched(MessageDeleted::class, fn ($e) => $e->message->id === $message->id);
    }
}
