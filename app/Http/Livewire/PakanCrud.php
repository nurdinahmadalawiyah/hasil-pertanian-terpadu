<?php

namespace App\Http\Livewire;

use App\Models\Pakan;
use Livewire\Component;

class PakanCrud extends Component
{
    public $pakan, $nama_pakan, $deskripsi_pakan, $pakan_id;
    public $isModalOpen = 0;

    public function render()
    {
        $this->pakan = Pakan::all();
        return view('livewire.pakan-crud');
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
        $this->nama_pakan = '';
        $this->deskripsi_pakan = '';
    }

    public function store()
    {
        $this->validate([
            'nama_pakan' => 'required',
            'deskripsi_pakan' => 'required',
        ]);
    
        Pakan::updateOrCreate(['id' => $this->pakan_id], [
            'nama_pakan' => $this->nama_pakan,
            'deskripsi_pakan' => $this->deskripsi_pakan,
        ]);

        session()->flash('message', $this->pakan_id ? 'Data updated successfully.' : 'Data added successfully.');

        $this->closeModal();
        $this->resetCreateForm();
    }

    public function edit($id)
    {
        $pakan = Pakan::findOrFail($id);
        $this->pakan_id = $id;
        $this->nama_pakan = $pakan->nama_pakan;
        $this->deskripsi_pakan = $pakan->deskripsi_pakan;
    
        $this->openModal();
    }

    public function delete($id)
    {
        Pakan::find($id)->delete();
        session()->flash('message', 'Data deleted successfully.');
    }
}
