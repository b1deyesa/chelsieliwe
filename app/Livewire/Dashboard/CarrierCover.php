<?php

namespace App\Livewire\Dashboard;

use App\Models\Carrier;
use App\Models\CarrierCover as ModelsCarrierCover;
use Livewire\Component;
use Livewire\WithFileUploads;

class CarrierCover extends Component
{
    use WithFileUploads;
    
    public Carrier $carrier;
    public $covers;
    public $file = [];
    
    public function mount() 
    {
        $this->covers = $this->carrier->carrierCovers()->pluck('path', 'id')->toArray();
    }
    
    public function updatedFile($value, $id)
    {
        if ($value) {
            $path = $value->store('cover', 'public');
            ModelsCarrierCover::find($id)->update([
                'path' => $path
            ]);
        }
        
        return redirect()->route('dashboard.portfolio.index', ['carrier' => $this->carrier]);
    }
    
    public function destroy($id)
    {
        ModelsCarrierCover::find($id)->update([
            'path' => null
        ]);
        
        return redirect()->route('dashboard.portfolio.index', ['carrier' => $this->carrier]);
    }
    
    public function render()
    {
        return view('livewire.dashboard.carrier-cover', [
            'carrier' => $this->carrier
        ]);
    }
}
