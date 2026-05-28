<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pc_inventories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('PC_Name',30);
            $table->string('Processor',60);
            $table->string('OS_Installed',30);
            $table->string('Graphics_Card',30)->nullable();
            $table->string('RAM_Installed',60);
            $table->string('Storage',30);
            $table->string('Student_Domain_Accessible',60);
            $table->boolean('Padlocked')->default(1);
            $table->string('Processor_Architecture',30)->default('x64');
            $table->string('Cable_Ties',30)->default('Present');
            $table->boolean('WiFi_Card')->default(1);
            $table->string('Internet_Accessible',30)->default('WiFi,Ethernet');
            $table->string('RAM_Speed',30)->nullable();
            $table->date('OS_Installation_Date');
            $table->string('CPU_Speed',10);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pc_inventories');
    }
};
