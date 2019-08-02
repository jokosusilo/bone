@extends('layouts.cp')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-danger">
                <i class="fas fa-newspaper"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Berita</h4>
                </div>
                <div class="card-body">
                    {{ $count['post'] }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-dark">
                <i class="far fa-paper-plane"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Hubungi Kami</h4>
                </div>
                <div class="card-body">
                    {{ $count['contact'] }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
