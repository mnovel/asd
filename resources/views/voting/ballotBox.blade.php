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

    <div class="col-12">
        <div class="card">
            <div class="card-header text-center bg-beige">
                <h4 class="fw-bolder">DAFTAR CALON KANDIDAT KETUA OSIS</h4>
                <h4 class="fw-bolder">{{ strtoupper(GlobalHelper::setting('instansi')) }}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($candidate as $candidateItem)
                        <div class="col">
                            <div class="card h-100">
                                <div class="card-header text-center bg-brown">
                                    <h5 class="fw-bolder">{{ strtoupper($candidateItem->name) }}</h5>
                                </div>
                                <div class="card-body">
                                    <img src="{{ asset($candidateItem->photo) }}" alt="{{ $candidateItem->name }}" class="responsive rounded mx-auto d-block" width="600"
                                        height="400">
                                </div>
                                <div class="card-footer bg-transparent">
                                    <div class="d-grid gap-2">
                                        <a href="{{ route('create.voting', ['candidate' => $candidateItem->uuid, 'user' => $user->uuid]) }}" class="btn btn-lg btn-beige fw-bolder"
                                            type="button">
                                            (Klik/Pilih)
                                            - CALON NO {{ $candidateItem->order }}
                                        </a>
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
