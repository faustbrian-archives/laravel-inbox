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

namespace Konceiver\Inbox\Tests\Unit\Models;

use Facades\Konceiver\Inbox\Tests\Factories\MessageFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Konceiver\Inbox\Tests\TestCase;

/**
 * @covers \Konceiver\Inbox\Models\Message
 */
class MessageTest extends TestCase
{
    /** @test */
    public function a_message_belongs_to_thread(): void
    {
        $message = MessageFactory::create();

        $this->assertInstanceOf(BelongsTo::class, $message->thread());
    }

    /** @test */
    public function a_message_morphs_to_creator(): void
    {
        $message = MessageFactory::create();

        $this->assertInstanceOf(MorphTo::class, $message->creator());
    }

    /** @test */
    public function a_message_has_many_participants(): void
    {
        $message = MessageFactory::create();

        $this->assertInstanceOf(HasMany::class, $message->participants());
    }

    /** @test */
    public function a_message_has_many_recipients(): void
    {
        $message = MessageFactory::create();

        $this->assertInstanceOf(HasMany::class, $message->recipients());
    }
}
