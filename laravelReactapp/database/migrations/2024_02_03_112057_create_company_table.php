<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyTable extends Migration
{
    public function up()
    {
        Schema::create('company', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            // Add other necessary fields for the company
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('company');
    }
}

