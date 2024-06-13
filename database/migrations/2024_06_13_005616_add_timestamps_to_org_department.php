<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimestampsToOrgDepartment extends Migration
{
    public function up()
    {
        Schema::table('ORG_DEPARTMENT', function (Blueprint $table) {
            $table->timestamps(); // Adds created_at and updated_at columns
        });
    }

    public function down()
    {
        Schema::table('ORG_DEPARTMENT', function (Blueprint $table) {
            $table->dropTimestamps(); // Removes created_at and updated_at columns
        });
    }
}
