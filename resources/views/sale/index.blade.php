@extends('layouts.app')

@section('title', 'List Mobil')

@section('breadcrumbs')
<section class="content-header">
    <h1>
        Penjualan
        <small>List Data</small>
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('home') }}"> <i class="fa fa-dashboard"></i> Home</a>
        </li>
        <li class="active">List Penjualan</li>
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
                        <th>Email</th>
                        <th>No HP</th>
                        <th>Mobil</th>
                        <th style="width: 40px">Action</th>
                    </tr>
                    @forelse ($result as $key => $val)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $val->nama }}</td>
                            <td>{{ $val->email }}</td>
                            <td>{{ $val->no_hp }}</td>
                            <td>{{ $val->car->nama }}</td>
                            <td>
                                <a href="#" class="btn btn-info btn-xs btn-edit" key="{{ $val->id }}"><i class="fa fa-pencil"></i> edit </a> &nbsp;
                                <form action="{{ route('sale.destroy') }}" method="POST" class="form-horizontal">
                                    @csrf
                                    <input type="hidden" name="sale_id" value="{{ $val->id }}">
                                    <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Yakin Hapus Penjualan ini... ?')"> <i class="fa fa-trash"></i> Delete </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">:: data kosong ::</td>
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
                <form class="form-horizontal" method="POST" action="{{ route('sale.store') }}">
                    @csrf
                    <input type="hidden" name="sale_id" id="sale_id" value="">
                    <div class="modal-body">
                        <div class="box-body">
                            <div class="form-group {{ $errors->has('tanggal_jual') ? 'has-error' : '' }}">
                                <label for="" class="col-sm-2 control-label">Tanggal Pelaksanaan</label>
                                <div class="col-sm-10">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right datepicker" name="tanggal_jual" id="tanggal_jual" value="{{ old('tanggal_jual') }}" autocomplete="off">
                                    </div>
                                    @if($errors->has('tanggal_jual'))
                                        <span class="help-block">{{ $errors->first('tanggal_jual') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
                                <label for="" class="col-sm-2 control-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" value="{{ old('nama') }}" class="form-control" id="nama" name="nama" placeholder="Masukan Nama Pembeli">
                                    @if($errors->has('nama'))
                                        <span class="help-block">{{ $errors->first('nama') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="" class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" value="{{ old('email') }}" class="form-control" id="email" name="email" placeholder="Masukan Email Pembeli">
                                    @if($errors->has('email'))
                                        <span class="help-block">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('no_hp') ? ' has-error' : '' }}">
                                <label for="" class="col-sm-2 control-label">No HP</label>
                                <div class="col-sm-10">
                                    <input type="number" value="{{ old('no_hp') }}" class="form-control" name="no_hp" id="no_hp" placeholder="Masukan No Telepon Pembeli">
                                    @if($errors->has('no_hp'))
                                        <span class="help-block">{{ $errors->first('stok') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('car_id') ? ' has-error' : '' }}">
                                <label for="" class="col-sm-2 control-label">Mobil</label>
                                <div class="col-sm-10">
                                    {!! form_dropdown('car_id', $arr_car, old('car_id'), 'class="form-control" id="car_id"') !!}
                                    @if($errors->has('car_id'))
                                        <span class="help-block">{{ $errors->first('car_id') }}</span>
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
            $('.datepicker').datepicker({
                autoclose: true,
                format:'yyyy-mm-dd'
            });

            @if($errors->first('nama') || $errors->first('email') || $errors->first('no_hp') ||$errors->first('car_id')) {
                $("#modal-tambah").modal('show');
            }
            @endif

            $(".btn-add").click(function(){
                $(".modal-title").html('Tambah Penjualan');
                $("#modal-tambah").modal('show');
                $("#sale_id").val('');
                $("#tanggal_jual").val('');
                $("#nama").val('');
                $("#email").val('');
                $("#no_hp").val('');
                $("#car_id").val('');
            });

            $(".btn-edit").click(function(){
                var saleid = $(this).attr('key');
                caridata(saleid);
            });
        });

        function caridata(id){
			$.ajax({
				url: "/admins/sale-edit",
				type: "POST",
				data: { id : id },
				dataType: "json",
				cache: false,
				success: function(response){
                    $("#sale_id").val(response.data.id);
                    $("#nama").val(response.data.nama);
                    $("#email").val(response.data.email);
                    $("#tanggal_jual").val(response.data.tanggal_jual);
                    $("#no_hp").val(response.data.no_hp);
                    $("#car_id").val(response.data.car_id);

                    $("#modal-tambah").modal('show');
                    $(".modal-title").html('Edit Penjualan');
				}
			});
		}
    </script>
@endpush

