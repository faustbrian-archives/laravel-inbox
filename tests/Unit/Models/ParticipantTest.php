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

use Facades\Konceiver\Inbox\Tests\Factories\ParticipantFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Konceiver\Inbox\Tests\TestCase;

/**
 * @covers \Konceiver\Inbox\Models\Participant
 */
class ParticipantTest extends TestCase
{
    /** @test */
    public function a_message_belongs_to_thread(): void
    {
        $participant = ParticipantFactory::create();

        $this->assertInstanceOf(BelongsTo::class, $participant->thread());
    }

    /** @test */
    public function a_message_morphs_to_thread(): void
    {
        $participant = ParticipantFactory::create();

        $this->assertInstanceOf(MorphTo::class, $participant->model());
    }
}
