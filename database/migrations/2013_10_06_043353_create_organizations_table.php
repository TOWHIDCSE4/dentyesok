<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('address');
            $table->tinyInteger('type')->comment('1 - tổ chức, 2 is cá nhân');
            $table->tinyInteger('size')->comment('quy mô tổ chức');
            $table->tinyInteger('number_branch')->comment('số lượng chi nhánh');
            $table->integer('started_at')->nullable()->comment('năm bắt đầu');
            $table->integer('settlement_month')->nullable()->comment('tháng quyết toán');
            $table->date('expiration_date')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0 - not ready, 1 - free trial, 2 - subscription');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('branches', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('organization_id', 36);
            $table->string('name');
            $table->string('address')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('organizations');
        Schema::dropIfExists('branches');
    }
}
