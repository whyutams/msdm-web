<?php

use App\Models\User;
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
            $table->string('callname', 10)->nullable();
            $table->string('email', 100)->unique()->nullable();
            $table->string('no_hp', 20)->unique()->nullable();
            $table->string('photo_profile')->nullable();
            $table->text('address')->nullable();
            $table->enum('gender', ['pria', 'wanita'])->nullable();
            $table->date('birth_date')->nullable();
            $table->enum('diabetes_type', ['1', '2', 'gestasional'])->nullable();
            $table->string('username', 50)->unique();
            $table->string('password');
            $table->enum('role', [User::ROLE_USER, User::ROLE_ADMIN, User::ROLE_SUPERADMIN])->default('user');
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
