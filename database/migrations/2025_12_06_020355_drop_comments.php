<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::dropIfExists('comments');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('facility_id')
                ->constrained(table: 'facilities', indexName: 'comments_facility_id')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('user_id')
                ->constrained(table: 'users', indexName: 'comments_user_id')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->text('content');
            $table->integer('rating');
            $table->timestamps();
        });
    }
};
