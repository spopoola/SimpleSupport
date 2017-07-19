<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ticket_number');
            $table->integer('user_id')->unsigned()->nullable()->index('user_id');
            $table->integer('priority_id')->unsigned()->nullable()->index('priority_id');
            $table->integer('status_id')->unsigned()->nullable()->index('status_id');
            $table->integer('assigned_to')->unsigned()->nullable()->index('assigned_to');
            $table->string('subject');
            $table->longText('content');
            $table->integer('is_overdue')->default(0);
            $table->integer('is_replied')->default(0);
            $table->integer('is_closed')->default(0);
            $table->integer('is_deleted')->default(0);
            $table->dateTime('assigned_at')->nullable();
            $table->dateTime('due_date')->nullable();
            $table->dateTime('last_message_at')->nullable();
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
        Schema::dropIfExists('tickets');
    }
}
