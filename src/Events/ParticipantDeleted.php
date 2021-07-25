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

namespace Konceiver\Inbox\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Konceiver\Inbox\Contracts\Participant;

class ParticipantDeleted
{
    use Dispatchable;

    public Participant $participant;

    public function __construct(Participant $participant)
    {
        $this->participant = $participant;
    }
}
