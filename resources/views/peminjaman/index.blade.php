@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-md-12 ">
    <h4>{{ $title }}</h4>
        <div class="btn-group">
            <button type="button" class="btn btn-default">Left</button>
            <button type="button" class="btn btn-default">Middle</button>
            <button type="button" class="btn btn-default">Right</button>
        </div>
        <p>
        <div class="btn-group">
            <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>               
            <a href="{{url('master/buku/add')}}" class="btn btn-flat btn-sm btn-primary "><i class="fa fa-plus"></i> Tambah</a>
            <a href="{{url('master/buku')}}" class="btn btn-flat btn-sm btn-success "><i class="fa fa-book"></i> All Buku</a>
            <a href="{{url('master/buku/kosong')}}" class="btn btn-flat btn-sm btn-danger "><i class="fa fa-circle"></i> Buku Stok Habis</a>
            <a href="{{url('master/buku/non')}}" class="btn btn-flat btn-sm btn-info "><i class="fa fa-circle"></i> Buku Non-Aktif</a>
        </div>
        </p>
        <div class="box box-warning">
            <div class="box-header">

            </div>
            <div class="box-body">
                <table class=" table table-hover myTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>User</th>
                            <th>Buku</th>
                            <th>Created At</th>
                            <th>Status</th>
                            @if(\Auth::user()->status ==1)
                            <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $e=>$dt)
                        <tr>
                            <td>{{$e+1}}</td>
                            <td>
                                <img src="{{asset('uploads/'.$dt->buku_r->gambar)}}" style="width:50px; height:50px" alt="">
                            </td>
                            <td>{{ $dt -> user_r->name}}</td>
                            <td>{{ $dt -> buku_r->judul}}</td>
                            <td>{{date('y M d H:i:s',strtotime( $dt -> created_at))}}</td>
                            @if($dt->status == null)
                                <td><label for="" class="label label-warning">Menunggu Verifikasi</label></td>
                            @elseif($dt->status == 1)    
                                <td><label for="" class="label label-success">Disetujui</label></td>
                            @elseif($dt->status == 2)    
                                <td><label for="" class="label label-success">Ditolak</label></td>
                            @endif
                            @if(\Auth::user()->status ==1)
                                @if($dt->status == null)
                                <td>
                                    <div style="width:60px">
                                    <a href="{{ url('pinjam-buku/tolak/'.$dt->id)}}" class="btn btn-danger btn-xs btn-edit" id="edit"><i class="fa fa-check"></i>Tolak</a>
                                <a href="{{ url('pinjam-buku/setujui/'.$dt->id)}}" class="btn btn-info btn-xs btn-edit" id="edit"><i class="fa fa-check"></i>Setujui</a>
                                </td>
                                @elseif($dt->status == 1)    
                                <td>
                                    <div style="width:60px">
                                        <a href="{{ url('pinjam-buku/tolak/'.$dt->id)}}" class="btn btn-danger btn-xs btn-edit" id="edit"><i class="fa fa-check"></i>Tolak</a>
                                </td>
                                @elseif($dt->status == 2)    
                                <td>
                                    <div style="width:60px">
                                    <a href="{{ url('pinjam-buku/setujui/'.$dt->id)}}" class="btn btn-info btn-xs btn-edit" id="edit"><i class="fa fa-check"></i>Setujui</a>
                                </td>
                                @endif
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
 
<script type="text/javascript">
    $(document).ready(function(){

        
        var flash = "{{Session::has('sukses')}}";
        if(flash){
            var pesan = "{{Session::get('sukses')}}"
            alert("Sukses", pesan, "success");
        }

        var gagal = "{{Session::has('gagal')}}";
        if(gagal){
            var pesan = "{{Session::get('gagal')}}"
            alert("Error", pesan, "error");
        }
 
        // btn refresh
        $('.btn-refresh').click(function(e){
            e.preventDefault();
            $('.preloader').fadeIn();
            location.reload();
        })
 
    })
</script>
 
@endsection
