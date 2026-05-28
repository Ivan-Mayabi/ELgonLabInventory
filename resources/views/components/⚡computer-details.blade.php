<?php

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\PcInventory;

new class extends Component
{
    public $selectedComputer=null;
    public $isEditing=false;

    // Track state fields for form mapping
    public $Mouse, $Keyboard, $Monitor, $HDMI, $Ethernet, $CableTies, $SystemUnit;
    public $SystemUnitBrand, $Padlock, $MonitorBrand, $StudentDomainAccessible, $CanAccessAdmin;
    public $DeviceName, $Processor, $ProcessorSpeed, $OsInstalled, $OsInstallationDate;
    public $Graphics_Card, $RamInstalled, $StorageUsable, $Errors;

    // Whenever the appliance is clicked, its name is taken as an attribute
    #[On('computerSelected')]
    public function loadComputerData($name)
    {
        $this->selectedComputer = PcInventory::where('RowColumn', $name)->first();
        $this->isEditing=false;

        if ($this->selectedComputer) {
            // Fill up our editable form variables with current database properties
            $this->Mouse = $this->selectedComputer->Mouse;
            $this->Keyboard = $this->selectedComputer->Keyboard;
            $this->Monitor = $this->selectedComputer->Monitor;
            $this->HDMI = $this->selectedComputer->HDMI;
            $this->Ethernet = $this->selectedComputer->Ethernet;
            $this->CableTies = $this->selectedComputer->CableTies;
            $this->SystemUnit = $this->selectedComputer->SystemUnit;
            $this->SystemUnitBrand = $this->selectedComputer->SystemUnitBrand;
            $this->Padlock = $this->selectedComputer->Padlock;
            $this->MonitorBrand = $this->selectedComputer->MonitorBrand;
            $this->StudentDomainAccessible = $this->selectedComputer->StudentDomainAccessible;
            $this->CanAccessAdmin = $this->selectedComputer->CanAccessAdmin;
            $this->DeviceName = $this->selectedComputer->DeviceName;
            $this->Processor = $this->selectedComputer->Processor;
            $this->ProcessorSpeed = $this->selectedComputer->ProcessorSpeed;
            $this->OsInstalled = $this->selectedComputer->OsInstalled;
            $this->OsInstallationDate = $this->selectedComputer->OsInstallationDate;
            $this->Graphics_Card = $this->selectedComputer->Graphics_Card;
            $this->RamInstalled = $this->selectedComputer->RamInstalled;
            $this->StorageUsable = $this->selectedComputer->StorageUsable;
            $this->Errors = $this->selectedComputer->Errors;
        }
    }

    #[On('computerReset')]
    public function resetComputerData()
    {
        $this->selectedComputer = null;
    }

    // Change to edit mode
    public function enableEditing()
    {
        $this->isEditing = true;
    }

    // Save to the database
    public function save()
    {
        if($this->selectedComputer){
            $this->selectedComputer->update([
                'Mouse' => $this->Mouse,
                'Keyboard' => $this->Keyboard,
                'Monitor' => $this->Monitor,
                'HDMI' => $this->HDMI,
                'Ethernet' => $this->Ethernet,
                'CableTies' => $this->CableTies,
                'SystemUnit' => $this->SystemUnit,
                'SystemUnitBrand' => $this->SystemUnitBrand,
                'Padlock' => $this->Padlock,
                'MonitorBrand' => $this->MonitorBrand,
                'StudentDomainAccessible' => $this->StudentDomainAccessible,
                'CanAccessAdmin' => $this->CanAccessAdmin,
                'DeviceName' => $this->DeviceName,
                'Processor' => $this->Processor,
                'ProcessorSpeed' => $this->ProcessorSpeed,
                'OsInstalled' => $this->OsInstalled,
                'OsInstallationDate' => $this->OsInstallationDate,
                'Graphics_Card' => $this->Graphics_Card,
                'RamInstalled' => $this->RamInstalled,
                'StorageUsable' => $this->StorageUsable,
                'Errors' => $this->Errors,
        ]);
        $this->isEditing = false;
        session()->flash('success','PC '.$selectedComputer->RowColumn.' has been updated');
        }
    }
};
?>

