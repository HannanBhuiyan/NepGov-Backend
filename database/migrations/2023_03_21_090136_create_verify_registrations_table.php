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
        Schema::create('verify_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('logo');
            $table->string('image')->nullable();
            $table->string('title');
            $table->string('token_name')->nullable();
            $table->string('link_text')->nullable();
            $table->string('link')->nullable();
            $table->string('ignore_message')->nullable();
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
        Schema::dropIfExists('verify_registrations');
    }
};
