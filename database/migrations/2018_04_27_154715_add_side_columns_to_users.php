<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSideColumnsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('profilepic')->default('default.jpg')->after('password');
            $table->string('tagline')->default('...tell us about yourself...');
            $table->string('mobile')->nullable();
            $table->string('website')->nullable();
            $table->string('contact_email')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('profilepic');
            $table->dropColumn('tagline');
            $table->dropColumn('mobile');
            $table->dropColumn('website');
            $table->dropColumn('contact_email');
        });
    }
}
