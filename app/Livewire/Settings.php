<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Family\Member;

class Settings extends Component
{
    public $members;
    public $showModal = false;

    public $id, $name, $dob, $sex;

    protected $rules = [
        'name' => ['required', 'string'],
        'dob' => ['required', 'date'],
        'sex' => ['required', 'string', 'in:Male,Female']
    ];

    public function mount()
    {
        $this->members = Member::orderBy('dob')->get();
    }

    public function create()
    {
        $this->clearForm();
        $this->showModal = true;
    }

    public function edit($id)
    {
        $member = Member::find($id);

        if (!$member) {
            return;
        }

        $this->id = $id;
        $this->name = $member->name;
        $this->dob = Carbon::parse($member->dob)->format('Y-m-d');
        $this->sex = $member->sex;

        $this->showModal = true;
    }

    #[On('toggleModal')]
    public function toggleModal()
    {
        $this->clearForm();
        $this->showModal = !$this->showModal;
    }

    public function save()
    {
        $this->validate();

        Member::updateOrCreate([
            'id' => $this->id
        ], [
            'name' => $this->name,
            'dob' => $this->dob,
            'sex' => $this->sex
        ]);

        $this->members = Member::orderBy('dob')->get();
        $this->toggleModal();
    }

    public function clearForm()
    {
        $this->reset('id', 'name', 'dob', 'sex');
    }


    public function render()
    {
        return view('settings');
    }
}
