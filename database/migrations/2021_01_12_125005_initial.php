<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Initial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('type', ['Customer', 'Employee'])->default('Customer');
        });

        Schema::create('genres', function (Blueprint $table) {
            $table->string('code', 10)->primary();
            $table->string('name');
        });

        Schema::create('books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('genre', 10);
            $table->foreign('genre')->references('code')->on('genres');
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('cover_img')->nullable();
            $table->decimal('price', 9, 2);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('purchases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('users');
            $table->date('date');
            $table->decimal('total', 9, 2);
            $table->enum('status', ['P', 'D', 'C'])->default('P');
            // Pending, Delivered, Canceled
            $table->timestamps();
        });

        Schema::create('book_purchase', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('purchase_id')->unsigned();
            $table->unsignedBigInteger('book_id')->unsigned();
            $table->foreign('purchase_id')->references('id')->on('purchases');
            $table->foreign('book_id')->references('id')->on('books');
            $table->integer('qty')->default(1);
            $table->decimal('unit_price', 9, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
