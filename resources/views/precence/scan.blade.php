<x-app>
    <x-slot name="header">
        <div class="col-sm-6">
            <h3 class="mb-0">Scan Registration - {{ $votingSession->name }}</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('registration') }}">Registration</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    Scan
                </li>
            </ol>
        </div>
    </x-slot>

    <x-slot name="script">
        <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const readerElement = document.getElementById("reader");

                function onScanSuccess(decodedText, decodedResult) {

                    var url = "{{ route('create.precence', ['session' => ':session', 'user' => ':user']) }}";
                    url = url.replace(':session', '{{ $votingSession->id }}').replace(':user', decodedText);

                    html5QrcodeScanner.clear().then(_ => {
                        window.location.href = url;
                    }).catch(error => {
                        console.error("Failed to clear QR code scanner.", error);
                    });
                }

                let html5QrcodeScanner = new Html5QrcodeScanner(
                    "reader", {
                        fps: 120,
                        qrbox: function(viewfinderWidth, viewfinderHeight) {
                            let minEdgePercentage = 0.7;
                            let qrboxSize = Math.floor(viewfinderWidth * minEdgePercentage);
                            return {
                                width: qrboxSize,
                                height: qrboxSize
                            };
                        }
                    },
                    false
                );

                html5QrcodeScanner.render(onScanSuccess);
            });
        </script>

    </x-slot>

    <div class="col-12 col-md-6">
        <div class="card">
            <div class="card-header bg-brown">
                <h3 class="card-title">Scan Precence</h3>
            </div>
            <div class="card-body">
                <div id="reader" class="img-fluid img-thumbnail"></div>
            </div>
        </div>
    </div>
</x-app>
