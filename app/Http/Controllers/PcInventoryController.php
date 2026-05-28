<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePcInventoryRequest;
use App\Http\Requests\UpdatePcInventoryRequest;
use App\Models\PcInventory;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Storage;

class PcInventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePcInventoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PcInventory $pcInventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PcInventory $pcInventory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePcInventoryRequest $request, PcInventory $pcInventory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PcInventory $pcInventory)
    {
        //
    }

    /**
     * Mass add the data on the database
     */
    public function massCreate()
    {
        // Get the file
        $filename = "Lab_data.csv";

        // Open a read stream
        $handle = Storage::disk('local')->readStream($filename);

        // Skip the header row
        $header = fgetcsv($handle,null,',');

        // Variables to help understand where we are at in cycle of importing
        $importedRows=0;
        $dataToInsert = [];

        // Delete the rows from the table first
        PcInventory::truncate();

        // Read until false
        while(($row = fgetcsv($handle,null,',')) !== FALSE){
            // Assignment
            $created_at = now();
            $updated_at = now();
            $RowColumn = $row[0];
            $Keyboard = $row[1];
            $Mouse = $row[2];
            $Monitor = $row[3];
            $MonitorBrand = $row[4];
            $HDMI = $row[5];
            $Ethernet = $row[6];
            $CableTies = $row[7];
            $SystemUnit = $row[8];
            $CanAccessAdmin = $row[9];
            $SystemUnitBrand = $row[10];
            $DeviceName = $row[11];
            $Processor = $row[12];
            $ProcessorSpeed = $row[13];
            $RamInstalled = $row[14];
            $RamSpeed = $row[15];   
            $StorageUsable = $row[16];
            $WifiEnabled = $row[17];
            $OsInstalled = $row[18];
            $OsInstallationDate = $row[19];
            $Graphics_Card = $row[20];
            $StudentDomainAccessible = $row[21];
            $Padlocked = $row[22];
            $Errors = $row[23];

            if($RowColumn != null){
                // Clean Up
                if(preg_match("/Present/",$Keyboard)){$Keyboard=1;}else{$Keyboard=0;}
                if(preg_match("/Present/",$Mouse)){$Mouse=1;}else{$Mouse=0;}
                if(preg_match("/Present/",$Monitor)){$Monitor=1;}else{$Monitor=0;}
                if(preg_match("/Present/",$HDMI)){$HDMI=1;}else{$HDMI=0;}
                if(preg_match("/Present/",$Ethernet)){$Ethernet=1;}else{$Ethernet=0;}
                if(preg_match("/Present/",$CableTies)){$CableTies=1;}else{$CableTies=0;}
                if(preg_match("/Present/",$SystemUnit)){$SystemUnit=1;}else{$SystemUnit=0;}
                if(preg_match("/Yes/",$CanAccessAdmin)){$CanAccessAdmin=1;}else{$CanAccessAdmin=0;}
                if(preg_match("/Yes/",$WifiEnabled)){$WifiEnabled=1;}else{$WifiEnabled=0;}
                if(preg_match("/Yes/",$StudentDomainAccessible)){$StudentDomainAccessible=1;}else{$StudentDomainAccessible=0;}
                if(preg_match("/Yes/",$Padlocked)){$Padlocked=1;}else{$Padlocked=0;}
                if(!empty($OsInstallationDate)){
                    try{
                        $OsInstallationDate=Carbon::createFromFormat("m/d/Y",trim($OsInstallationDate))->format('Y-m-d');
                    }catch(\Throwable $e){
                        $OsInstallationDate=null;
                    }
                }else{$OsInstallationDate=null;}
                
                // Map database columns to CSV columns 
                $dataToInsert[] = [
                    'created_at' => now(),
                    'updated_at' => now(),
                    'RowColumn' => $RowColumn,
                    'Keyboard' => $Keyboard,
                    'Mouse' => $Mouse,
                    'Monitor' => $Monitor,
                    'MonitorBrand' => $MonitorBrand,
                    'HDMI' => $HDMI,            
                    'Ethernet' => $Ethernet,
                    'CableTies' => $CableTies,
                    'SystemUnit' => $SystemUnit,
                    'CanAccessAdmin' => $CanAccessAdmin,
                    'SystemUnitBrand' => $SystemUnitBrand,
                    'DeviceName' => $DeviceName,
                    'Processor' => $Processor,
                    'ProcessorSpeed' => $ProcessorSpeed,
                    'RamInstalled' => $RamInstalled,
                    'RamSpeed' =>$RamSpeed, 
                    'StorageUsable' => $StorageUsable,
                    'WifiEnabled' => $WifiEnabled,
                    'OsInstalled' => $OsInstalled,
                    'OsInstallationDate' => $OsInstallationDate,
                    'Graphics_Card' => $Graphics_Card,
                    'StudentDomainAccessible' => $StudentDomainAccessible,
                    'Padlocked' => $Padlocked,
                    'Errors' => $Errors,
                ];

                // Insert if enough data 500 rows reached
                if(count($dataToInsert) ===500){
                    PcInventory::insert($dataToInsert);
                    $importedRows += count($dataToInsert);
                    $dataToInsert = [];
                }
            }
        }

        // Insert leftover rows
        if(count($dataToInsert) !==0){
                PcInventory::insert($dataToInsert);
                $importedRows += count($dataToInsert);
        }
        
        // Close the stream
        fclose($handle);

        return redirect()->route("home")->with("success","You inserted ".$importedRows." rows");
    }

}
