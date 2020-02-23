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

namespace KodeKeep\Inbox\Events;

use Illuminate\Foundation\Events\Dispatchable;
use KodeKeep\Inbox\Contracts\Participant;

class ParticipantDeleted
{
    use Dispatchable;

    public Participant $participant;

    public function __construct(Participant $participant)
    {
        $this->participant = $participant;
    }
}
