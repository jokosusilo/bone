@extends('layouts.cp')

@section('title', 'Setting')

@section('content')
<div class="row">
    <div class="col-12">
        <form id="setting-form" action="{{ route('cp.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <p class="text-muted">General settings.</p>

            <div class="form-group row align-items-center">
                <label for="name" class="form-control-label col-sm-2 text-md-right">Nama Website</label>
                <div class="col-sm-6 col-md-6">
                    <input type="text" id="name" name="setting[name]" class="form-control" value="{{ data_get($setting, 'name') }}">
                </div>
            </div>
            <div class="form-group row align-items-center">
                <label for="tagline" class="form-control-label col-sm-2 text-md-right">Tagline</label>
                <div class="col-sm-6 col-md-6">
                    <input type="text" id="tagline" name="setting[tagline]" class="form-control" value="{{ data_get($setting, 'tagline') }}">
                </div>
            </div>
            <div class="form-group row align-items-center">
                <label for="site_description" class="form-control-label col-sm-2 text-md-right">Deskripsi Website</label>
                <div class="col-sm-6 col-md-6">
                    <textarea id="site_description" name="setting[description]" class="form-control" rows="3" style="height: auto;">{{ data_get($setting, 'description') }}</textarea>
                </div>
            </div>
            <div class="form-group row align-items-center">
                <label for="address" class="form-control-label col-sm-2 text-md-right">Alamat</label>
                <div class="col-sm-6 col-md-6">
                    <textarea id="address" name="setting[address]" class="form-control" rows="3" style="height: auto;">{{ data_get($setting, 'address') }}</textarea>
                </div>
            </div>
            <div class="form-group row align-items-center">
                <label for="phone" class="form-control-label col-sm-2 text-md-right">Telepon</label>
                <div class="col-sm-6 col-md-6">
                    <input type="text" id="phone" name="setting[phone]" class="form-control" value="{{ data_get($setting, 'phone') }}">
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
