@extends('layouts.cp')

@section('title', 'Backup')

@section('content')
<div class="d-flex justify-content-between align-items-start mb-2">
    <h2 class="section-title m-0 mb-4">
        Data Backup
    </h2>
    <a href="{{ route('cp.backups.create') }}" class="btn btn-primary">
        Create New Backup
    </a>
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
                                <th class="table-fit">Disk</th>
                                <th>Date</th>
                                <th class="table-fit">File size</th>
                                <th class="table-fit">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($backups as $backup)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="table-fit">{{ $backup['disk'] }}</td>
                                    <td>{{ $backup['file_date'] }}</td>
                                    <td class="table-fit">{{ $backup['file_size'] }}</td>
                                    <td class="table-fit">
                                        <form id="form-action" method="POST" action="{{ route('cp.backups.destroy') }}" accept-charset="UTF-8">
                                            @csrf
                                            <input type="hidden" name="disk" value="{{ $backup['disk'] }}">
                                            <input type="hidden" name="file_path" value="{{ $backup['file_path'] }}">

                                            <div>
                                                <a href="{{ route('cp.backups.download', ['disk' => $backup['disk'], 'filename' => $backup['file_name']]) }}" class="btn">
                                                    <i class="fa fa-cloud-download-alt"></i> Download
                                                </a>
                                                <div class="bullet"></div>
                                                <button type="submit" class="btn btn-default text-danger" onclick="return confirm('Anda yakin akan menghapus data ?');">
                                                    <i class="fa fa-trash"></i> Delete
                                                </button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection