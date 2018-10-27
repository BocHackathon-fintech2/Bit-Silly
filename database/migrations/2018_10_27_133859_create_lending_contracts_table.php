<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLendingContractsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::create('lending_contracts', function(Blueprint $table) {

            $table->increments('id');
            $table->integer('user_id');
            $table->string('subscription_id')->nullable();
            $table->string('access_token')->nullable();
            $table->string('response')->nullable();
            $table->dateTime('from')->nullable();
            $table->dateTime('to')->nullable();
            $table->integer('amount')->default(1000)->nullable();
            $table->integer('rate')->nullable();
            $table->integer('suggested_rate')->nullable();
            $table->string('status')->nullable();
            $table->integer('accepted_by_borrower_id')->nullable();
            $table->timestamp('accepted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists('lending_contracts');
    }
}
