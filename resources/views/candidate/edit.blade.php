<x-app>
    <x-slot name="header">
        <div class="col-sm-6">
            <h3 class="mb-0">Edit Candidate</h3>
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
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs5.css" rel="stylesheet">
    </x-slot>

    <x-slot name="script">
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
            });
        </script>
    </x-slot>

    <div class="col-12 col-md-6">
        <div class="card">
            <div class="card-header bg-brown">
                <h3 class="card-title">Edit a Candidate Form</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('edit.candidate', ['candidate' => $candidate->uuid]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row g-4">
                        <div class="col-12">
                            <x-input value="{{ $candidate->order }}" type="number" name="order" id="order" label="Candidate Number" placeholder="Candidate Number" />
                        </div>
                        <div class="col-12">
                            <x-input value="{{ $candidate->name }}" type="text" name="name" id="name" label="Name" placeholder="Full Name" />
                        </div>
                        <div class="col-12">
                            <x-textarea value="{!! $candidate->visi !!}" name="visi" id="visi" label="Visi" />
                        </div>
                        <div class="col-12">
                            <x-textarea value="{!! $candidate->misi !!}" name="misi" id="misi" label="Misi" />
                        </div>
                        <div class="col-12">
                            <x-textarea value="{!! $candidate->program !!}" name="program" id="program" label="Program Unggulan" />
                        </div>
                        <div class="col-12">
                            <x-input type="file" name="photo" id="photo" label="Photo" />
                        </div>
                        <div class="col-12">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-between">
                                <a href="{{ route('candidate') }}" class="btn btn-secondary">Cancel</a>
                                <button class="btn btn-beige">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app>
