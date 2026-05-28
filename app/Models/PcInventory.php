<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PcInventory extends Model
{
    /** @use HasFactory<\Database\Factories\PcInventoryFactory> */
    use HasFactory;

    protected $table="pc_inventories";

    protected $fillable = [
        'PC_Name',
        'Processor',
        'OS_Installed',
        'Graphics_Card',
        'RAM_Installed',
        'Storage',
        'Student_Domain_Accessible',
        'Padlocked',
        'Processor_Architecture',
        'Cable_Ties',
        'WiFi_Card',
        'Internet_Accessible',
        'RAM_Speed',
        'OS_Installation_Date',
        'CPU_Speed',
    ];
}
