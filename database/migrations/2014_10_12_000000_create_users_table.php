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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('user_type')->default(2)->comment('0 = admin, 1 = teacher, 2 = student');
            $table->unsignedBigInteger('session_id')->nullable();
            $table->unsignedInteger('registration_no', 10)->unique()->nullable();
            $table->string('name');
            $table->string('contact_number', 15)->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('security');
            $table->unsignedTinyInteger('gender')->comment('1 = male, 2 = female, 3 = others');
            $table->string('date_of_birth', 10)->nullable();
            $table->double('earning_credit', 8, 2)->nullable();
            $table->text('address')->nullable();
            $table->string('biography', 120)->nullable();
            $table->string('image')->nullable();
            $table->unsignedTinyInteger('status')->default(1)->comment('0 = inactive, 1 = active, 2 = blocked');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
