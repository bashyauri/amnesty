<?php

use App\Models\Department;
use App\Models\Program;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('application_form', function (Blueprint $table) {
            $table->increments('id');
            $table->string('rrr_code')->unique();
            $table->string('transactionId')->unique();
            $table->string('account_id')->unique();
            $table->string('surname');
            $table->string('firstname');
            $table->string('m_name')->nullable();
            $table->foreignIdFor(Program::class);
            $table->string('gender');
            $table->string('matric_no');
            $table->string('year_failed_exam');
            $table->string('cgpa');
            $table->string('no_of_course');
            $table->foreignIdFor(Department::class);
            $table->string('remark')->nullable();
            $table->string('recommendation')->nullable();
            $table->string('pro_status')->nullable();
            $table->integer('batch')->default(0);
            $table->string('list_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('application_form');
    }
}