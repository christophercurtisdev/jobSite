<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('name', 80);
            $table->text('description')->nullable();
            $table->integer('compensation');
            $table->schemalessAttributes('extra_attributes')->nullable();
            $table->unsignedInteger('job_compensation_type_id')->nullable();
            $table->unsignedInteger('job_type_id');
            $table->unsignedInteger('job_category_id');
            $table->unsignedInteger('job_sub_category_id')->nullable();
            $table->unsignedBigInteger('author_id');

            $table->foreign('job_compensation_type_id')->references('id')->on('job_compensation_types');
            $table->foreign('job_type_id')->references('id')->on('job_types');
            $table->foreign('job_category_id')->references('id')->on('job_categories');
            $table->foreign('author_id')->references('id')->on('users');
            $table->foreign('job_sub_category_id')->references('id')->on('job_sub_categories');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
