@extends('layouts.cp')

@section('title')
    <div class="section-header-back">
      <a href="{{ route('cp.posts.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>Edit Berita</h1>
@endsection

@section('content')
<form action="{{ route('cp.posts.update', $post) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-black-50">Konten</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Judul</label>
                        <input type="text" id="title" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" autofocus="" value="{{ $post->title }}">
                        @include('cp.components.form-error', ['field' => 'title'])
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <textarea id="description" cols="30" rows="10" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" style="height: auto;" name="description">{{ $post->description }}</textarea>
                        @include('cp.components.form-error', ['field' => 'description'])
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-black-50">Meta</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Cover</label>
                        <div class="mb-2">
                            <img src="{{ asset($post->cover) }}" class="img-fluid" alt="" id="upload-img-preview">
                            <a href="#" class="text-danger" id="upload-img-delete" style="display: none;">Delete Cover Image</a>
                        </div>
                        <div class="custom-file">
                            <input type="file" accept="image/*" name="cover" id="cover" class="custom-file-input js-upload-image form-control{{ $errors->has('cover') ? ' is-invalid' : '' }}">
                            <label class="custom-file-label " for="cover">Choose file</label>
                            @include('cp.components.form-error', ['field' => 'cover'])
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-whitesmoke">
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>
                    <a href="{{ route('cp.posts.index') }}" class="btn btn-secondary">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
