<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUseraccessesTable extends Migration {

    public function down() {
        Schema::dropIfExists('useraccesses');
    }

    public function up() {
        Schema::create('useraccesses', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid')->unique();

            $table->integer('link_id')->unsigned();
			$table->foreign('link_id')->references('id')->on('links')->onDelete('restrict');
            
			$table->string('ip', 200);
			$table->string('useragent', 500);
             
            $table->timestamps();
			$table->softDeletes();
             
        });
    }
}