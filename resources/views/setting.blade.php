<x-app>
    <x-slot name="header">
        <div class="col-sm-6">
            <h3 class="mb-0">Setting</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    Setting
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

                $('#time').val('{{ Carbon::parse($setting->open)->format('m/d/Y h:i A') . ' - ' . Carbon::parse($setting->close)->format('m/d/Y h:i A') }}');
            })
        </script>
    </x-slot>

    <div class="col-12 col-md-6">
        <div class="card">
            <div class="card-header bg-brown">
                <h3 class="card-title">Edit Setting Form</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('edit.setting', ['setting' => $setting->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row g-4">
                        <div class="col-12">
                            <x-input :value="$setting->app_name" type="text" name="app_name" id="app_name" label="App Name" placeholder="App Name" />
                        </div>
                        <div class="col-12">
                            <x-input :value="$setting->instansi" type="text" name="instansi" id="instansi" label="Instansi" placeholder="Instansi" />
                        </div>
                        <div class="col-12">
                            <x-input :value="$setting->author" type="text" name="author" id="author" label="Author" placeholder="Author" />
                        </div>
                        <div class="col-12">
                            <x-textarea :value="$setting->description" name="description" id="description" label="Description" />
                        </div>
                        <div class="col-12">
                            <x-textarea :value="$setting->keywords" name="keywords" id="keywords" label="Keywords" />
                        </div>
                        <div class="col-12">
                            <x-input type="text" name="time" id="time" label="Time Schedule" />
                        </div>
                        <div class="col-12">
                            <div class="d-grid gap-2">
                                <button class="btn btn-beige" type="submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app>
