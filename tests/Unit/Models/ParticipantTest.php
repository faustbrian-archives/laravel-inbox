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

namespace KodeKeep\Inbox\Tests\Unit\Models;

use Facades\KodeKeep\Inbox\Tests\Factories\ParticipantFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use KodeKeep\Inbox\Tests\TestCase;

/**
 * @covers \KodeKeep\Inbox\Models\Participant
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
