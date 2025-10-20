<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('avcbs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('license_id')->nullable()->constrained('licenses')->nullOnDelete();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->string('ppci_number')->nullable();
            $table->date('issued_at')->nullable();
            $table->date('expires_at')->nullable();
            $table->boolean('has_compensatory_measures')->default(false);
            $table->string('status')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('avcbs');
    }
};
