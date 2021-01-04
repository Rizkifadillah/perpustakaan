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
            @if(\Auth::user()->status ==1)
            <a href="{{url('master/buku/add')}}" class="btn btn-flat btn-sm btn-primary "><i class="fa fa-plus"></i> Tambah</a>
            @endif
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
                            @if(\Auth::user()->status ==1)
                            <th>Status</th>
                            @endif
                            <th>Pinjam</th>
                            <th>Gambar</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Penulis</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th>Created At</th>
                            @if(\Auth::user()->status ==1)
                            <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $e=>$dt)
                        <tr>
                            <td>{{$e+1}}</td>

                            @if(\Auth::user()->status ==1)
                            <td>
                                @if($dt->status == 1)
                                <a href="{{ url('master/buku/status'.$dt->id)}}" class="btn btn-danger btn-xs">Non-Aktifkan</a>
                                @else
                                <a href="{{ url('master/buku/status'.$dt->id)}}" class="btn btn-success btn-xs ">Aktifkan</a>
                                @endif
                            </td>
                            @endif
                            <td>
                                <a href="{{ url('pinjam-buku/'.$dt->id)}}" class="btn btn-info btn-xs ">Pinjam Buku</a>
                            </td>
                            <td>
                                <img src="{{asset('uploads/'.$dt->gambar)}}" style="width:50px; height:50px" alt="">
                            </td>
                            <td>{{ $dt -> judul}}</td>
                            <td>{{ $dt ->kategori_r-> nama}}</td>
                            <td>{{ $dt -> penulis}}</td>
                            <td>{{ $dt -> stock}}</td>
                            <td>
                                <label for="" class="label {{ ($dt->status == 1) ? 'label-success' : 'label-danger'}}">{{ ($dt->status == 1) ? 'Aktif' : 'Tidak Aktif'}}</label>
                            </td>
                            <td>{{date('y M d H:i:s',strtotime( $dt -> created_at))}}</td>
                            @if(\Auth::user()->status ==1)
                            <td>
                                <div style="width:60px">
                                    <a href="{{ url('master/buku/'.$dt->id)}}" class="btn btn-warning btn-xs btn-edit" id="edit"><i class="fa fa-pencil-square-o"></i></a>
                                    <button href="{{ url('master/buku/'.$dt->id)}}" class="btn btn-danger btn-hapus btn-xs" id="delete"><i class="fa fa-trash-o"></i></button></div>
                            </td>
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
