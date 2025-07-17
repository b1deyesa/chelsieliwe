<?php

namespace App\Livewire\Dashboard\Carrier;

use App\Models\Carrier;
use Livewire\Component;

class Update extends Component
{
    public Carrier $carrier;
    public $company;
    public $job;
    
    public function mount()
    {
        $this->company = $this->carrier->company;
        $this->job = $this->carrier->job;
    }
    
    public function update()
    {
        $this->carrier->update([
            'company' => $this->company,
            'job' => $this->job
        ]);
        
        return redirect()->route('dashboard.carrier.index');
    }
    
    public function render()
    {
        return view('livewire.dashboard.carrier.update', [
            'carrier' => $this->carrier
        ]);
    }
}
