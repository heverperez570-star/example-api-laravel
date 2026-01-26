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
        // Almacena los roles dentro del sistema (Admin, editor y lector)
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique(); // Identificador único del rol
            $table->string('name'); // Nombre del rol
            $table->string('description')->nullable(); // Descripción del rol
            $table->boolean('status')->default(true); // Indica si el rol está activo
            $table->timestamps();
            $table->softDeletes(); // Fecha de eliminación suave
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->foreignId('role_id')->constrained('roles'); // Relación con la tabla roles

            $table->string('names', 175); // Nombres de los usuarios
            $table->string('last_names', 200); // Apellidos de los usuarios
            $table->string('username', 100)->unique(); // Nombre de usuario único
            $table->string('email')->unique(); // Correo electrónico único
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password'); //  Contraseña cifrada
            $table->rememberToken();
            $table->boolean('status')->default(true); // Indica si el usuario esta activo
            $table->timestamps(); // Fechas de creación y actualización
            $table->softDeletes(); // Fecha de eliminación suave
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
