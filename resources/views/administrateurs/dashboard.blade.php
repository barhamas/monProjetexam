@extends('navbar')

@section('content')


                    <script>
                        setTimeout(function() {window.location.href = "{{ route('dashboard') }}";}, 1);
                    </script>

@endsection

