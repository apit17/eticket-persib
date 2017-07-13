<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableUserAndCustomer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers',function(Blueprint $table){
            $table->string('address');
            $table->integer('user_id');
        });
        Schema::table('users',function(Blueprint $table){
            $table->integer('customer_id');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers',function(Blueprint $table){
            $table->dropColumn('address');
            $table->dropColumn('user_id');
        });
        Schema::table('users',function(Blueprint $table){
            $table->dropColumn('customer_id');
        });
    }
}
