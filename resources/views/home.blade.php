@extends('layouts.app')

@section('title', 'Beranda')

@section('breadcrumbs')
<section class="content-header">
    <h1> Blank page <small>it all starts here</small> </h1>
    <ol class="breadcrumb">
        <li>
            <a href="#"><i class="fa fa-dashboard"></i>Home</a>
        </li>
        <li>
            <a href="#">Examples</a>
        </li>
        <li class="active">Blank page</li>
    </ol>
</section>
@endsection

@section('content')
<section class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">DATA HARI INI</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="info-box bg-aqua">
                                <span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">{{ $row_ini->nama }}</span>
                                    <span class="info-box-number">Total terjual {{ $row_ini->total }} Buah ({{ $rumus }}%)</span>

                                    <div class="progress">
                                        <div class="progress-bar" style="width: 70%"></div>
                                    </div>
                                    <span class="progress-description">
                                       @currency($row_ini->harga_total) (70%)
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">DATA 7 HARI TERAKHIR</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="info-box bg-green">
                                <span class="info-box-icon"><i class="fa fa-thumbs-o-up"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">INNOVA</span>
                                    <span class="info-box-number">41,410</span>
                                    <div class="progress">
                                        <div class="progress-bar" style="width: 70%"></div>
                                    </div>
                                    <span class="progress-description">
                                        70% Increase in 30 Days
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
