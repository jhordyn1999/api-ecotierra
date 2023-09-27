<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('subtasks', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->integer('state');
        $table->unsignedBigInteger('task_id');
        $table->unsignedBigInteger('user_id');
        $table->integer('priority');
        $table->timestamp('limit_date')->nullable();
        $table->timestamps();

        $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subtasks');
    }
};
