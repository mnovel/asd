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
                // const readerElement = document.getElementById("reader");
                // let isProcessing = false; // Flag untuk mencegah spam POST

                // function onScanSuccess(decodedText, decodedResult) {
                //     if (isProcessing) {
                //         return; // Jangan lakukan apapun jika request sedang diproses
                //     }

                //     isProcessing = true; // Set flag menjadi true untuk mencegah request lain

                //     var data = {
                //         'session_id': '{{ $votingSession->id }}',
                //         'user_id': decodedResult.text
                //     };

                //     $.ajax({
                //         type: "POST",
                //         url: "{{ route('create.precence') }}",
                //         data: data,
                //         dataType: "json",
                //         success: function(response) {
                //             console.log('Presence created successfully:', response);
                //             isProcessing = false; // Reset flag setelah request berhasil
                //         },
                //         error: function(xhr, status, error) {
                //             console.error('Error creating presence:', error);
                //             isProcessing = false; // Reset flag jika terjadi error
                //         }
                //     });
                // }

                // function onScanFailure(error) {
                //     console.warn(`Code scan error = ${error}`);
                // }

                // const html5QrcodeScanner = new Html5QrcodeScanner(
                //     readerElement.id, {
                //         fps: 10,
                //         qrbox: {
                //             width: 300,
                //             height: 300
                //         }
                //     },
                //     false
                // );

                // html5QrcodeScanner.render(onScanSuccess, onScanFailure);


                function onScanSuccess(decodedText, decodedResult) {
                    if (decodedText !== lastResult) {
                        ++countResults;
                        lastResult = decodedText;
                        console.log(`Scan result ${decodedText}`, decodedResult);
                    }
                }

                var html5QrcodeScanner = new Html5QrcodeScanner(
                    "reader", {
                        fps: 10,
                        qrbox: 250
                    });
                html5QrcodeScanner.render(onScanSuccess);
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
