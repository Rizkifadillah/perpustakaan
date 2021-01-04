<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Peminjaman;
use App\User;

class Laporan_controller extends Controller
{
    public function index(){
        $title = 'List Laporan';
        $data = Peminjaman::get();
        $user = User::whereNull('status')->get();

        return view ('laporan.index',compact('title','data','user'));
    }

    public function periode(Request $request){
        $user = User::whereNull('status')->get();
        $dari = date('Y-m-d',strtotime($request->awal));
        $sampai =date('Y-m-d',strtotime($request->akhir));
        $users = $request->user;

        $title = "List Laporan dari tanggal $dari sampai tanggal $sampai dengan anggota $users";
        
        if($users=='all'){
            $data = Peminjaman::whereBetween('created_at',[$dari,$sampai])->get();

        }else{

            $data = Peminjaman::whereBetween('created_at',[$dari,$sampai])->where('user',$users)->get();
        }

        return view ('laporan.index',compact('title','data','user'));
   
    }
}
