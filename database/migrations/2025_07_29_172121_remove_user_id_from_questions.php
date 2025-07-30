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
        Schema::disableForeignKeyConstraints();

        Schema::table('questions', function (Blueprint $table) {
            $table->dropForeign('questionnaires_user_id');
            $table->dropColumn('user_id');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->foreignId('user_id')
                ->constrained(table: 'users', indexName: 'questionnaires_user_id')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }
};
