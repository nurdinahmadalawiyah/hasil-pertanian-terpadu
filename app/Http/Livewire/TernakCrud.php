<?php

namespace App\Http\Livewire;

use App\Models\Ternak;
use Livewire\Component;

class TernakCrud extends Component
{
    public $ternak, $nama_ternak, $deskripsi_ternak, $ternak_id;
    public $isModalOpen = 0;

    public function render()
    {
        $this->ternak = Ternak::all();
        return view('livewire.ternak-crud');
    }
    
    public function create()
    {
        $this->resetCreateForm();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    private function resetCreateForm(){
        $this->nama_ternak = '';
        $this->deskripsi_ternak = '';
    }

    public function store()
    {
        $this->validate([
            'nama_ternak' => 'required',
            'deskripsi_ternak' => 'required',
        ]);
    
        Ternak::updateOrCreate(['id' => $this->ternak_id], [
            'nama_ternak' => $this->nama_ternak,
            'deskripsi_ternak' => $this->deskripsi_ternak,
        ]);

        session()->flash('message', $this->ternak_id ? 'Data updated successfully.' : 'Data added successfully.');

        $this->closeModal();
        $this->resetCreateForm();
    }

    public function edit($id)
    {
        $ternak = Ternak::findOrFail($id);
        $this->ternak_id = $id;
        $this->nama_ternak = $ternak->nama_ternak;
        $this->deskripsi_ternak = $ternak->deskripsi_ternak;
    
        $this->openModal();
    }

    public function delete($id)
    {
        Ternak::find($id)->delete();
        session()->flash('message', 'Data deleted successfully.');
    }
}
