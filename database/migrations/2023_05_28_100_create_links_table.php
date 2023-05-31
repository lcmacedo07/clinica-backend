<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinksTable extends Migration {

    public function down() {
        Schema::dropIfExists('links');
    }

    public function up() {
        Schema::create('links', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid')->unique();
            
			$table->string('linkoriginal', 200);
			$table->string('linkshort', 40);
			$table->string('identfy', 20)->nullable()->unique();
            $table->string('slug');
             
            $table->timestamps();
			$table->softDeletes();
             
        });
    }
}