<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('services_images', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('url');
            $table->string('name');
            $table->integer('file_size');
            $table->string('format');
            $table->timestamp('created_at')->default(now());
            $table->uuid('service_id');

            $table->foreign('service_id')
                  ->references('id')
                  ->on('services')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('services_images', function (Blueprint $table) {
            $table->dropForeign(['service_id']);
        });

        Schema::dropIfExists('services_images');
    }
};
