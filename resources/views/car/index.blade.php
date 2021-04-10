@extends('layouts.app')

@section('title', 'List Mobil')

@section('breadcrumbs')
<section class="content-header">
    <h1>
        Mobil
        <small>List Data</small>
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('home') }}"> <i class="fa fa-dashboard"></i> Home</a>
        </li>
        <li class="active">List Mobil</li>
    </ol>
</section>
@endsection

@section('content')
<section class="content">
    <div class="box box-info">
        <div class="box-header with-border">
            <button type="button" class="btn btn-info btn-add">
                Tambah Data
            </button>
        </div>
        @if(Session::has('message'))
            {!! Session::get('message') !!}
        @endif
        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th style="width: 10px">No</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th style="width: 40px">Action</th>
                    </tr>
                    @forelse ($result as $key => $val)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $val->nama }}</td>
                            <td>@currency($val->harga)</td>
                            <td>{{ $val->stok }}</td>
                            <td>
                                <a href="#" class="btn btn-info btn-xs btn-edit" key="{{ $val->id }}"><i class="fa fa-pencil"></i> edit </a> &nbsp;
                                <form action="{{ route('car.destroy') }}" method="POST" class="form-horizontal">
                                    @csrf
                                    <input type="hidden" name="car_id" value="{{ $val->id }}">
                                    <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Yakin Hapus Mobil ini... ?')"> <i class="fa fa-trash"></i> Delete </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">:: data kosong ::</td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix">
            {{ $result->links() }}
        </div>
    </div>

    <div class="modal fade" id="modal-tambah">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Default Modal</h4>
                </div>
                <form class="form-horizontal" method="POST" action="{{ route('car.store') }}">
                    @csrf
                    <input type="hidden" name="car_id" id="car_id" value="">
                    <div class="modal-body">
                        <div class="box-body">
                            <div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
                                <label for="" class="col-sm-2 control-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" value="{{ old('nama') }}" class="form-control" id="nama" name="nama" placeholder="Masukan Nama Mobil">
                                    @if($errors->has('nama'))
                                        <span class="help-block">{{ $errors->first('nama') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('harga') ? ' has-error' : '' }}">
                                <label for="" class="col-sm-2 control-label">Harga</label>
                                <div class="col-sm-10">
                                    <input type="text" value="{{ old('harga') }}" class="form-control" id="harga" name="harga" placeholder="Masukan Harga Mobil">
                                    @if($errors->has('harga'))
                                        <span class="help-block">{{ $errors->first('harga') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('stok') ? ' has-error' : '' }}">
                                <label for="" class="col-sm-2 control-label">Stok</label>
                                <div class="col-sm-10">
                                    <input type="number" value="{{ old('stok') }}" class="form-control" name="stok" id="stok" placeholder="Masukan Stok Mobil">
                                    @if($errors->has('stok'))
                                        <span class="help-block">{{ $errors->first('stok') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"> Simpan </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
    <script type="text/javascript">
         $(document).ready(function() {
            @if($errors->first('nama') || $errors->first('harga') || $errors->first('stok')) {
                $("#modal-tambah").modal('show');
            }
            @endif

            $(".btn-add").click(function(){
                $(".modal-title").html('Tambah Mobil');
                $("#modal-tambah").modal('show');
                $("#car_id").val('');
                $("#nama").val('');
                $("#harga").val('');
                $("#stok").val('');
            });

            $(".btn-edit").click(function(){
                var carid = $(this).attr('key');
                caridata(carid);
            });
        });

        function caridata(id){
			$.ajax({
				url: "/admins/car-edit",
				type: "POST",
				data: { id : id },
				dataType: "json",
				cache: false,
				success: function(response){
                    $("#car_id").val(response.data.id);
                    $("#nama").val(response.data.nama);
                    $("#harga").val(response.data.harga);
                    $("#stok").val(response.data.stok);

                    $("#modal-tambah").modal('show');
                    $(".modal-title").html('Edit Mobil');
				}
			});
		}
    </script>
@endpush

