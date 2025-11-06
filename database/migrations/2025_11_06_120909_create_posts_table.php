<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->enum('status', ['draft','published'])->default('draft');
            $table->string('source'); // jsonplaceholder or fakestore
            $table->unsignedBigInteger('external_id');
            $table->timestamps();

            $table->unique(['source', 'external_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
