<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Peminjaman;

class Peminjaman_controller extends Controller
{

    public function index(){
        $title='Halaman Peminjaman Buku All';

        if(\Auth::user()->status==1){
            $data = Peminjaman::get();
        }else{
            $data = Peminjaman::where('user',\Auth::user()->id)->get();
        }

        return view('peminjaman.index',compact('title','data'));
    }

    public function store($id){

        $cek = \DB::table('m_buku')->where('id',$id)->where('stock','>',0)->where('status',1)->count();

        if($cek > 0){
            \DB::table('peminjaman')->insert([
                'buku' => $id,
                'user' => \Auth::user()->id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            $buku=\DB::table('m_buku')->where('id',$id)->first();

            $qty_buku = $buku->stock;
            $qty_new = $qty_buku - 1;

            \DB::table('m_buku')->where('id',$id)->update([
                'stock'=>$qty_new
            ]);

            \Session::flash('sukses','Pinjaman Berhasil ditambah');

            return redirect('master/buku');
        }else{
            \Session::flash('gagal','Buku sudah habis atau tidak aktif');

            return redirect('master/buku');

        }

    }

    public function setujui($id){
        Peminjaman::where('id',$id)->update([
            'status'=>1
        ]);
        return redirect('pinjam-buku');
    }

    public function tolak($id){
        Peminjaman::where('id',$id)->update([
            'status'=>2
        ]);
        return redirect('pinjam-buku');
    }
}
