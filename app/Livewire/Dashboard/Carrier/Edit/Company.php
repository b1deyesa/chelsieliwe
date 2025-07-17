<?php

namespace App\Livewire\Dashboard\Carrier\Edit;

use App\Models\Carrier;
use Livewire\Component;

class Company extends Component
{
    public Carrier $carrier;
    public $company;
    
    public function mount()
    {
        $this->company = $this->carrier->company;
    }
    
    public function updatedCompany()
    {
        $this->carrier->update([
            'company' => $this->company
        ]);
    }
    
    public function render()
    {
        return view('livewire.dashboard.carrier.edit.company', [
            'carrier' => $this->carrier
        ]);
    }
}
