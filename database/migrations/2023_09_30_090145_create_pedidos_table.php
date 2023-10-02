<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public $timestamps = false;
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('clienteID')->nullable();
            $table->unsignedBigInteger('productoID')->nullable();
            $table->integer(column:'cantidad');
            $table->string(column:'codigoPedido');
            $table->string(column:'estadoPedido');
            $table->datetime(column:'fechaEstimadaEntrega');
            $table->foreign('productoID')->references('id')->on('productos')->onDelete('set null');
            $table->foreign('clienteID')->references('id')->on('clientes')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
