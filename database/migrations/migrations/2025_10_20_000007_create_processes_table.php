<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('processes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('license_id')->constrained()->cascadeOnDelete();
            $table->string('protocol_number')->nullable();
            $table->string('current_status')->nullable();
            $table->json('timeline')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('processes');
    }
};
