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
        Schema::table('clientes', function (Blueprint $table) {
            // $table->string('pagamento')->nullable()->after('email');
            // $table->date('data_nascimento')->nullable()->after('cpf');

            $table->boolean('pagamento')->default(false);

            $table->string('data_pagamento')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       
        Schema::table('clientes', function (Blueprint $table) {
            $table->dropColumn(['pagamento', 'data_pagamento']);
        });
    }
};
