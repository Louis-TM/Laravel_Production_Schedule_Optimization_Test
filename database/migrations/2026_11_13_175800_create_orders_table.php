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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->foreignId('product_type_id')->constrained('product_types')->onDelete('cascade');
            $table->dateTime('need_by')->index();
            $table->integer('setup_delay_minutes')->default(30);
            $table->dateTime('scheduled_start_time')->nullable();
            $table->dateTime('scheduled_end_time')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('	updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
