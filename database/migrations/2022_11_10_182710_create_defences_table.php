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
        Schema::create('defences', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->unsignedBigInteger('group_id')->index();
            $table->foreign('group_id')->references('id')->on('groups');
            $table->unsignedBigInteger('student_id')->index();
            $table->foreign('student_id')->references('id')->on('users');
            $table->tinyInteger('marks')->nullable();
            $table->text('details')->nullable();
            $table->unsignedTinyInteger('seen')->default(0)->comment('0 = unseen, 1 = seen');
            $table->unsignedTinyInteger('status')->default(0)->comment('0 = not_verified , 1 = verified');
            $table->unsignedBigInteger('varified_by')->nullable();
            $table->foreign('varified_by')->references('id')->on('users');
            $table->timestamp('varified_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('defences');
    }
};
