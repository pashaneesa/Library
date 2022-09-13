<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PeminjamanBuku;
use App\Models\DetailPeminjamanBuku;
use App\Models\PengembalianBuku;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    public function showPinjamBuku()
    {
        $buku = PeminjamanBuku::all()->toArray();
        return $buku;
    }

    public function detPinjamBuku($id)
    {
        // $buku = PeminjamanBuku::find($id);
        // return $buku;

        if(DetailPeminjamanBuku::where('id_dpbuku', $id)->exists()) {
            $data = DetailPeminjamanBuku::join('peminjaman_buku', 'peminjaman_buku.id_pbuku', 'detail_peminjaman.id_dpbuku')
            ->where('detail_peminjaman.id_dpbuku', '=', $id)
            ->get();
            return Response()->json($data);
        }
        else {
            return Response()->json(['message' => 'Tidak ditemukan' ]);
        }
    }

    public function detKembaliBuku($id)
    {
        // $buku = PeminjamanBuku::find($id);
        // return $buku;

        if(PengembalianBuku::where('id_kbuku', $id)->exists()) {
            $data = PengembalianBuku::join('peminjaman_buku', 'peminjaman_buku.id_pbuku', 'pengembalian_buku.id_pbuku')
            ->where('pengembalian_buku.id_kbuku', '=', $id)
            ->get();
            return Response()->json($data);
        }
        else {
            return Response()->json(['message' => 'Tidak ditemukan' ]);
        }
    }

    public function pinjamBuku(Request $request)
    {
        $validator=Validator::make($request->all(),
        [
            'id_siswa' => 'required',
            'tgl_pinjam' => 'required',
            'tgl_kembali' => 'required'
        ]);
        if($validator->fails()) {
            return Response()->json($validator->errors());
        }
        $simpan = PeminjamanBuku::create([
            'id_siswa' => $request->id_siswa,
            'tgl_pinjam' => $request->tgl_pinjam,
            'tgl_kembali' => $request->tgl_kembali
        ]);
        if($simpan)
        {
            return Response()->json(['status' => 1]);
        }
        else
        {
            return Response()->json(['status' => 0]);
        }
    }

    public function tambahItem(Request $req, $id)
    {
        $validator = Validator::make($req->all(),[
            'id_buku'=>'required',
            'qty'=>'required'
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $save = DetailPeminjamanBuku::create([
            'id_pbuku' =>$id,
            'id_buku' =>$req->id_buku,
            'qty' =>$req->qty,
        ]);
        if($save){
            return Response()->json(['status'=>1]);
        } else {
            return Response()->json(['status'=>0]);
        }
    }

    public function kembaliBuku(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'id_pbuku'=>'required'
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $cek_kembali=PengembalianBuku::where('id_pbuku',$req->id_pbuku);
        if($cek_kembali->count() == 0){
            $dt_kembali = PeminjamanBuku::where('id_pbuku',$req->id_pbuku)->first();
            $tanggal_sekarang = Carbon::now()->format('Y-m-d');
            $tanggal_kembali = new Carbon($dt_kembali->tgl_kembali);
            $dendaperhari = 1500;
            if(strtotime($tanggal_sekarang) > strtotime($tanggal_kembali)){
                $jumlah_hari = $tanggal_kembali->diff($tanggal_sekarang)->days;
                $denda = $jumlah_hari*$dendaperhari;
            }else {
                $denda = 0;
            }
            $save = PengembalianBuku::create([
                'id_pbuku' => $req->id_pbuku,
                'tgl_kembali' => $tanggal_sekarang,
                'denda' => $denda,
            ]);
            if($save){
                $data['status'] = 1;
                $data['message'] = 'Berhasil dikembalikan';
            } else {
                $data['status'] = 0;
                $data['message'] = 'Pengembalian gagal';
            }
        } else {
            $data = ['status'=>0,'message'=> 'Sudah pernah dikembalikan'];
        }
        return response()->json($data);
    }

}
