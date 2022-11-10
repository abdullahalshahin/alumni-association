<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('batches', function (Blueprint $table) {
            $table->id();
            $table->unsignedDecimal('department_id')->index();
            $table->string('name');
            $table->year('year');
            $table->unsignedTinyInteger('status')->comment('0 = inactive, 1 = active, 2 = closed');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('batches');
    }
};
