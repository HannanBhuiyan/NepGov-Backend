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
        Schema::create('user_survays', function (Blueprint $table) {
            $table->id();
            $table->string('logo');
            $table->string('image')->nullable();
            $table->string('title');
            $table->string('short_para')->nullable();
            $table->string('footer_title')->nullable();
            $table->string('footer_para')->nullable();
            $table->string('footer_link')->nullable();
            $table->string('email_address')->nullable();
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
        Schema::dropIfExists('user_survays');
    }
};
