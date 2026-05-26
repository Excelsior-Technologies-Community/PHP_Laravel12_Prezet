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
        Schema::connection('prezet')->create('document_tags', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('document_id')->index();
            $table->unsignedBigInteger('tag_id')->index();
        });
    }

    public function down(): void
    {
        Schema::connection('prezet')->dropIfExists('document_tags');
    }
};