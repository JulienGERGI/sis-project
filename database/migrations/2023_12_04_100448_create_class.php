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
        Schema::create('class', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->tinyInteger('status')->default(0)->unsigned();
            $table->integer('created_by')->default(null)->unsigned();

//            $table->timestamp('crated_at')->nullable();
//            $table->timestamp('updated_at')->nullable();
//
//            $table->tinyInteger('user_type')->default(3)->unsigned();
//            $table->tinyInteger('is_delete')->default(0)->unsigned();
//            $table->rememberToken();
            $table->tinyInteger('is_delete')->default(0)->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class');
    }
};
