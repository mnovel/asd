<x-app>
    <x-slot name="header">
        <div class="col-sm-6">
            <h3 class="mb-0">Edit Participant Class</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="#">Participant</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    Class
                </li>
            </ol>
        </div>
    </x-slot>

    <div class="col-12 col-md-6">
        <div class="card">
            <div class="card-header bg-brown">
                <h3 class="card-title">Edit a Class Form</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('edit.class', ['classes' => $classes->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row g-4">
                        <div class="col-12">
                            <x-input value="{{ $classes->name }}" type="text" name="name" id="name" label="Name" placeholder="Class Name" />
                        </div>
                        <div class="col-12">
                            <x-input value="{{ $classes->max_user }}" type="number" name="max_user" id="max_user" label="Max User" placeholder="Maximum Registered Users" />
                        </div>
                        <div class="col-12">
                            <x-select name="session" id="session" label="Session">
                                @foreach ($session as $sessionItem)
                                    <option value="{{ $sessionItem->id }}"{{ $sessionItem->id == (old('session') ?? $classes->session_id) ? 'selected' : '' }}>
                                        {{ $sessionItem->name }}
                                    </option>
                                @endforeach
                            </x-select>
                        </div>
                        <div class="col-12">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-between">
                                <a href="{{ route('participant.class') }}" class="btn btn-secondary">Cancel</a>
                                <button class="btn btn-beige">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app>
