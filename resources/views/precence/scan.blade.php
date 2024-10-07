<x-app>
    <x-slot name="header">
        <div class="col-sm-6">
            <h3 class="mb-0">Scan Precence</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#">Precence</a></li>
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
                    alert(`Code matched = ${decodedText}`, decodedResult);
                    // Anda dapat menambahkan logika untuk memproses hasil di sini
                }

                function onScanFailure(error) {
                    console.warn(`Code scan error = ${error}`);
                }

                // Inisialisasi scanner
                const html5QrcodeScanner = new Html5QrcodeScanner(
                    readerElement.id, {
                        fps: 10,
                        qrbox: {
                            width: 300,
                            height: 300
                        }
                    },
                    false
                );
                // Mulai pemindaian
                html5QrcodeScanner.render(onScanSuccess, onScanFailure);
            });
        </script>

    </x-slot>

    <div class="col-12 col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Scan Precence</h3>
            </div>
            <div class="card-body">
                <div id="reader" class="img-fluid img-thumbnail"></div>
            </div>
        </div>
    </div>
</x-app>
