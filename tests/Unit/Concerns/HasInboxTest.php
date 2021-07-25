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

namespace Konceiver\Inbox\Tests\Unit\Concerns;

use Carbon\Carbon;
use Facades\Konceiver\Inbox\Tests\Factories\ThreadFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Konceiver\Inbox\Models\Message;
use Konceiver\Inbox\Models\Participant;
use Konceiver\Inbox\Tests\TestCase;
use Konceiver\Inbox\Tests\Unit\ClassThatHasInbox;

/**
 * @covers \Konceiver\Inbox\Concerns\HasInbox
 */
class HasInboxTest extends TestCase
{
    /** @test */
    public function it_morphs_many_messages(): void
    {
        $this->assertInstanceOf(MorphMany::class, $this->user()->messages());
    }

    /** @test */
    public function it_belongs_to_many_threads(): void
    {
        $this->assertInstanceOf(BelongsToMany::class, $this->user()->threads());
    }

    /** @test */
    public function it_can_have_threads_with_new_messages(): void
    {
        $user = $this->user();

        $thread = ThreadFactory::create();

        Participant::create([
            'thread_id'    => $thread->id,
            'model_id'     => 1,
            'model_type'   => ClassThatHasInbox::class,
            'last_read_at' => Carbon::now(),
        ]);

        $this->assertCount(0, $user->threadsWithNewMessages());

        Message::create([
            'thread_id'    => $thread->id,
            'creator_id'   => 1,
            'creator_type' => ClassThatHasInbox::class,
            'body'         => 'Hello World',
        ]);

        $thread->forceFill(['updated_at' => Carbon::now()->addHour()])->save();

        $this->assertCount(1, $user->fresh()->threadsWithNewMessages());
    }
}
