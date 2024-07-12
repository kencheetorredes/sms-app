<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBulkSendingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bulk_sendings', function (Blueprint $table) {
            $table->id();
            $table->integer('group_id');
            $table->integer('twillio_id');
            $table->integer('status')->default(0);
            $table->datetime('scheduled')->nullable();
            $table->string('message');
            $table->integer('created_by');
            $table->integer('total');
            $table->integer('send');
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
        Schema::dropIfExists('bulk_sendings');
    }
}
