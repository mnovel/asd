<x-app>
    <x-slot name="header">
        <div class="col-sm-6">
            <h3 class="mb-0">Participant Class</h3>
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

    <x-slot name="style">
        <link rel="stylesheet" href="https://cdn.datatables.net/2.1.7/css/dataTables.bootstrap5.css">
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

    <div class="col-12 col-md-4">
        <div class="card">
            <div class="card-header bg-brown">
                <h3 class="card-title">Create a Class Form</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('create.class') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-12">
                            <x-input type="text" name="name" id="name" label="Name" placeholder="Class Name" />
                        </div>
                        <div class="col-12">
                            <x-input type="number" name="max_user" id="max_user" label="Max User" placeholder="Maximum Registered Users" />
                        </div>
                        <div class="col-12">
                            <x-select name="session" id="session" label="Session">
                                @foreach ($session as $sessionItem)
                                    <option value="{{ $sessionItem->id }}"{{ $sessionItem->id == old('session') ? 'selected' : '' }}>{{ $sessionItem->name }}</option>
                                @endforeach
                            </x-select>
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
                <h3 class="card-title">Table Class</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Class Name</th>
                                <th>Session</th>
                                <th>Max User</th>
                                <th>Total User</th>
                                <th>Total Unverified Users</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($classes as $index => $classesItem)
                                <tr class="align-middle">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ ucwords($classesItem->name) }}</td>
                                    <td>{{ $classesItem->votingSession->name }}</td>
                                    <td>{{ $classesItem->max_user }}</td>
                                    <td>{{ $classesItem->users->count() }}</td>
                                    <td>{{ $classesItem->users->where('status_id', 1)->count() }}</td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm ">
                                            <a href="{{ route('participant.class.edit', ['classes' => $classesItem->id]) }}" class="btn btn-warning">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <a href="{{ route('delete.class', ['classes' => $classesItem->id]) }}" class="btn btn-danger" data-confirm-delete="true">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </a>
                                            <a href="{{ route('participant.activation', ['class' => $classesItem->id]) }}" class="btn btn-primary">
                                                <i class="fa-solid fa-check-to-slot"></i>
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
