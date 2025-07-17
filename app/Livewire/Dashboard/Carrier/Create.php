<?php

namespace App\Livewire\Dashboard\Carrier;

use App\Models\Carrier;
use Livewire\Component;

class Create extends Component
{
    public $company;
    public $job;
    
    public function store()
    {
        $this->validate([
            'company' => 'required'
        ]);
        
        Carrier::create([
            'company' => $this->company,
            'job' => $this->job
        ]);
        
        return redirect()->route('dashboard.carrier.index');
    }
    
    public function render()
    {
        return view('livewire.dashboard.carrier.create');
    }
}
