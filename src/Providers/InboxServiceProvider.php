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

namespace Konceiver\Inbox\Providers;

use Illuminate\Support\ServiceProvider;

class InboxServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/inbox.php', 'inbox');
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../../config/inbox.php' => $this->app->configPath('inbox.php'),
            ], 'config');

            $this->publishes([
                __DIR__.'/../../database/migrations/' => $this->app->databasePath('migrations'),
            ], 'migrations');
        }
    }
}
