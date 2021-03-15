<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIrtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('irts', function (Blueprint $table) {
            $table->id();
            $table->mediumInteger('s_id');
            $table->date('day');
            $table->mediumInteger('h_id');
            $table->mediumInteger('status');
            $table->float('dun');
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
        Schema::dropIfExists('irts');
    }
}
