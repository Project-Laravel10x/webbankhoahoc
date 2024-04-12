<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('online_students', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id')->unsigned()->nullable();
            $table->timestamp('last_activity')->useCurrent();
            $table->timestamps();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('online_students');
    }
};
