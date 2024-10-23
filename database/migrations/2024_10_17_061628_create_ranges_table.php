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
        Schema::create('ranges', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        schema::table('people',function(Blueprint $table){
            $table->foreign('range_id')->references('id')->on('people');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ranges');
    }
};