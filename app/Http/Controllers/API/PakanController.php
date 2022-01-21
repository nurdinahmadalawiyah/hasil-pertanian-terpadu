<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\PakanResource;
use App\Models\Pakan;
use Validator;

class PakanController extends Controller
{
    public function index()
    {
        $data = Pakan::latest()->get();
        return response()->json([PakanResource::collection($data), 'Pakan fetched.']);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nama_pakan' => 'required|string|max:255',
            'deskripsi_pakan' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $pakan = Pakan::create([
            'nama_pakan' => $request->nama_pakan,
            'deskripsi_pakan' => $request->deskripsi_pakan
        ]);

        return response()->json(['Pakan created successfully.', new PakanResource($pakan)]);
    }

    public function show($id)
    {
        $pakan = Pakan::find($id);
        if (is_null($pakan)) {
            return response()->json('Data not found', 404);
        }
        return response()->json([new PakanResource($pakan)]);
    }

    public function update(Request $request, Pakan $pakan)
    {
        $validator = Validator::make($request->all(),[
            'nama_pakan' => 'required|string|max:255',
            'deskripsi_pakan' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $pakan->nama_pakan = $request->nama_pakan;
        $pakan->deskripsi_pakan = $request->deskripsi_pakan;
        $pakan->save();
        
        return response()->json(['Pakan updated successfully.', new PakanResource($pakan)]);
    }

    public function destroy(Pakan $pakan)
    {
        $pakan->delete();

        return response()->json('Pakan deleted successfully');
    }
}
