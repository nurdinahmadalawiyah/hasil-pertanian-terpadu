<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\TanamanResource;
use App\Models\Tanaman;
use Validator;
use Illuminate\Http\Request;

class TanamanController extends Controller
{
    public function index()
    {
        $data = Tanaman::latest()->get();

        return response()->json([TanamanResource::collection($data), 'Tanaman fetched.']);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nama_tanaman' => 'required|string|max:255',
            'deskripsi_tanaman' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $tanaman = Tanaman::create([
            'nama_tanaman' => $request->nama_tanaman,
            'deskripsi_tanaman' => $request->deskripsi_tanaman
        ]);

        return response()->json(['Tanaman created successfully.', new TanamanResource($tanaman)]);
    }

    public function show($id)
    {
        $tanaman = Tanaman::find($id);
        if (is_null($tanaman)) {
            return response()->json('Data not found', 404);
        }
        return response()->json([new TanamanResource($tanaman)]);
    }

    public function edit(Tanaman $tanaman)
    {
        return view('admin.tanaman.edit', compact('tanaman'));
    }

    public function update(Request $request, Tanaman $tanaman)
    {
        $validator = Validator::make($request->all(),[
            'nama_tanaman' => 'required|string|max:255',
            'deskripsi_tanaman' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $tanaman->nama_tanaman = $request->nama_tanaman;
        $tanaman->deskripsi_tanaman = $request->deskripsi_tanaman;
        $tanaman->save();
        
        return response()->json(['Tanaman updated successfully.', new TanamanResource($tanaman)]);
    }

    public function destroy(Tanaman $tanaman)
    {
        $tanaman->delete();

        return response()->json('Tanaman deleted successfully');
    }
}
