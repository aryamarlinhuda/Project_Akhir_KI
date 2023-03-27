<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableDiskon extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_diskon', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();
            $table->decimal('diskon',8,2);
            $table->foreignId('product_id')->nullable();
            $table->integer('minimal')->nullable();
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
        Schema::dropIfExists('table_diskon');
    }
}
