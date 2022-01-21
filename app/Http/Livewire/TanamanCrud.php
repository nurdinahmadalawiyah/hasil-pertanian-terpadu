<?php

namespace App\Http\Livewire;

use App\Models\Tanaman;
use Livewire\Component;

class TanamanCrud extends Component
{
    public $tanaman, $nama_tanaman, $deskripsi_tanaman, $tanaman_id;
    public $isModalOpen = 0;

    public function render()
    {
        $this->tanaman = Tanaman::all();
        return view('livewire.tanaman-crud');
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
        $this->nama_tanaman = '';
        $this->deskripsi_tanaman = '';
    }

    public function store()
    {
        $this->validate([
            'nama_tanaman' => 'required',
            'deskripsi_tanaman' => 'required',
        ]);
    
        Tanaman::updateOrCreate(['id' => $this->tanaman_id], [
            'nama_tanaman' => $this->nama_tanaman,
            'deskripsi_tanaman' => $this->deskripsi_tanaman,
        ]);

        session()->flash('message', $this->tanaman_id ? 'Data updated successfully.' : 'Data added successfully.');

        $this->closeModal();
        $this->resetCreateForm();
    }

    public function edit($id)
    {
        $tanaman = Tanaman::findOrFail($id);
        $this->tanaman_id = $id;
        $this->nama_tanaman = $tanaman->nama_tanaman;
        $this->deskripsi_tanaman = $tanaman->deskripsi_tanaman;
    
        $this->openModal();
    }

    public function delete($id)
    {
        Tanaman::find($id)->delete();
        session()->flash('message', 'Data deleted successfully.');
    }
}
