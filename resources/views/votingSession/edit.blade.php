<x-app>
    <x-slot name="header">
        <div class="col-sm-6">
            <h3 class="mb-0">Voting Session</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    Voting Session
                </li>
            </ol>
        </div>
    </x-slot>

    <x-slot name="style">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
    </x-slot>

    <x-slot name="script">
        <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#time').daterangepicker({
                    timePicker: true,
                    locale: {
                        format: 'M/DD/YYYY hh:mm A'
                    }
                });

                $('#time').val(
                    '{{ \Carbon\Carbon::parse($votingSession->open)->format('m/d/Y h:i A') . ' - ' . \Carbon\Carbon::parse($votingSession->close)->format('m/d/Y h:i A') }}');
            })
        </script>
    </x-slot>

    <div class="col-12 col-md-6">
        <div class="card">
            <div class="card-header bg-brown">
                <h3 class="card-title">Edit a Voting Session Form</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('edit.votingSession', ['votingSession' => $votingSession->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row g-4">
                        <div class="col-12">
                            <x-input value="{{ $votingSession->name }}" type="text" name="name" id="name" label="Name" placeholder="Session Name" />
                        </div>
                        <div class="col-12">
                            <x-input type="text" name="time" id="time" label="Time Schedule" />
                        </div>
                        <div class="col-12">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-between">
                                <a href="{{ route('votingSession') }}" class="btn btn-secondary">Cancel</a>
                                <button class="btn btn-beige">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app>
