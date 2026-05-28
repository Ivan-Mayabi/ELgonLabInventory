<?php

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\PcInventory;

new class extends Component
{
    public $selectedComputer=null;

    // Whenever the appliance is clicked, its name is taken as an attribute
    #[On('computerSelected')]
    public function loadComputerData($name)
    {
        $this->selectedComputer = PcInventory::where('RowColumn', $name)->first();
    }

    #[On('computerReset')]
    public function resetComputerData()
    {
        $this->selectedComputer = null;
    }
};
?>

<div>
    {{-- You must be the change you wish to see in the world. - Mahatma Gandhi --}}
    @if($selectedComputer!=null)
        <div id="display-component" class="d-inline-block;w-50vw">
            <h4>{{$selectedComputer->RowColumn}}</h4>
            <p>Hardware Prescence</p>
            <table style="border-collapse:collapse;max-width:40vw" >
            <tr>
                <th>Component</th>
                <th>Type/Prescence/Specification</th>
            </tr>
            <tr>
                <td>Mouse</td>
                <td>{{$selectedComputer->Mouse == 1? "Present" : "No Mouse"}}</td>
            </tr>
            <tr>
                <td>Keyboard</td>
                <td>{{$selectedComputer->Keyboard == 1? "Present" : "No Mouse"}}</td>
            </tr>
            <tr>
                <td>Monitor</td>
                <td>{{$selectedComputer->Monitor == 1? "Present" : "No Mouse"}}</td>
            </tr>
            <tr>
                <td>HDMI</td>
                <td>{{$selectedComputer->HDMI == 1? "Present" : "No Mouse"}}</td>
            </tr>
            <tr>
                <td>Ethernet</td>
                <td>{{$selectedComputer->Ethernet == 1? "Present" : "No Mouse"}}</td>
            </tr>
            <tr>
                <td>CableTies</td>
                <td>{{$selectedComputer->CableTies == 1? "Present" : "No Mouse"}}</td>
            </tr>
            <tr>
                <td>System Unit</td>
                <td>{{$selectedComputer->SystemUnit == 1? "Present" : "No Mouse"}}</td>
            </tr>
            <tr>
                <td>System Unit Brand</td>
                <td>{{$selectedComputer->SystemUnitBrand}}</td>
            </tr>
            <tr>
                <td>Padlocked</td>
                <td>{{$selectedComputer->Padlock == 1? "Yes" : "Not Padlocked"}}</td>
            </tr>
            <tr>
                <td>Monitor Brand</td>
                <td>{{$selectedComputer->MonitorBrand}}</td>
            </tr>
            </table>
            <br>
            <p>Domains/Accounts Accessible</p>
            <table style="max-width:40vw">
            <tr>
                <th>Domain</th>
                <th>Specification</th>
            </tr>
            <tr>
                <td>Student</td>
                <td>{{$selectedComputer->StudentDomainAccessible == 1? "Yes" : "Student Domain Not Accessible Here"}}</td>
            </tr>
            <tr>
                <td>Admin Account</td>
                <td>{{$selectedComputer->CanAccessAdmin == 1? "Yes" : "Needs to be Reset"}}</td>
            </tr>
            </table>
            <br>
            <p>Hardware Specifications</p>
            <table style="max-width:40vw">
            <tr>
                <th>Component</th>
                <th>Specification</th>
            </tr>
            <tr>
                <td>PC ID</td>
                <td>{{$selectedComputer->id}}</td>
            </tr>
            <tr>
                <td>PC Name</td>
                <td>{{$selectedComputer->DeviceName}}</td>
            </tr>
            <tr>
                <td>Processor</td>
                <td>{{$selectedComputer->Processor}}</td>
            </tr>
            <tr>
                <td>Processor Speed</td>
                <td>{{$selectedComputer->ProcessorSpeed}}</td>
            </tr>
            <tr>
                <td>OS</td>
                <td>{{$selectedComputer->OsInstalled}}</td>
            </tr>
            <tr>
                <td>OS Installation Date</td>
                <td>{{$selectedComputer->OsInstallationDate}}</td>
            </tr>
            <tr>
                <td>Graphics Card</td>
                <td>{{$selectedComputer->Graphics_Card}}</td>
            </tr>
            <tr>
                <td>RAM Installed</td>
                <td>{{$selectedComputer->RamInstalled}}</td>
            </tr>
            <tr>
                <td>Storage</td>
                <td>{{$selectedComputer->StorageUsable}}</td>
            </tr>
            <tr>
                <td>Padlocked</td>
                <td>{{$selectedComputer->Padlocked}}</td>
            </tr>
            <tr>
                <td>Errors</td>
                <td>{{$selectedComputer->Errors!=null ? $selectedComputer->Errors : "No errors"}}</td>
            </tr>        
            </table>
        </div>
    @endif

</div>