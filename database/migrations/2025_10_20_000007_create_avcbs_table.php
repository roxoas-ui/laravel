<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('avcbs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->string('ppci_number');
            $table->date('issued_at')->nullable();
            $table->date('expires_at')->nullable();
            $table->boolean('has_compensatory_measures')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('avcbs');
    }
};
