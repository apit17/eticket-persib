<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewTableForEticket extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Customers Table
        Schema::create('customers', function($table)
        {
            $table->increments('id');
            $table->string('customer_name', 50);
            $table->string('customer_ktp', 16);
            $table->string('customer_handphone', 14);
            $table->string('customer_email', 50);
            $table->string('customer_password');
            $table->string('customer_city', 50);
            $table->string('customer_address', 50);
            $table->timestamps();

            $table->unique('customer_ktp');
        });

        // Schedules Table
        Schema::create('schedules', function($table)
        {
            $table->increments('id');
            $table->string('schedule_match');
            $table->string('schedule_stadion');
            $table->string('schedule_home_image');
            $table->string('schedule_away_image');
            $table->dateTime('schedule_date_match');
            $table->date('schedule_start_date');
            $table->timestamps();
        });

        // Tickets Table
        Schema::create('tickets', function($table)
        {
            $table->increments('id');
            $table->integer('schedule_id');
            $table->string('ticket_name');
            $table->double('ticket_price',8,2);
            $table->integer('ticket_stock');
            $table->timestamps();
        });

        // Transaction Table
        Schema::create('transactions', function($table)
        {
            $table->increments('id');
            $table->integer('customer_id');
            $table->integer('ticket_id');
            $table->string('transaction_code', 7);
            $table->dateTime('transaction_date');
            $table->double('transaction_price',8,2);
            $table->string('transaction_resi_number', 7);
            $table->integer('transaction_resi_status')->default(0);
            $table->string('transaction_proof_image');
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
        Schema::drop('customers');
        Schema::drop('schedules');
        Schema::drop('tickets');
        Schema::drop('transactions');
    }
}
