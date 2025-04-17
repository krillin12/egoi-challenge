<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    /**
     * Execute as modificações da migration.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
      
        
            $table->text('user_email');
            $table->text('description');
            $table->time('at_time');
        
    
           
        });
        
    }

    /**
     * Reverter as modificações da migration.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logs');  // Remove a tabela 'logs' caso precise reverter a migration
    }
}