<div>
    @if(session()->has('success'))
        <div style="background-color: #d1e7dd; color: #0f5132; padding: 10px; margin-bottom: 15px; border-radius: 4px;">
            {{ session('success') }}
        </div>
    @endif

    {{-- You must be the change you wish to see in the world. - Mahatma Gandhi --}}
    @if($selectedComputer!=null)
        <div id="display-component" class="d-inline-block;w-50vw">
            <h4>{{$selectedComputer->RowColumn}}</h4>
            <form wire:submit.prevent="save">
                
                <p><strong>Hardware Presence</strong></p>
                <table style="border-collapse: collapse; max-width: 40vw; width: 100%;">
                    <tr>
                        <th>Component</th>
                        <th>Type/Presence/Specification</th>
                    </tr>
                    <tr>
                        <td>Mouse</td>
                        <td>
                            @if($isEditing)
                                <select wire:model="Mouse"><option value="1">Present</option><option value="0">No Mouse</option></select>
                            @else
                                {{ $selectedComputer->Mouse == 1 ? "Present" : "No Mouse" }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Keyboard</td>
                        <td>
                            @if($isEditing)
                                <select wire:model="Keyboard"><option value="1">Present</option><option value="0">No Keyboard</option></select>
                            @else
                                {{ $selectedComputer->Keyboard == 1 ? "Present" : "No Keyboard" }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Monitor</td>
                        <td>
                            @if($isEditing)
                                <select wire:model="Monitor"><option value="1">Present</option><option value="0">No Monitor</option></select>
                            @else
                                {{ $selectedComputer->Monitor == 1 ? "Present" : "No Monitor" }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>HDMI</td>
                        <td>
                            @if($isEditing)
                                <select wire:model="HDMI"><option value="1">Present</option><option value="0">No HDMI</option></select>
                            @else
                                {{ $selectedComputer->HDMI == 1 ? "Present" : "No HDMI" }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Ethernet</td>
                        <td>
                            @if($isEditing)
                                <select wire:model="Ethernet"><option value="1">Present</option><option value="0">No Ethernet</option></select>
                            @else
                                {{ $selectedComputer->Ethernet == 1 ? "Present" : "No Ethernet" }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>CableTies</td>
                        <td>
                            @if($isEditing)
                                <select wire:model="CableTies"><option value="1">Present</option><option value="0">No CableTies</option></select>
                            @else
                                {{ $selectedComputer->CableTies == 1 ? "Present" : "No CableTies" }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>System Unit</td>
                        <td>
                            @if($isEditing)
                                <select wire:model="SystemUnit"><option value="1">Present</option><option value="0">No System Unit</option></select>
                            @else
                                {{ $selectedComputer->SystemUnit == 1 ? "Present" : "No System Unit" }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>System Unit Brand</td>
                        <td>
                            @if($isEditing)
                                <input type="text" wire:model="SystemUnitBrand">
                            @else
                                {{ $selectedComputer->SystemUnitBrand }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Padlocked</td>
                        <td>
                            @if($isEditing)
                                <select wire:model="Padlock"><option value="1">Yes</option><option value="0">Not Padlocked</option></select>
                            @else
                                {{ $selectedComputer->Padlock == 1 ? "Yes" : "Not Padlocked" }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Monitor Brand</td>
                        <td>
                            @if($isEditing)
                                <input type="text" wire:model="MonitorBrand">
                            @else
                                {{ $selectedComputer->MonitorBrand }}
                            @endif
                        </td>
                    </tr>
                </table>
                
                <br>
                <p><strong>Domains/Accounts Accessible</strong></p>
                <table style="max-width: 40vw; width: 100%; border-collapse: collapse;" border="1">
                    <tr>
                        <th>Domain</th>
                        <th>Specification</th>
                    </tr>
                    <tr>
                        <td>Student</td>
                        <td>
                            @if($isEditing)
                                <select wire:model="StudentDomainAccessible"><option value="1">Yes</option><option value="0">No</option></select>
                            @else
                                {{ $selectedComputer->StudentDomainAccessible == 1 ? "Yes" : "Student Domain Not Accessible Here" }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Admin Account</td>
                        <td>
                            @if($isEditing)
                                <select wire:model="CanAccessAdmin"><option value="1">Yes</option><option value="0">Needs to be Reset</option></select>
                            @else
                                {{ $selectedComputer->CanAccessAdmin == 1 ? "Yes" : "Needs to be Reset" }}
                            @endif
                        </td>
                    </tr>
                </table>
                
                <br>
                <p><strong>Hardware Specifications</strong></p>
                <table style="max-width: 40vw; width: 100%; border-collapse: collapse;" border="1">
                    <tr>
                        <th>Component</th>
                        <th>Specification</th>
                    </tr>
                    <tr>
                        <td>PC ID</td>
                        <td>{{ $selectedComputer->id }}</td>
                    </tr>
                    <tr>
                        <td>PC Name</td>
                        <td>
                            @if($isEditing)
                                <input type="text" wire:model="DeviceName">
                            @else
                                {{ $selectedComputer->DeviceName }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Processor</td>
                        <td>
                            @if($isEditing)
                                <input type="text" wire:model="Processor">
                            @else
                                {{ $selectedComputer->Processor }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Processor Speed</td>
                        <td>
                            @if($isEditing)
                                <input type="text" wire:model="ProcessorSpeed">
                            @else
                                {{ $selectedComputer->ProcessorSpeed }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>OS</td>
                        <td>
                            @if($isEditing)
                                <input type="text" wire:model="OsInstalled">
                            @else
                                {{ $selectedComputer->OsInstalled }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>OS Installation Date</td>
                        <td>
                            @if($isEditing)
                                <input type="date" wire:model="OsInstallationDate">
                            @else
                                {{ $selectedComputer->OsInstallationDate }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Graphics Card</td>
                        <td>
                            @if($isEditing)
                                <input type="text" wire:model="Graphics_Card">
                            @else
                                {{ $selectedComputer->Graphics_Card }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>RAM Installed</td>
                        <td>
                            @if($isEditing)
                                <input type="text" wire:model="RamInstalled">
                            @else
                                {{ $selectedComputer->RamInstalled }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Storage</td>
                        <td>
                            @if($isEditing)
                                <input type="text" wire:model="StorageUsable">
                            @else
                                {{ $selectedComputer->StorageUsable }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Errors</td>
                        <td>
                            @if($isEditing)
                                <textarea wire:model="Errors"></textarea>
                            @else
                                {{ $selectedComputer->Errors != null ? $selectedComputer->Errors : "No errors" }}
                            @endif
                        </td>
                    </tr>        
                </table>

                <br>
                <div>
                    @if(!$isEditing)
                        <button type="button" wire:click="enableEditing" style="padding: 6px 12px; cursor: pointer;">
                            Update Specifications
                        </button>
                    @else
                        <button type="submit" style="padding: 6px 12px; background-color: #198754; color: white; border: none; cursor: pointer;">
                            Save Layout
                        </button>
                        <button type="button" wire:click="$set('isEditing', false)" style="padding: 6px 12px; background-color: #6c757d; color: white; border: none; cursor: pointer; margin-left: 5px;">
                            Cancel
                        </button>
                    @endif
                </div>
            </form>
        </div>
    @endif

</div>