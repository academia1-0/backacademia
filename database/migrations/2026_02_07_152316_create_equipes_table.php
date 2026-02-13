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
        Schema::create('equipes', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('telefone')->nullable();
            $table->string('email')->unique();
            $table->string('data_nascimento')->nullable();;
            $table->string('endereco');
            $table->string('sexo');
            $table->string('formacao');
            $table->string('cargo');
            $table->string('salario');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipes');
        // Schema::table('equipes', function (Blueprint $table) {
        //     // Remove a coluna 'telefone' ao reverter a migration
        //     $table->dropColumn('');
        // });
        
    }
};
