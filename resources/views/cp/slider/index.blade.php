@extends('layouts.cp')

@section('title', 'Slider')

@section('content')
<div class="d-flex justify-content-between align-items-start mb-2">
    <h2 class="section-title m-0 mb-4">
        Data Slider
    </h2>
    <a href="{{ route('cp.sliders.create') }}" class="btn btn-primary">Add New</a>
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
                        <th style="width: 175px;">Image</th>
                        <th>Caption</th>
                        <th class="table-fit">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($sliders as $slider)
                        <tr>
                            <td class="table-fit">{{ $loop->iteration }}</td>
                            <td>
                                <img src="{{ asset($slider->image) }}" class="img-fluid my-2">
                            </td>
                            <td>{{ $slider->caption }}</td>
                            <td class="table-fit">
                                <form id="form-action" method="POST" action="{{ route('cp.sliders.destroy', $slider) }}" accept-charset="UTF-8">
                                    @method('DELETE')
                                    @csrf

                                    <div class="table-links">
                                        <a href="{{ route('cp.sliders.edit', $slider) }}">Edit</a>
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
  </div>
</div>
@endsection
