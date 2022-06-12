<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Permission;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->softDeletes();
        });

        Permission::insert([
            ["name" => "Admin"],
            ["name" => "Directors"],
            ["name" => "Practice Manager"],
            ["name" => "Manager"],
            ["name" => "Practitioner"],
            ["name" => "Accountant"],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
}
