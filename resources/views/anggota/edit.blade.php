@extends('layouts.master')
 
@section('content')
 
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h4>{{ $title }}</h4>
        <div class="box box-warning">
            <div class="box-header">
                <p>
                    <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>
                    <a href="{{ url('manage-anggota')}}" class="btn btn-sm btn-flat btn-success "><i class="fa fa-back"></i> Back</a>

                    @if ($errors->any())
                        <div class="alert alert-warning">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </p>
            </div>
            <div class="box-body">
               
            <form role="form" method="post" action="{{ url('manage-anggota/'.$dt->id)}}" >
                @csrf
                {{method_field('put')}}

              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Nama Anggota</label>
                  <input type="nama" class="form-control" value="{{$dt->name}}" name="name" id="" placeholder="Nama">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Email</label>
                  <input type="email" class="form-control" value="{{$dt->email}}" name="email" id="" placeholder="Nama">
                </div>
              </div>
              <!-- /.box-body -->
 
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Update</button>
              </div>
            </form>

            </div>
        </div>
    </div>
</div>
 
@endsection
 
@section('scripts')
 
<script type="text/javascript">
    $(document).ready(function(){
 
        // btn refresh
        $('.btn-refresh').click(function(e){
            e.preventDefault();
            $('.preloader').fadeIn();
            location.reload();
        })
 
    })
</script>
 
@endsection