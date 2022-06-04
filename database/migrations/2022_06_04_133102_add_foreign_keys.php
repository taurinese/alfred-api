<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table) {
            $table->foreignId('status_id')->constrained();
        });
        Schema::table('files', function($table) {
            $table->foreignId('user_id')->constrained();
            $table->foreignId('field_id')->constrained();        
        });
        Schema::table('rental_files', function($table){
            $table->foreignId('status_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table) {
            $table->dropColumn('status_id');
        });
        Schema::table('files', function($table) {
            $table->dropColumn('user_id');
            $table->dropColumn('field_id');
        });
        Schema::table('rental_files', function($table){
            $table->dropColumn('status_id');
        });
    }
}
