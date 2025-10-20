<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('conditional_executions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conditional_id')->constrained()->cascadeOnDelete();
            $table->foreignId('executed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('executed_at')->nullable();
            $table->string('status')->nullable();
            $table->foreignId('evidence_attachment_id')->nullable()->constrained('attachments')->nullOnDelete();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('conditional_executions');
    }
};
