@extends('navbar')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-success">
                QR Code
            </div>
            <div class="card-body text-center">
                {{ $qrCode }}
            </div>
        </div>
    </div>
@endsection
