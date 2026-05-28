<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PcInventory extends Model
{
    /** @use HasFactory<\Database\Factories\PcInventoryFactory> */
    use HasFactory;

    protected $table="pc_inventory";

    protected $fillable = [
        'created_at',
        'updated_at',
        'RowColumn',
        'Keyboard',
        'Mouse',
        'Monitor',
        'MonitorBrand',
        'HDMI', 
        'Ethernet',
        'CableTies',
        'SystemUnit',
        'CanAccessAdmin',
        'SystemUnitBrand',
        'DeviceName',
        'Processor',
        'ProcessorSpeed',
        'RamInstalled',
        'RamSpeed', 
        'StorageUsable',
        'WifiEnabled',
        'OsInstalled',
        'OsInstallationDate',
        'Graphics_Card',
        'StudentDomainAccessible',
        'Padlocked',
        'Errors',
    ];
}
