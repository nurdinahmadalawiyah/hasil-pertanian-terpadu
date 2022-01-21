<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\TernakResource;
use App\Models\Ternak;
use Validator;

class TernakController extends Controller
{
    public function index()
    {
        $data = Ternak::latest()->get();
        return response()->json([TernakResource::collection($data), 'Ternak fetched.']);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nama_ternak' => 'required|string|max:255',
            'deskripsi_ternak' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $ternak = Ternak::create([
            'nama_ternak' => $request->nama_ternak,
            'deskripsi_ternak' => $request->deskripsi_ternak
        ]);

        return response()->json(['Ternak created successfully.', new TernakResource($ternak)]);
    }

    public function show($id)
    {
        $ternak = Ternak::find($id);
        if (is_null($ternak)) {
            return response()->json('Data not found', 404);
        }
        return response()->json([new TernakResource($ternak)]);
    }

    public function update(Request $request, Ternak $ternak)
    {
        $validator = Validator::make($request->all(),[
            'nama_ternak' => 'required|string|max:255',
            'deskripsi_ternak' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $ternak->nama_ternak = $request->nama_ternak;
        $ternak->deskripsi_ternak = $request->deskripsi_ternak;
        $ternak->save();
        
        return response()->json(['Ternak updated successfully.', new TernakResource($ternak)]);
    }

    public function destroy(Ternak $ternak)
    {
        $ternak->delete();

        return response()->json('Ternak deleted successfully');
    }
}
