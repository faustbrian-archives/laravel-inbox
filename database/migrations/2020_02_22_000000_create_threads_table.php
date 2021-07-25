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

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

class CreateThreadsTable extends Migration
{
    public function up()
    {
        Schema::create(Config::get('inbox.tables.threads'), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('subject');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create(Config::get('inbox.tables.messages'), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('thread_id')->index();
            $table->morphs('creator');
            $table->text('body');
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('thread_id')->references('id')->on(Config::get('inbox.tables.threads'))->onDelete('cascade');
        });

        Schema::create(Config::get('inbox.tables.participants'), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('thread_id')->index();
            $table->morphs('model');
            $table->timestamp('last_read_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('thread_id')->references('id')->on(Config::get('inbox.tables.threads'))->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists(Config::get('inbox.tables.participants'));
        Schema::dropIfExists(Config::get('inbox.tables.messages'));
        Schema::dropIfExists(Config::get('inbox.tables.threads'));
    }
}
