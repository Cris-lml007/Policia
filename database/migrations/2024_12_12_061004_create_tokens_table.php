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
        Schema::create('tokens', function (Blueprint $table) {
            $table->id();
            $table->string("token");
            
            $table->unsignedBigInteger("supervisor_id");
            $table->foreign("supervisor_id")->references("ci")->on("users");

            $table->unsignedBigInteger("agent_id");
            $table->foreign("agent_id")->references("ci")->on("users");

            $table->boolean("validation")->default(false);
            $table->unsignedBigInteger("group_service_id");
            $table->foreign("group_service_id")->references("id")->on("group_services");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tokens');
    }
};
