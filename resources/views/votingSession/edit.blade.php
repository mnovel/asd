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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    </x-slot>

    <x-slot name="script">
        <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
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

    <div class="col-12 col-md-6">
        <div class="card card-primary">
            <div class="card-header">
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
                            <x-input
                                value="{{ \Carbon\Carbon::parse($votingSession->open)->format('d/m/Y h:i A') . '-' . \Carbon\Carbon::parse($votingSession->close)->format('d/m/Y h:i A') }}"
                                type="text" name="time" id="time" label="Time Schedule" />
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
                            <div class="d-grid gap-2 d-md-flex justify-content-md-between">
                                <a href="{{ route('tps') }}" class="btn btn-outline-secondary">Cancel</a>
                                <button class="btn btn-outline-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app>
