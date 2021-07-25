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

namespace Konceiver\Inbox\Tests\Unit\Events;

use Facades\Konceiver\Inbox\Tests\Factories\ThreadFactory;
use Illuminate\Support\Facades\Event;
use Konceiver\Inbox\Events\ThreadUpdated;
use Konceiver\Inbox\Tests\TestCase;

/**
 * @covers \Konceiver\Inbox\Events\ThreadUpdated
 */
class ThreadUpdatedTest extends TestCase
{
    /** @test */
    public function it_dispatches_the_event(): void
    {
        $thread = ThreadFactory::create();

        ThreadUpdated::dispatch($thread);

        Event::assertDispatched(ThreadUpdated::class, fn ($e) => $e->thread->id === $thread->id);
    }
}
