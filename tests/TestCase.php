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

namespace KodeKeep\Inbox\Tests;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use KodeKeep\Inbox\Providers\InboxServiceProvider;
use KodeKeep\Inbox\Tests\Unit\ClassThatHasInbox;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();

        Event::fake();

        $this->loadLaravelMigrations(['--database' => 'testbench']);

        $this->artisan('migrate', ['--database' => 'testbench'])->run();

        // $this->withFactories(realpath(__DIR__.'/Factories'));
    }

    protected function getEnvironmentSetUp($app): void
    {
        $app['config']->set('database.default', 'testbench');

        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);

        // $app['config']->set('inbox.models.participant', ClassThatHasInbox::class);
    }

    protected function getPackageProviders($app): array
    {
        return [InboxServiceProvider::class];
    }

    protected function user(): Model
    {
        return ClassThatHasInbox::create([
            'name'     => $this->faker->name,
            'email'    => $this->faker->safeEmail,
            'password' => $this->faker->password,
        ]);
    }
}
