<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmsGatewaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_gateways', function (Blueprint $table) {
            $table->id();
            $table->integer('sms_gateway')->default(1);
            $table->text('twilio_sid');
            $table->text('twilio_token');
            $table->text('semaphore_api_key');
            $table->text('semaphore_sender');
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
        Schema::dropIfExists('sms_gateways');
    }
}
