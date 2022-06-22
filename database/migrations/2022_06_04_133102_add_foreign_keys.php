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
            $table->foreignId('status_id')->constrained()->onDelete('cascade');
        });
        Schema::table('files', function($table) {
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('guarantor_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('field_id')->constrained()->onDelete('cascade');        
        });
        Schema::table('rental_files', function($table){
            $table->foreignId('status_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        });
        Schema::table('guarantors', function($table){
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
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
            $table->dropColumn('guarantor_id');
            $table->dropColumn('field_id');
        });
        Schema::table('rental_files', function($table){
            $table->dropColumn('status_id');
            $table->dropColumn('user_id');
        });
        Schema::table('guarantors', function($table){
            $table->dropColumn('user_id');
        });
    }
}
