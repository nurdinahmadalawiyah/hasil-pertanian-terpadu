<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\KolamResource;
use App\Models\Kolam;
use Validator;

class KolamController extends Controller
{
    public function index()
    {
        $data = Kolam::latest()->get();
        return response()->json([KolamResource::collection($data), 'Kolam fetched.']);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nama_ikan' => 'required|string|max:255',
            'deskripsi_ikan' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $kolam = Kolam::create([
            'nama_ikan' => $request->nama_ikan,
            'deskripsi_ikan' => $request->deskripsi_ikan
        ]);

        return response()->json(['Kolam created successfully.', new KolamResource($kolam)]);
    }

    public function show($id)
    {
        $kolam = Kolam::find($id);
        if (is_null($kolam)) {
            return response()->json('Data not found', 404);
        }
        return response()->json([new KolamResource($kolam)]);
    }

    public function update(Request $request, Kolam $kolam)
    {
        $validator = Validator::make($request->all(),[
            'nama_ikan' => 'required|string|max:255',
            'deskripsi_ikan' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $kolam->nama_ikan = $request->nama_ikan;
        $kolam->deskripsi_ikan = $request->deskripsi_ikan;
        $kolam->save();
        
        return response()->json(['Kolam updated successfully.', new KolamResource($kolam)]);
    }

    public function destroy(Kolam $kolam)
    {
        $kolam->delete();

        return response()->json('Kolam deleted successfully');
    }
}
