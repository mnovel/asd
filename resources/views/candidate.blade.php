<x-app>
    <x-slot name="header">
        <div class="col-sm-6">
            <h3 class="mb-0">Candidates</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    Candidates
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
                <div class="col-12">
                    <div class="card">
                        @foreach ($candidate as $index => $candidateItem)
                            <div class="col-12 col-md-6">
                                <div class="card">
                                    <div class="card-header text-center bg-brown">
                                        <h5 class="fw-bolder">{{ strtoupper($candidateItem->name) . ' - Kandidat ' . strtoupper($candidateItem->order) }}</h5>
                                    </div>
                                    <div class="card-body">
                                        <img src="{{ asset($candidateItem->photo) }}" alt="{{ $candidateItem->name }}" class="img-fluid rounded mx-auto d-block" width="600"
                                            height="400">
                                        <div class="accordion mt-4" id="accordionExample">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#visi-{{ $index + 1 }}"
                                                        aria-expanded="false" aria-controls="visi-{{ $index + 1 }}">
                                                        Visi
                                                    </button>
                                                </h2>
                                                <div id="visi-{{ $index + 1 }}" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        {!! $candidateItem->visi !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#misi-{{ $index + 1 }}"
                                                        aria-expanded="false" aria-controls="misi-{{ $index + 1 }}">
                                                        Misi
                                                    </button>
                                                </h2>
                                                <div id="misi-{{ $index + 1 }}" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        {!! $candidateItem->misi !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#program-{{ $index + 1 }}" aria-expanded="false" aria-controls="program-{{ $index + 1 }}">
                                                        Program Unggulan
                                                    </button>
                                                </h2>
                                                <div id="program-{{ $index + 1 }}" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        {!! $candidateItem->program !!}
                                                    </div>
                                                </div>
                                            </div>
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
