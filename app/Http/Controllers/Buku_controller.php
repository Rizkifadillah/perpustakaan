<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\M_buku;


class Buku_controller extends Controller
{
    public function index(){
        $title='List Buku';
        $data = M_buku::get();
        // $data = \DB::table('m_buku as b')->join('m_kategori as k', 'b.kategori','=','k.id')->select('b.gambar','b.judul','k.nama','b.penulis','b.stock','b.created_at','b.id','b.status')->get();

        return view('buku.index',compact('title','data'));
    }

    public function kosong(){
            $title='List Buku Kosong';
            // $data = \DB::table('m_buku as b')->join('m_kategori as k', 'b.kategori','=','k.id')->select('b.gambar','b.judul','k.nama','b.penulis','b.stock','b.created_at','b.id','b.status')->where('b.stock','<',1)->get();
            $data= M_buku::where('stock','<',1)->get();
            return view('buku.index',compact('title','data'));
            
    }

    public function non(){
        $title='List Buku Non-Aktif';
        $data = \DB::table('m_buku as b')->join('m_kategori as k', 'b.kategori','=','k.id')->select('b.gambar','b.judul','k.nama','b.penulis','b.stock','b.created_at','b.id','b.status')->where('b.status','!=',1)->get();

        return view('buku.index',compact('title','data'));
        
}

    public function add(){
        $title='Tambah buku';
        $kategori = \DB::table('m_kategori')->get();

        return view('buku.add',compact('title','kategori'));
    }

    public function store(Request $request){
        $judul = $request->judul;
        $keterangan = $request->keterangan;
        $stock = $request->stock;
        $kategori = $request->kategori;
        $penulis = $request->penulis;

        $file = $request->file('image');

        $destinationPath = 'uploads';
        $file->move($destinationPath,$file->getClientOriginalName());

        \DB::table('m_buku')->insert([
            'judul'=>$judul,
            'keterangan'=>$keterangan,
            'stock'=>$stock,
            'kategori'=>$kategori,
            'penulis'=>$penulis,
            'gambar'=>$file->getClientOriginalName(),
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s')
        ]);
            \Session::flash('sukses','Kategori Berhasil ditambah');
        return redirect('master/buku');

    }

    public function edit($id){
        $dt = \DB::table('m_buku')->where('id', $id)->first();
        $title='Edit Buku';
        $kategori = \DB::table('m_kategori')->get();


        return view('buku.edit',compact('title','dt','kategori'));
    }

    public function update(Request $request,$id){
        $judul = $request->judul;
        $keterangan = $request->keterangan;
        $stock = $request->stock;
        $kategori = $request->kategori;
        $penulis = $request->penulis;

        $file = $request->file('image');
        
        
        if($file){
            \DB::table('m_buku')->where('id',$id)->update([
                'judul'=>$judul,
                'keterangan'=>$keterangan,
                'stock'=>$stock,
                'kategori'=>$kategori,
                'penulis'=>$penulis,
                'gambar'=>$file->getClientOriginalName(),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            $destinationPath = 'uploads';
            $file->move($destinationPath,$file->getClientOriginalName());
        }else{
            \DB::table('m_buku')->where('id',$id)->update([
                'judul'=>$judul,
                'keterangan'=>$keterangan,
                'stock'=>$stock,
                'kategori'=>$kategori,
                'penulis'=>$penulis,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }

        \Session::flash('sukses','Data berhasil di Update');

        return redirect('master/buku');
    }

    public function delete($id){
        try {
            \DB::table('m_buku')->where('id',$id)->delete();
        
            \Session::flash('sukses','Data berhasil di hapus');
    
        } catch(\Exception $e){
            \Session::flash('gagal', $e->getMessage());
        }
        return redirect('master/buku');
    }

    public function status($id){
        try {
            $data = \DB::table('m_buku')->where('id',$id)->first();

            $status_sekarang = $data->status;

            if($status_sekarang == 1){
                \DB::table('m_buku')->where('id',$id)->update([
                    'status'=>0
                ]);
            }else{
                \DB::table('m_buku')->where('id',$id)->update([
                    'status'=>1
                ]);
            }
        
            \Session::flash('sukses','Data berhasil di hapus');
    
        } catch(\Exception $e){
            \Session::flash('gagal', $e->getMessage());
        }
        return redirect('master/buku');
    }

    
}