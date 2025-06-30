<?php

namespace App\Livewire;

use Exception;
use Carbon\Carbon;
use Livewire\Component;
use App\Models\Family\Member;
use Livewire\Attributes\Title;
use App\Models\Drive as DM;

#[Title('Driving Tracker')]
class Drive extends Component
{
    public $driver;
    public $drives, $drive;
    public $date, $minutes, $notes, $slot;

    public $showForm = false;
    public $medium = null;
    public $legend;

    protected $rules = [
        'date' => ['required', 'date'],
        'minutes' => ['required', 'integer'],
        'notes' => ['nullable', 'string', 'max:500'],
        'slot' => ['required', 'in:day,night']
    ];

    public function mount()
    {
        $this->driver = Member::find(3);
        $this->drives = $this->driver->drives()
            ->orderByDesc('date')
            ->orderByDesc('id')
            ->get();
        $this->slot = 'day';
    }

    public function create()
    {
        $this->date = Carbon::parse(now())->format("Y-m-d");
        $this->minutes = 0;
        $this->notes = null;
        $this->medium = 'create';
        $this->legend = "Add Drive";
        $this->showForm = true;
    }

    public function edit($id)
    {
        $this->drive = DM::find($id);
        $this->date = $this->drive->date;
        $this->minutes = $this->drive->minutes;
        $this->notes = $this->drive->notes;
        $this->medium = 'edit';
        $this->legend = "Edit Drive for " . Carbon::parse($this->date)->format('m/d/Y');
        $this->showForm = true;
    }

    public function save()
    {
        $this->validate();

        try {
            $data = [
                'date' => $this->date,
                'minutes' => $this->minutes,
                'notes' => $this->notes ?? null,
                'slot' => $this->slot ?? 'day',
            ];

            if ($this->medium === 'edit' && $this->drive) {
                $this->drive->update($data);
            } elseif ($this->medium === 'create') {
                $this->drive = DM::create($data + ['driver_id' => $this->driver->id]);
            } else {
                return $this->resetForm();
            }
        } catch (Exception $e) {
            $this->addError('notes', $e->getMessage());
        }

        $this->resetForm();
    }

    public function cancelForm()
    {
        return $this->resetForm();
    }

    protected function resetForm()
    {
        unset($this->date, $this->minutes, $this->notes, $this->legend);
        $this->medium = null;
        $this->showForm = false;
        $this->drives = $this->driver->drives()->orderByDesc('date')->get();
    }

    public function render()
    {
        return view('drives');
    }
}
