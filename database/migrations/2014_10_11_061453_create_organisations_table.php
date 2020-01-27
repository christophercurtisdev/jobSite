<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganisationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('organisations')) {
            Schema::create('organisations', function (Blueprint $table) {
                $table->increments('id');
                $table->text('name', 80);
                $table->string('email');
                $table->string('avatar_path')->nullable();
                $table->unsignedBigInteger('admin_id'); //USER
                
                $table->schemalessAttributes('extra_attributes')->nullable();
                $table->softDeletes();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organisations');
    }
}
