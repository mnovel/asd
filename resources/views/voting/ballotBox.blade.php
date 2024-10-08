<x-app>
    <x-slot name="header">
        <div class="col-sm-6">
            <h3 class="mb-0">Ballot Box</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#">Voting</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    Ballot Box
                </li>
            </ol>
        </div>
    </x-slot>

    <x-slot name="style">
        <link rel="stylesheet" href="https://cdn.datatables.net/2.1.7/css/dataTables.bootstrap5.css">
        <style>
            .responsive {
                width: 100%;
                max-width: 200px;
                height: auto;
            }
        </style>
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
        <div class="card card-primary">
            <div class="card-header text-center">
                <h4 class="fw-bolder">DAFTAR CALON KANDIDAT KETUA OSIS</h4>
                <h4 class="fw-bolder">SMA NEGERI 1 PASURUAN</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($candidate as $candidateItem)
                        <div class="col">
                            <div class="card card-primary">
                                <div class="card-header text-center">
                                    <h5 class="fw-bolder">{{ strtoupper($candidateItem->name) }}</h5>
                                </div>
                                <div class="card-body">
                                    <img src="{{ asset($candidateItem->photo) }}" alt="{{ $candidateItem->name }}" class="responsive rounded mx-auto d-block" width="600"
                                        height="400">
                                    <div class="d-grid gap-2 mt-3">
                                        <a href="{{ route('create.voting', ['candidate' => $candidateItem->uuid, 'user' => $user->uuid]) }}" class="btn btn-lg btn-primary"
                                            type="button">(Klik/Pilih) -
                                            CALON
                                            NO {{ $candidateItem->order }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app>
