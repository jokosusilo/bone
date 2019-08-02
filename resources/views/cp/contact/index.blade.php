@extends('layouts.cp')

@section('title', 'Hubungi Kami')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body p-0">
                <table class="table table-striped table-md">
                    <thead>
                        <tr>
                            <th class="table-fit">#</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th class="table-fit">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $rowNumber = ($contacts->currentpage()-1) * $contacts->perpage() + 1;
                        @endphp
                        @forelse ($contacts as $contact)
                            <tr>
                                <td>{{ $rowNumber++ }}</td>
                                <td>{{ $contact->name }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>{{ $contact->subject }}</td>
                                <td class="table-fit">{{ $contact->created_at->format('d F Y    ') }}</td>
                                <td class="table-fit">{{ $contact->created_at->format('H:i') }}</td>
                                <td class="table-fit">
                                    <form id="form-action" method="POST" action="{{ route('cp.contacts.destroy', $contact) }}" accept-charset="UTF-8">
                                        <input name="_method" type="hidden" value="DELETE">
                                        <input name="_token" type="hidden" value="{{ csrf_token() }}">

                                        <div class="table-links">
                                            <a href="{{ route('cp.contacts.show', $contact) }}">Detail</a>
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
                                <td colspan="6" class="text-center">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        {{ $contacts->links('cp.pagination.default') }}
    </div>
</div>
@endsection
