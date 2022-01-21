<x-slot name="header">
    <h2 class="text-center">Data Pakan</h2>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
            <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3"
                role="alert">
                <div class="flex">
                    <div>
                        <p class="text-sm">{{ session('message') }}</p>
                    </div>
                </div>
            </div>
            @endif
            <button wire:click="create()" class="btn-success font-bold py-2 px-4 rounded my-3">Tambah Data</button>
            @if($isModalOpen)
            @include('livewire.pakan-create')
            @endif
            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2">No.</th>
                        <th class="px-4 py-2">Nama Pakan</th>
                        <th class="px-4 py-2">Deskripsi Pakan</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pakan as $post)
                    <tr>
                        <td class="border px-4 py-2">{{ $post->id }}</td>
                        <td class="border px-4 py-2">{{ $post->nama_pakan }}</td>
                        <td class="border px-4 py-2">{{ $post->deskripsi_pakan}}</td>
                        <td class="border px-4 py-2">
                            <button wire:click="edit({{ $post->id }})"
                                class="btn btn-primary  text-white font-bold py-2 px-4 rounded">Edit</button>
                            <button wire:click="delete({{ $post->id }})"
                                class="btn btn-danger hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Hapus</button>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>