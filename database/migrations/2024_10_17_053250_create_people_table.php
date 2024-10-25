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
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->integer('ci');
            $table->string('surname');
            $table->string('name');
            $table->unsignedBigInteger('range_id')->nullable(true);
            $table->string('position');
            $table->unsignedBigInteger('department_id')->nullable(true);
            $table->date('birthdate');
            $table->string('observation');
            $table->integer('cellular');
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('people');
    }
};
