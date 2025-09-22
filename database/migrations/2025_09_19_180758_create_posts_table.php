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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            
            // VARCHAR(300), NULLABLE
            $table->string('link', 300)->nullable();

            // VARCHAR(150), NOT NULL
            $table->string('title', 150);

            // VARCHAR(150), NOT NULL
            $table->string('description', 150);

            // VARCHAR(300), NULLABLE
            $table->string('picture', 300)->nullable();

            // TEXT, NULLABLE
            $table->text('content')->nullable();

            // TIMESTAMP, NOT NULL, DEFAULT CURRENT_TIMESTAMP
            $table->timestamp('date')->useCurrent();

            // INT, NOT NULL, DEFAULT 1
            $table->integer('type')->default(1);

            // INT, NULLABLE (рассмотрите использование foreignId для связи с таблицей пользователей)
            $table->integer('creator')->nullable();

            // JSON, NULLABLE
            $table->json('tags')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
