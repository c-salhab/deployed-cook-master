<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUserFormationTable extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('user_formation', 'user_id')) {
            Schema::table('user_formation', function (Blueprint $table) {
                $table->unsignedBigInteger('user_id')->after('formation_id');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            });
        }
    }

    public function down()
    {
        if (Schema::hasColumn('user_formation', 'user_id')) {
            Schema::table('user_formation', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            });
        }
    }
}


