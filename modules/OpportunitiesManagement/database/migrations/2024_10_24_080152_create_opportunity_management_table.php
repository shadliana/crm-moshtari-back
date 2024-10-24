<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('opportunity_management', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('related_customer');
            $table->decimal('cost', 10);
            $table->integer('status')->default(1);
            $table->integer('created_by_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('opportunity_management');
    }
};
