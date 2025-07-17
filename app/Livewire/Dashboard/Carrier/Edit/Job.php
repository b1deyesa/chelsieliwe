<?php

namespace App\Livewire\Dashboard\Carrier\Edit;

use App\Models\Carrier;
use Livewire\Component;

class Job extends Component
{
    public Carrier $carrier;
    public array $jobs;
    public ?int $nextFocusIndex = null;

    public function mount()
    {
        $this->jobs = collect(json_decode($this->carrier->job, true))
            ->filter(fn($line) => is_string($line) && trim($line) !== '')
            ->values()
            ->toArray();

        $this->ensureTrailingEmptyItem();
    }

    public function updated($property)
    {
        if (str_starts_with($property, 'jobs.')) {
            $this->ensureTrailingEmptyItem();

            $this->carrier->update([
                'job' => json_encode($this->jobs),
            ]);

            $this->nextFocusIndex = null;
        }
    }

    public function addEmptyJobAfter(int $index)
    {
        array_splice($this->jobs, $index + 1, 0, ['']);
        $this->nextFocusIndex = $index + 1;
    }

    protected function ensureTrailingEmptyItem(): void
    {
        if (count($this->jobs) === 0 || trim(end($this->jobs)) !== '') {
            $this->jobs[] = '';
        }
    }

    public function render()
    {
        return view('livewire.dashboard.carrier.edit.job', [
            'carrier' => $this->carrier
        ]);
    }
}
