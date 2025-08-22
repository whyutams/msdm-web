<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('fullname', 100);
            $table->string('callname', 10);
            $table->string('email', 100)->unique()->nullable();
            $table->string('no_hp', 20)->unique();
            $table->string('photo_profile')->nullable();
            $table->text('address')->nullable();
            $table->enum('gender', ['pria', 'wanita']);
            $table->date('birth_date');
            $table->enum('diabetes_type', ['1', '2', 'gestasional']);
            $table->string('username', 50)->unique();
            $table->string('password');
            $table->enum('role', ['user', 'admin', 'superadmin'])->default('user');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
