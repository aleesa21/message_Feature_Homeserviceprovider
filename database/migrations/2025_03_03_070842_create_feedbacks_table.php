<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id'); // Customer who gives feedback
            $table->unsignedBigInteger('provider_id'); // Provider who receives feedback
            $table->text('message'); // Feedback message
            $table->integer('rating')->default(5); // Rating (1-5)
            $table->timestamps();

            // Foreign Keys
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('provider_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('feedbacks');
    }
};
