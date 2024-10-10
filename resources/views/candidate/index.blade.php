<x-app>
    <x-slot name="header">
        <div class="col-sm-6">
            <h3 class="mb-0">Candidate</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    Candidate
                </li>
            </ol>
        </div>
    </x-slot>

    <x-slot name="style">
        <link rel="stylesheet" href="https://cdn.datatables.net/2.1.7/css/dataTables.bootstrap5.css">
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs5.css" rel="stylesheet">
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
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs5.js"></script>

        <script>
            $(document).ready(function() {
                function initializeSummernote(selector) {
                    $(selector).summernote({
                        'toolbar': [
                            ['undo', ['undo']],
                            ['redo', ['redo']],
                            ['style', ['bold', 'italic', 'underline']],
                            ['para', ['ol']]
                        ],
                        tabsize: 2,
                        height: 100
                    });
                }

                initializeSummernote('#visi');
                initializeSummernote('#misi');
                initializeSummernote('#program');

                $('#table').DataTable({
                    columnDefs: [{
                        targets: '_all',
                        className: 'dt-head-left dt-body-left'
                    }]
                });
            });
        </script>
    </x-slot>

    <div class="col-12 col-md-4">
        <div class="card">
            <div class="card-header bg-brown">
                <h3 class="card-title">Create a Candidate Form</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('create.candidate') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-12">
                            <x-input type="number" name="order" id="order" label="Candidate Number" placeholder="Candidate Number" />
                        </div>
                        <div class="col-12">
                            <x-input type="text" name="name" id="name" label="Name" placeholder="Full Name" />
                        </div>
                        <div class="col-12">
                            <x-textarea name="visi" id="visi" label="Visi" />
                        </div>
                        <div class="col-12">
                            <x-textarea name="misi" id="misi" label="Misi" />
                        </div>
                        <div class="col-12">
                            <x-textarea name="program" id="program" label="Program Unggulan" />
                        </div>
                        <div class="col-12">
                            <x-input type="file" name="photo" id="photo" label="Photo" />
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
    <div class="col-12 col-md-8">
        <div class="card">
            <div class="card-header bg-brown">
                <h3 class="card-title">Table Candidate</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table">
                        <thead>
                            <tr class="text-center">
                                <th>Candidate Number</th>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Visi</th>
                                <th>Misi</th>
                                <th>Program Unggulan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($candidate as $candidateItem)
                                <tr>
                                    <td class="text-center">{{ $candidateItem->order }}</td>
                                    <td><img src="{{ url($candidateItem->photo) }}" alt="{{ $candidateItem->name }}" class="responsive mx-auto d-block"></td>
                                    <td>{{ $candidateItem->name }}</td>
                                    <td>{!! $candidateItem->visi !!}</td>
                                    <td>{!! $candidateItem->misi !!}</td>
                                    <td>{!! $candidateItem->program !!}</td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm ">
                                            <a href="{{ route('candidate.edit', ['candidate' => $candidateItem->uuid]) }}" class="btn btn-warning">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <a href="{{ route('delete.candidate', ['candidate' => $candidateItem->uuid]) }}" class="btn btn-danger" data-confirm-delete="true">
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
