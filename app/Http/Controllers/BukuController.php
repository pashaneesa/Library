<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use Illuminate\Support\Facades\Validator;
use Auth;

class BukuController extends Controller
{
    public function bookAuth() {
        $data = "Welcome " . Auth::user()->name;
        return response()->json($data, 200);
    }

    public function show()
    {
        $buku = Buku::all()->toArray();
        return $buku;
    }

    public function detail($id)
    {
        $buku = Buku::find($id);
        return $buku;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_buku' => 'required',
            'pengarang' => 'required',
            'deskripsi' => 'required'
        ]);
        if($validator->fails()) {
            return response()->json($validator->errors());
        }
        $buku = Buku::create([
            'nama_buku' => $request->nama_buku,
            'pengarang' => $request->pengarang,
            'deskripsi' => $request->deskripsi
        ]);
        if($buku) {
            return response()->json(['status' => 1]);
        } else {
            return response()->json(['status' => 0]);
        }
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_buku' => 'required',
            'pengarang' => 'required',
            'deskripsi' => 'required'
        ]);
        $buku = Buku::find($id);
        $buku->update($request->all());
        if($buku) {
            return response()->json(['status' => 1]);
        } else {
            return response()->json(['status' => 0]);
        }
    }

    public function destroy($id)
    {
        $buku = Buku::find($id);
        $buku->delete();
        if($buku) {
            return response()->json(['status' => 1]);
        } else {
            return response()->json(['status' => 0]);
        }
    }
}
