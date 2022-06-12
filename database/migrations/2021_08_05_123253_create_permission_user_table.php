<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePermissionUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission_user', function (Blueprint $table) {
            $table->id();

            // creating a foreign key column
            $table->unsignedBigInteger("user_id");

            //setting up foreign key
            //declaring a foreign key
            $table->foreign("user_id")
                ->references("id")
                ->on("users")
                ->onDelete("restrict")
                ->onUpdate("cascade");

            // creating a foreign key column
            $table->unsignedBigInteger("permission_id");

            //setting up foreign key
            //declaring a foreign key
            $table->foreign("permission_id")
                ->references("id")
                ->on("permissions")
                ->onDelete("restrict")
                ->onUpdate("cascade");


            $table->longText("remarks")->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('permission_user')->insert([
            ["user_id" => 1, "permission_id" => 1],
            ["user_id" => 1, "permission_id" => 2],
            ["user_id" => 1, "permission_id" => 3],
            ["user_id" => 1, "permission_id" => 4],
            ["user_id" => 1, "permission_id" => 5],
            ["user_id" => 1, "permission_id" => 6],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permission_user');
    }
}
