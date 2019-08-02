@extends('layouts.cp')

@section('title', 'Setting')

@section('content')
<h2 class="section-title">Hi, {{ Auth::user()->name }}!</h2>
<p class="section-lead">
    Change information about yourself on this page.
</p>
<div class="row">
    <div class="col-12">
        <form id="setting-form" action="{{ route('cp.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group row align-items-center">
                <label for="name" class="form-control-label col-sm-2 text-md-right">Name</label>
                <div class="col-sm-6 col-md-6">
                    <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}">
                </div>
            </div>
            <div class="form-group row align-items-center">
                <label for="email" class="form-control-label col-sm-2 text-md-right">Email</label>
                <div class="col-sm-6 col-md-6">
                    <input type="email" id="email" name="email" class="form-control" value="{{ $user->email }}">
                </div>
            </div>
            <div class="form-group row align-items-center">
                <label for="username" class="form-control-label col-sm-2 text-md-right">Username</label>
                <div class="col-sm-6 col-md-6">
                    <input type="text" id="username" name="username" class="form-control" value="{{ $user->username }}">
                </div>
            </div>

            <div class="form-group row align-items-center">
                <div class="col-sm-6 col-md-6 offset-md-2">
                    <button class="btn btn-primary" id="save-btn">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('script')
    <script>
        CKEDITOR.replace('about_description', config);
    </script>
@endpush
