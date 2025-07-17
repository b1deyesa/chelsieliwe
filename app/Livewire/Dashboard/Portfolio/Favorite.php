<?php

namespace App\Livewire\Dashboard\Portfolio;

use App\Models\Carrier;
use App\Models\Portfolio;
use Livewire\Component;

class Favorite extends Component
{
    public Portfolio $portfolio;
    public Carrier $carrier;
    public $isFavorite;
    
    public function mount()
    {
        $this->isFavorite = $this->portfolio->isFavorite;
    }
    
    public function update(bool $bool)
    {
        $this->portfolio->update([
            'isFavorite' => $bool
        ]);
    }
    
    public function render()
    {
        return view('livewire.dashboard.portfolio.favorite', [
            'portfolio' => $this->portfolio,
            'carrier' => $this->carrier
        ]);
    }
}