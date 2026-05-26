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
        Schema::connection('prezet')->create('prezet_documents', function (Blueprint $table) {
            $table->id();

            $table->string('key')->nullable()->unique()->index();
            $table->string('slug')->unique()->index();
            $table->string('filepath')->unique()->index();
            $table->string('category')->nullable()->index();
            $table->string('content_type')->index();

            $table->boolean('draft')->default(false)->index();
            $table->char('hash', 32)->unique()->index();

            $table->json('frontmatter');

            // ✅ FIX: use standard timestamps (IMPORTANT)
            $table->timestamps();

            // optional extra index (correct syntax)
            $table->index(['filepath', 'hash']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('prezet')->dropIfExists('prezet_documents');
    }
};
