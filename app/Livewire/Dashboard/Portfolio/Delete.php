<?php

namespace App\Livewire\Dashboard\Portfolio;

use App\Models\Carrier;
use App\Models\Portfolio;
use Livewire\Component;

class Delete extends Component
{
    public Portfolio $portfolio;
    public Carrier $carrier;
    
    public function destroy()
    {
        $this->portfolio->delete();
        
        return redirect()->route('dashboard.portfolio.index', ['carrier' => $this->carrier]);
    }
    
    public function render()
    {
        return view('livewire.dashboard.portfolio.delete', [
            'portfolio' => $this->portfolio,
            'carrier' => $this->carrier
        ]);
    }
}
