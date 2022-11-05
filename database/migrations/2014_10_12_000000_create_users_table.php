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
            $table->string('registration_number', 6)->unique();
            $table->string('name');
            $table->string('date_of_birth', 10);
            $table->unsignedTinyInteger('gender')->comment('1 = male, 2 = female, 3 = others');
            $table->string('contact_number', 15)->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('security');
            $table->string('occupation')->nullable();
            $table->string('position')->nullable();
            $table->string('guardian_name')->nullable();
            $table->string('guardian_contact_number', 15)->nullable();
            $table->text('address');
            $table->string('image')->nullable();
            $table->unsignedTinyInteger('user_type')->comment('0 = admin, 1 = teacher, 2 = student');
            $table->unsignedTinyInteger('status')->comment('0 = blocked, 1 = active, 2 = inactive');
            $table->rememberToken();
            $table->timestamps();
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
