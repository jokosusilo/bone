@extends('layouts.cp')

@section('title', 'Berita')

@section('content')
<div class="d-flex justify-content-between align-items-start mb-2">
    <h2 class="section-title m-0 mb-4">
        Data Berita
    </h2>
    <a href="{{ route('cp.posts.create') }}" class="btn btn-primary">Add New</a>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="table-fit">#</th>
                                <th>Title</th>
                                <th class="table-fit">Published At</th>
                                <th class="table-fit">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $rowNumber = ($posts->currentpage()-1) * $posts->perpage() + 1;
                            @endphp
                            @forelse ($posts as $post)
                                <tr>
                                    <td class="table-fit">{{ $rowNumber++ }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->created_at->format('d F Y') }}</td>
                                    <td class="table-fit">
                                        <form id="form-action" method="POST" action="{{ route('cp.posts.destroy', $post) }}" accept-charset="UTF-8">
                                            @method('DELETE')
                                            @csrf

                                            <div class="table-links">
                                                <a href="{{ route('cp.posts.show', $post) }}">Detail</a>
                                                <div class="bullet"></div>
                                                <a href="{{ route('cp.posts.edit', $post) }}">Edit</a>
                                                <div class="bullet"></div>
                                                <button type="submit" class="btn text-danger btn-link" onclick="return confirm('Anda yakin akan menghapus data ?');">
                                                    Delete
                                                </button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada data.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{ $posts->links('cp.pagination.default') }}
    </div>
</div>
@endsection
