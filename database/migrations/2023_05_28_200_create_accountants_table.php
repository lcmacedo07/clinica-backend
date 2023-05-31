<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountantsTable extends Migration {

    public function down() {
        Schema::dropIfExists('accountants');
    }

    public function up() {
        Schema::create('accountants', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid')->unique();

            $table->integer('link_id')->unsigned();
			$table->foreign('link_id')->references('id')->on('links')->onDelete('restrict');
            
			$table->integer('quantity')->default(0);
             
            $table->timestamps();
			$table->softDeletes();
             
        });
    }
}