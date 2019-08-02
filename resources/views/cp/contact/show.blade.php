@extends('layouts.cp')

@section('title')
    <div class="section-header-back">
      <a href="{{ route('cp.contacts.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>Detail Hubungi Kami</h1>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Pesan dikirim pada tanggal {{ $contact->created_at->format('d F Y') }} jam {{ $contact->created_at->format('H:i') }}</h4>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-2 text-right">Nama</dt>
                    <dd class="col-10">{{ $contact->name }}</dd>

                    <dt class="col-2 text-right">Email</dt>
                    <dd class="col-10">{{ $contact->email }}</dd>

                    <dt class="col-2 text-right">Subject</dt>
                    <dd class="col-10">{{ $contact->subject }}</dd>

                    <dt class="col-2 text-right">Message</dt>
                    <dd class="col-10">{{ $contact->message }}</dd>
                </dl>
            </div>
        </div>
    </div>
</div>
@endsection
