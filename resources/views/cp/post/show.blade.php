@extends('layouts.cp')

@section('title')
    <div class="section-header-back">
      <a href="{{ route('cp.posts.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>Detail Berita</h1>
@endsection

@section('content')
<h2 class="section-title">
    {{ $post->title }}
</h2>
<div class="row">
    <div class="col-8">
        <div class="card">
            <div class="card-body">
                {!! $post->description !!}
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card">
            <div class="card-header">
                <h4 class="text-black-50">Meta</h4>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-12">Published At</dt>
                    <dd class="col-12">{{ $post->created_at->format('d F Y') }}</dd>

                    <dt class="col-12">Cover</dt>
                    <dd class="col-12">
                        @if ($post->cover)
                            <img src="{{ asset($post->cover) }}" class="img-fluid" alt="">
                        @else
                            -
                        @endif
                    </dd>
                </dl>
            </div>
        </div>
    </div>
</div>
@endsection
