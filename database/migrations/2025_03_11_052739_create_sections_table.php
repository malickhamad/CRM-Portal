<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->engine = 'InnoDB';  // Ensure the table uses InnoDB for foreign keys
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('standard_id')->nullable(); // Foreign key column
            $table->text('description')->nullable(); // Optional description
            $table->integer('order_column')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sections');
    }
};
