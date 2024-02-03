<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyGroupsTable extends Migration
{
    public function up()
    {
        Schema::create('company_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            // Add other necessary fields for company groups
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('company_groups');
    }
}
