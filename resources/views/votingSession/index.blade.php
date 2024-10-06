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
        <link rel="stylesheet" href="https://cdn.datatables.net/2.1.7/css/dataTables.bootstrap5.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    </x-slot>

    <x-slot name="script">
        <script src="https://cdn.datatables.net/2.1.7/js/dataTables.js"></script>
        <script src="https://cdn.datatables.net/2.1.7/js/dataTables.bootstrap5.js"></script>
        <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#table').DataTable({
                    columnDefs: [{
                        targets: '_all',
                        className: 'dt-head-left dt-body-left'
                    }]
                });

                $('#time').daterangepicker({
                    timePicker: true,
                    locale: {
                        format: 'M/DD/YYYY hh:mm A'
                    }
                });

                $('#class').select2({
                    theme: "bootstrap-5",
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                    placeholder: $(this).data('placeholder'),
                    closeOnSelect: true,
                });
            })
        </script>
    </x-slot>

    <div class="col-12 col-md-4">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Create a Voting Session Form</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('create.votingSession') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-12">
                            <x-input type="text" name="name" id="name" label="Name" placeholder="Session Name" />
                        </div>
                        <div class="col-12">
                            <x-input type="text" name="time" id="time" label="Time Schedule" />
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="class" class="form-label">Class</label>
                                <select class="@error('class')is-invalid  @enderror" id="class" name="class[]" aria-invalid="true" data-placeholder="Choose..."
                                    style="width: 100%;" multiple>
                                    @foreach ($class as $classItem)
                                        <option value="{{ $classItem->id }}" {{ old('class') == $classItem->id ? 'selected' : '' }}>{{ $classItem->name }}</option>
                                    @endforeach
                                </select>
                                @error('class')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-grid gap-2">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-8">
        <div class="card card-primary">
            <div class="card-header">
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
                                    <td>{{ \Carbon\Carbon::parse($votingSessionItem->open)->format('d/m/Y h:i A') }} -
                                        {{ \Carbon\Carbon::parse($votingSessionItem->close)->format('d/m/Y h:i A') }}</td>
                                    <td>
                                        <ul>
                                            @foreach ($votingSessionItem->classes() as $class)
                                                <li> {{ $class->name }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm ">
                                            <a href="{{ route('votingSession.edit', ['votingSession' => $votingSessionItem->id]) }}" class="btn btn-warning">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <a href="{{ route('delete.votingSession', ['votingSession' => $votingSessionItem->id]) }}" class="btn btn-danger"
                                                data-confirm-delete="true">
                                                <i class="fa-solid fa-trash-can"></i>
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
