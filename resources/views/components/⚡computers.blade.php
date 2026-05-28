<?php

use Livewire\Component;
use App\Models\PcInventory;

new class extends Component
{
    // This is the data that will be stored
    public $PC_Name;
    public $Processor;
    public $OS_Installed;
    public $Graphics_Card;
    public $RAM_Installed;
    public $Storage;
    public $Student_Domain_Accessible;
    public $Padlocked;
    public $Processor_Architecture;
    public $Cable_Ties;
    public $WiFi_Card;
    public $Internet_Accessible;
    public $RAM_Speed;
    public $OS_Installation_Date;
    public $CPU_Speed; 

    protected $rules = [
        'PC_Name'=>'required|max:30|regex:/^[a-zA-Z0-9\s-]+$/',
        'Processor'=>'required|max:60|regex:/^[a-zA-Z0-9\s.-!]+$/',
        'OS_Installed'=>'required|max:30|regex:/^[a-zA-Z0-9\s]+$/',
        'Graphics_Card'=>'max:30|regex:/^[a-zA-Z0-9\s]+$/',
        'RAM_Installed'=>'required|max:60|regex:/^[a-zA-Z0-9]+$/',
        'Storage'=>'required|max:30|regex:/^[a-zA-Z0-9]+$/',
        'Student_Domain_Accesssible'=>'required|max:60|regex:/^[a-zA-Z0-9]+$/',
        'Processor_Architecture'=>'max:30',
        'Cable_Ties'=>'max:30',
        'Internet_Accessible'=>'max:30',
        'RAM_Speed'=>'max:30',
        'OS_Installation_Date'=>'required',
        'CPU_Speed'=>'required|max:10'
    ];

    public function submit(){

        PcInventory::create([
            'PC_Name'=>$this->PC_Name,
            'Processor'=>$this->Processor,
            'OS_Installed'=>$this->OS_Installed,
            'Graphics_Card'=>$this->Graphics_Card,
            'RAM_Installed'=>$this->RAM_Installed,
            'Storage'=>$this->Storage,
            'Student_Domain_Accessible'=>$this->Student_Domain_Accessible,
            'Processor_Architecture'=>$this->Processor_Architecture,
            'Cable_Ties'=>$this->Cable_Ties,
            'Internet_Accessible'=>$this->Internet_Accessible,
            'RAM_Speed'=>$this->RAM_Speed,
            'OS_Installation_Date'=>$this->OS_Installation_Date,
            'CPU_Speed'=>$this->CPU_Speed
        ]); 

        session()->flash('message','PC Added Successfully');
        $this->reset();
    }
};
?>

<div>
    {{-- I begin to speak only when I am certain what I will say is not better left unsaid. - Cato the Younger --}}
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h5>Create New PC Inventory</h5>
        </div>

        <div class="card-body">
            @if(session()->has('message'))
                <div class="alert alert-success">{{ session('message')}}</div>
            @endif

            <form wire:submit.prevent="submit">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">PC Name</label>
                        <input class="form-control" wire:model="PC_Name" type="text">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Processor</label>
                        <input class="form-control" wire:model="Processor" type="text">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">OS_Installed</label>
                        <input class="form-control" wire:model="OS_Installed" type="text">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Graphics_Card</label>
                        <input class="form-control" wire:model="Graphics_Card" type="text" placeholder="None">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">RAM_Installed</label>
                        <input class="form-control" wire:model="RAM_Installed" type="text" placeholder="4GB">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Storage</label>
                        <input class="form-control" wire:model="Storage" type="text" placeholder="500GB">
                    </div>

                    <div class="col-md-8 mb-3">
                        <label class="form-label">Student_Domain_Accessible</label>
                        <input class="form-control" wire:model="Student_Domain_Accessible" type="text">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Padlocked</label>
                        <select class="form-control" wire:model="Padlocked">
                            <option>--select--</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Processor_Architecture</label>
                        <input class="form-control" wire:model="Processor_Architecture" type="text" placeholder="x64">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Cable Ties</label>
                        <input class="form-control" wire:model="Cable_Ties" type="text" placeholder="Present or Missing on Mouse/HDMI/Keyboard">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">WiFi_Card</label>
                        <select class="form-control" wire:model="WiFi_Card">
                            <option>--select--</option>
                            <option value="1">Present</option>
                            <option value="0">Not Present</option>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Internet_Accessible</label>
                        <input class="form-control" wire:model="Internet_Accessible" type="text" placeholder="WiFi & Ethernet">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">RAM_Speed</label>
                        <input class="form-control" wire:model="RAM_Speed" type="text" placeholder="2667 MT/s">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">OS_Installation_Date</label>
                        <input class="form-control" wire:model="OS_Installation_Date" type="text" placeholder="DD/MM/YYYY">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">CPU_Speed</label>
                        <input class="form-control" wire:model="CPU_Speed" type="text" placeholder="3.10GHz">
                    </div>
                </div>

                <hr>

                <div class="d-flex justify-content-between">
                    <button id="back-btn-on-form" type="button" class="btn btn-danger mb-3" onclick="goBack()">
                        Go Back
                    </button>

                    <button type="submit" class="btn btn-success mb-3">
                        Submit
                    </button>
                </div>
            </form>
        </div>
        
    </div>

</div>