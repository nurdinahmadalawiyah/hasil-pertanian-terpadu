<?php

namespace App\Http\Livewire;

use App\Models\Kolam;
use Livewire\Component;

class KolamCrud extends Component
{
    public $kolam, $nama_ikan, $deskripsi_ikan, $kolam_id;
    public $isModalOpen = 0;

    public function render()
    {
        $this->kolam = Kolam::all();
        return view('livewire.kolam-crud');
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
        $this->nama_ikan = '';
        $this->deskripsi_ikan = '';
    }

    public function store()
    {
        $this->validate([
            'nama_ikan' => 'required',
            'deskripsi_ikan' => 'required',
        ]);
    
        Kolam::updateOrCreate(['id' => $this->kolam_id], [
            'nama_ikan' => $this->nama_ikan,
            'deskripsi_ikan' => $this->deskripsi_ikan,
        ]);

        session()->flash('message', $this->kolam_id ? 'Data updated successfully.' : 'Data added successfully.');

        $this->closeModal();
        $this->resetCreateForm();
    }

    public function edit($id)
    {
        $kolam = Kolam::findOrFail($id);
        $this->kolam_id = $id;
        $this->nama_ikan = $kolam->nama_ikan;
        $this->deskripsi_ikan = $kolam->deskripsi_ikan;
    
        $this->openModal();
    }

    public function delete($id)
    {
        Kolam::find($id)->delete();
        session()->flash('message', 'Data deleted successfully.');
    }
}
