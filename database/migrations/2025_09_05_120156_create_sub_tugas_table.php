<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sub_tugas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('urutan');
            $table->enum('jenis', ['text', 'file', 'link']);
            $table->text('content')->nullable();
            $table->enum('file_type', ['pdf', 'ppt', 'pptx'])->nullable();
            $table->string('file_path')->nullable();
            $table->string('link')->nullable();
            $table->foreignId('tugas_id')->constrained('tugas')->onDelete('cascade');
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            // $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_tugas');
    }
};
