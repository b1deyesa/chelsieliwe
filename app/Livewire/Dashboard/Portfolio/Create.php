<?php

namespace App\Livewire\Dashboard\Portfolio;

use App\Models\Carrier;
use App\Models\Portfolio;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    
    public Carrier $carrier;
    public $title;
    public $path;
    public $file;
    public $link;
    
    public function store()
    {
        $path = $this->file ?: ($this->link ?: null);
        
        if (is_null($path)) {
            $this->addError('file', 'Please upload a file or provide a link.');
            return;
        }
        
        if ($this->file) {
            $path = $this->file->store('portfolio', 'public');
        }
        
        Portfolio::create([
            'carrier_id' => $this->carrier->id,
            'title' => $this->title,
            'path' => $path,
            'isLink' => $this->link ? true : false,
        ]);
        
        return redirect()->route('dashboard.portfolio.index', ['carrier' => $this->carrier]);
    }
    
    public function render()
    {
        return view('livewire.dashboard.portfolio.create', [
            'carrier' => $this->carrier
        ]);
    }
}
