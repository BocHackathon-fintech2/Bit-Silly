<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBorrowContractsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::create('borrow_contracts', function(Blueprint $table) {

            $table->increments('id');
            $table->integer('user_id');
            $table->dateTime('from')->nullable();
            $table->dateTime('to')->nullable();
            $table->integer('amount')->default(1000)->nullable();
            $table->string('status')->default('unmatched')->nullable();
            $table->integer('accepted_by_lender_id')->nullable();
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

        Schema::dropIfExists('borrow_contracts');
    }
}
