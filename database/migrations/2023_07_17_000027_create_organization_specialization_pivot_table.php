<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationSpecializationPivotTable extends Migration
{
    public function up()
    {
        Schema::create('organization_specialization', function (Blueprint $table) {
            $table->unsignedBigInteger('organization_id');
            $table->foreign('organization_id', 'organization_id_fk_8761196')->references('id')->on('organizations')->onDelete('cascade');
            $table->unsignedBigInteger('specialization_id');
            $table->foreign('specialization_id', 'specialization_id_fk_8761196')->references('id')->on('specializations')->onDelete('cascade');
        });
    }
}
