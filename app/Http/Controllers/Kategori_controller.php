<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Kategori_controller extends Controller
{
    public function index(){
        $title='List Kategori';
        $data = \DB::table('m_kategori')->get();

        return view('kategori.index',compact('title','data'));
    }
    public function add(){
        $title='Tambah Kategori';

        return view('kategori.add',compact('title'));
    }

    public function store(Request $request){
        $nama = $request->nama;

        \DB::table('m_kategori')->insert([
            'nama'=>$nama,
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s')
        ]);
            \Session::flash('sukses','Kategori Berhasil ditambah');
        return redirect('master/kategori');

    }

    public function edit($id){
        $dt = \DB::table('m_kategori')->where('id', $id)->first();
        $title='Edit Kategori';

        return view('kategori.edit',compact('title','dt'));
    }

    public function update(Request $request,$id){
        $this->validate($request,[
            'nama'=>'required',
        ]);

        $data['nama'] = $request->nama;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        \Session::flash('sukses','Data berhasil di Update');
        \DB::table('m_kategori')->where('id', $id)->update($data);
        // User::where('id',$id)->update($data);

        return redirect('master/kategori');
    }

    public function delete($id){
        try {
            \DB::table('m_kategori')->where('id',$id)->delete();
        
            \Session::flash('sukses','Data berhasil di hapus');
    
        } catch(\Exception $e){
            \Session::flash('gagal', $e->getMessage());
        }
        return redirect('master/kategori');
    }
}
