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

namespace KodeKeep\Inbox\Tests\Factories;

use Facades\KodeKeep\Inbox\Tests\Factories\ThreadFactory;
use Facades\KodeKeep\Inbox\Tests\Factories\UserFactory;
use Faker\Generator;
use KodeKeep\Fabrik\Factory;
use KodeKeep\Inbox\Models\Participant;
use KodeKeep\Inbox\Models\Thread;
use KodeKeep\Inbox\Tests\Unit\ClassThatHasInbox;

class ParticipantFactory extends Factory
{
    protected string $modelClass = Participant::class;

    private ?Thread $thread = null;

    private ?ClassThatHasInbox $model = null;

    public function getData(Generator $generator): array
    {
        return [
            'thread_id'  => $this->thread ? $this->thread->id : ThreadFactory::create()->id,
            'model_id'   => $this->model ? $this->model->id : UserFactory::create()->id,
            'model_type' => ClassThatHasInbox::class,
        ];
    }

    public function thread(Thread $thread): self
    {
        $this->thread = $thread;

        return $this;
    }

    public function model(ClassThatHasInbox $model): self
    {
        $this->model = $model;

        return $this;
    }
}
