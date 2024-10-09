<x-app>
    <x-slot name="header">
        <div class="col-sm-6">
            <h3 class="mb-0">Registration</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    Registration
                </li>
            </ol>
        </div>
    </x-slot>

    <x-slot name="style">
        <link rel="stylesheet" href="https://cdn.datatables.net/2.1.7/css/dataTables.bootstrap5.css">
    </x-slot>

    <x-slot name="script">
        <script src="https://cdn.datatables.net/2.1.7/js/dataTables.js"></script>
        <script src="https://cdn.datatables.net/2.1.7/js/dataTables.bootstrap5.js"></script>
        <script>
            $(document).ready(function() {
                $('#table').DataTable({
                    columnDefs: [{
                        targets: '_all',
                        className: 'dt-head-left dt-body-left'
                    }]
                });
            })
        </script>
    </x-slot>

    <div class="col-12">
        <div class="card">
            <div class="card-header bg-brown">
                <h3 class="card-title">Table Voting Session</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Name</th>
                                <th>Schedule</th>
                                <th>Class</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($votingSession as $index => $votingSessionItem)
                                <tr class="align-middle">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ ucwords($votingSessionItem->name) }}</td>
                                    <td>{{ Carbon::parse($votingSessionItem->open)->format('d F Y') }} (
                                        {{ Carbon::parse($votingSessionItem->open)->format('h:i A') . ' - ' . Carbon::parse($votingSessionItem->close)->format('h:i A') }})
                                    </td>
                                    <td>{{ $votingSessionItem->class->pluck('name')->implode(', ') }}</td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm ">
                                            <a href="{{ route('registration.scan', ['votingSession' => $votingSessionItem->id]) }}" class="btn btn-success"
                                                data-confirm-delete="true">
                                                <i class="fa-solid fa-users-viewfinder"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app>
