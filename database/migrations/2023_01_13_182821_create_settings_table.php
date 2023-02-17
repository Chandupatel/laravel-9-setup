<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('group')->nullable();
            $table->string('label')->nullable();
            $table->string('key')->nullable();
            $table->string('value')->nullable();
            $table->enum('input_type', ['text', 'number', 'file', 'checkbox', 'radio', 'select', 'textarea', 'email', 'password', 'date', 'datetime-local', 'month', 'week', 'time', 'color', 'range', 'reset', 'url'])->default('text');
            $table->text('input_options')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('display_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
};
