<x-app>
    <x-slot name="header">
        <div class="col-sm-6">
            <h3 class="mb-0">Edit Participant Class</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    Class
                </li>
            </ol>
        </div>
    </x-slot>

    <div class="col-12 col-md-6">
        <div class="card">
            <div class="card-header bg-brown">
                <h3 class="card-title">Edit a TPS Form</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('edit.tps', ['user' => $user->uuid]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row g-4">
                        <div class="col-12">
                            <x-input value="{{ $user->name }}" type="text" name="name" id="name" label="Name" placeholder="Full Name" />
                        </div>
                        <div class="col-12">
                            <x-input value="{{ $user->email }}" type="email" name="email" id="email" label="Email" placeholder="Email" />
                        </div>
                        <div class="col-12">
                            <x-input type="password" name="password" id="password" label="Password" placeholder="Password" />
                        </div>
                        <div class="col-12">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-between">
                                <a href="{{ route('tps') }}" class="btn btn-secondary">Cancel</a>
                                <button class="btn btn-beige">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app>
