@extends('navbar')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Pointage</div>

                    <div class="card-body">
                        <video id="preview"></video>
                    </div>

                    <form id="pointageForm" method="POST" action="{{ route('pointage.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="qrCodeMethod">Méthode de pointage:</label>
                            <select class="form-control" id="qrCodeMethod" name="qrCodeMethod">
                                <option value="scanner">Scanner le QR code</option>
                                <option value="copier">Copier l'URL du QR code</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="https://cdn.rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script type="text/javascript">
        let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
        scanner.addListener('scan', function (content) {
            if ($('#qrCodeMethod').val() === 'scanner') {
                $.ajax({
                    url: '{{ route("pointage.store") }}',
                    type: 'POST',
                    data: {
                        qrCodeUrl: content,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        alert(response.success);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert(jqXHR.responseJSON.error);
                    },
                });
            } else {
                $('#qrCodeUrl').val(content);
            }
        });
        Instascan.Camera.getCameras().then(function (cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                console.error('No cameras found.');
            }
        }).catch(function (e) {
            console.error(e);
        });

        $('#qrCodeMethod').change(function() {
            if ($(this).val() === 'copier') {
                $('#qrCodeUrlInput').show();
            } else {
                $('#qrCodeUrlInput').hide();
            }
        });
    </script>
@endsection
