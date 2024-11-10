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
        Schema::create('detail_services', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
        schema::table('services',function(Blueprint $table){
            $table->foreign('service_id')->references('id')->on('services');
        });
        schema::table('group_services',function(Blueprint $table){
            $table->foreign('group_service_id')->references('id')->on('group_services');
        });
        schema::table('users',function(Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_services');
    }
};
