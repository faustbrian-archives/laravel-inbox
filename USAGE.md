# Usage

## Setup a Model

``` php
namespace App;

use Konceiver\Inbox\HasMessages;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasMessages;
}
```

## Examples

### Create a new thread

``` php
Thread::create([
    'subject' => str_random(10),
]);
```

### Add one message to a thread

``` php
$thread->addMessage([
    'body' => str_random(10),
], $user);
```

### Add multiple messages to a thread

``` php
$thread->addMessage([
    [
        'data' => ['body' => str_random(10)],
        'creator' => User::find(1),
    ],
    [
        'data' => ['body' => str_random(10)],
        'creator' => User::find(2),
    ],
], $user);
```

### Add one participant to a thread

``` php
$thread->addParticipant($user);
```

### Add multiple participants to a thread

``` php
$thread->addParticipants([
    User::find(3), Organization::find(2), Player::find(4)
]);
```

### Mark a thread as ready by the user

``` php
$thread->markAsRead($user);
```

### Get all threads

``` php
Thread::getAllLatest()->get();
```

### Get all threads that a user has participated in

``` php
Thread::forModel($user)->latest('updated_at')->get();
```

### Get all threads that a user has participated in with new messages

``` php
Thread::forModelWithNewMessages($user)->latest('updated_at')->get();
```

### Get the creator of a thread

``` php
$thread->creator();
```

### Get the latest message of a thread

``` php
$thread->getLatestMessage();
```

### Check if the User Model hasn't read the latest message in the thread yet

``` php
$thread->isUnread($user);
```

### Check if the User Model participated to the Thread

``` php
$thread->hasParticipant($user);
```
