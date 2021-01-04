@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
    <h4>{{ $title }}</h4>
        <div class="btn-group">
            <button type="button" class="btn btn-default">Left</button>
            <button type="button" class="btn btn-default">Middle</button>
            <button type="button" class="btn btn-default">Right</button>
        </div>
        <p>
        <div class="btn-group">     
            <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>               
            <a href="{{url('master/kategori/add')}}" class="btn btn-flat btn-sm btn-primary "><i class="fa fa-plus"></i> Tambah</a>
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
                            <th>Nama Kategori</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $e=>$dt)
                        <tr>
                            <td>{{$e+1}}</td>
                            <td>{{ $dt -> nama}}</td>
                            <td>{{date('y M d H:i:s',strtotime( $dt -> created_at))}}</td>
                            <td>
                                <div style="width:60px">
                                    <a href="{{ url('master/kategori/'.$dt->id)}}" class="btn btn-warning btn-xs btn-edit" id="edit"><i class="fa fa-pencil-square-o"></i></a>
                                    <button href="{{ url('master/kategori/'.$dt->id)}}" class="btn btn-danger btn-hapus btn-xs" id="delete"><i class="fa fa-trash-o"></i></button></div>
                                </td>
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
