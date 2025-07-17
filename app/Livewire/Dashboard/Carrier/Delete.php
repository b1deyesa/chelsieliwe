<?php

namespace App\Livewire\Dashboard\Carrier;

use App\Models\Carrier;
use Livewire\Component;

class Delete extends Component
{
    public Carrier $carrier;
    
    public function destroy()
    {
        $this->carrier->delete();
        
        return redirect()->route('dashboard.carrier.index');
    }
    
    public function render()
    {
        return view('livewire.dashboard.carrier.delete', [
            'carrier' => $this->carrier
        ]);
    }
}
