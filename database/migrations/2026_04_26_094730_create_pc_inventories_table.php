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
        Schema::create('pc_inventory', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('RowColumn',4);
            $table->boolean('Keyboard');
            $table->boolean('Mouse');
            $table->boolean('Monitor');
            $table->string('MonitorBrand',20);
            $table->boolean('HDMI');
            $table->boolean('Ethernet');
            $table->boolean('CableTies');
            $table->boolean('SystemUnit');
            $table->boolean('CanAccessAdmin');
            $table->string('SystemUnitBrand',15);
            $table->string('DeviceName',25);
            $table->string('Processor',20);
            $table->string('ProcessorSpeed',30);
            $table->string('RamInstalled',15);
            $table->string('RamSpeed',30);
            $table->string('StorageUsable',30);
            $table->boolean('WifiEnabled')->default(1);
            $table->string('OsInstalled',30);
            $table->date('OsInstallationDate')->nullable();
            $table->string('Graphics_Card',60);
            $table->boolean('StudentDomainAccessible');
            $table->boolean('Padlocked')->default(1);
            $table->longText('Errors');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pc_inventory');
    }
};
