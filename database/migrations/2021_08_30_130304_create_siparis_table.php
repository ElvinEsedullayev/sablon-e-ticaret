<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiparisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siparishes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sepet_id');
            $table->unique('sepet_id');
            $table->string('adsoyad',50)->nullable();
            $table->string('adres',200)->nullable();
            $table->string('phone',15)->nullable();
            $table->string('mobile',15)->nullable();
            $table->decimal('siparis_tutar',10,4);
            $table->string('durum',30)->nullable();
            $table->string('bank',20)->nullable();
            $table->integer('taksit_sayisi')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('sepet_id')->references('id')->on('sepets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siparishes');
    }
}
