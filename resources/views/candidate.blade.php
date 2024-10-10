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
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach ($candidate as $index => $candidateItem)
                        <div class="col">
                            <div class="card h-100">
                                <div class="card-header bg-brown text-center">
                                    <h5 class="fw-bolder">KANDIDAT {{ strtoupper($candidateItem->order) }}</h5>
                                    <h5 class="fw-bolder">{{ strtoupper($candidateItem->name) }}</h5>
                                </div>
                                <img src="{{ asset($candidateItem->photo) }}" alt="{{ $candidateItem->name }}" class="card-img-top">
                                <div class="card-body">
                                    <div class="accordion accordion-flush" id="accordionFlush-{{ $index + 1 }}">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#visi-{{ $index + 1 }}"
                                                    aria-expanded="false" aria-controls="visi-{{ $index + 1 }}">
                                                    VISI
                                                </button>
                                            </h2>
                                            <div id="visi-{{ $index + 1 }}" class="accordion-collapse collapse" data-bs-parent="#accordionFlush-{{ $index + 1 }}">
                                                <div class="accordion-body">{!! $candidateItem->visi !!}</div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#misi-{{ $index + 1 }}"
                                                    aria-expanded="false" aria-controls="misi-{{ $index + 1 }}">
                                                    MISI
                                                </button>
                                            </h2>
                                            <div id="misi-{{ $index + 1 }}" class="accordion-collapse collapse" data-bs-parent="#accordionFlush-{{ $index + 1 }}">
                                                <div class="accordion-body">{!! $candidateItem->misi !!}</div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#program-{{ $index + 1 }}"
                                                    aria-expanded="false" aria-controls="program-{{ $index + 1 }}">
                                                    PROGRAM UNGGULAN
                                                </button>
                                            </h2>
                                            <div id="program-{{ $index + 1 }}" class="accordion-collapse collapse" data-bs-parent="#accordionFlush-{{ $index + 1 }}">
                                                <div class="accordion-body">{!! $candidateItem->program !!}</div>
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
