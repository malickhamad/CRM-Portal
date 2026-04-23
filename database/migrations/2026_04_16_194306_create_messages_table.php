<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('conversation_id');
            $table->foreign('conversation_id')->references('id')->on('conversations')->onDelete('cascade');
            $table->text('message')->nullable(); // Text message
            $table->string('file_path')->nullable(); // To store the path of the file
            $table->string('file_type')->nullable(); // To store the type of the file (image, video, audio)
            $table->string('file_name')->nullable(); // To store the name of the file
            $table->boolean('is_read')->default(0);
            $table->timestamps();

        });
    }
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
