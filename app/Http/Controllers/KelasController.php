<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use Illuminate\Support\Facades\Validator;

class KelasController extends Controller
{
    public function show()
    {
        $kelas = Kelas::all()->toArray();
        return $kelas;
    }

    public function detail($id)
    {
        $kelas = Kelas::find($id);
        return $kelas;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_kelas' => 'required',
            'kelompok' => 'required'
        ]);
        if($validator->fails()) {
            return response()->json($validator->errors());
        }
        $kelas = Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'kelompok' => $request->kelompok
        ]);
        if($kelas) {
            return response()->json(['status' => 1]);
        } else {
            return response()->json(['status' => 0]);
        }
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_kelas' => 'required',
            'kelompok' => 'required',
        ]);
        $kelas = Kelas::find($id);
        $kelas->update($request->all());
        if($kelas) {
            return response()->json(['status' => 1]);
        } else {
            return response()->json(['status' => 0]);
        }
    }

    public function destroy($id)
    {
        $kelas = Kelas::find($id);
        $kelas->delete();
        if($kelas) {
            return response()->json(['status' => 1]);
        } else {
            return response()->json(['status' => 0]);
        }
    }
}
