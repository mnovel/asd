<x-app>
    <x-slot name="header">
        <div class="col-sm-6">
            <h3 class="mb-0">User</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="#">Participant</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    User
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
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Create a User Form</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('create.user') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-12">
                            <x-input type="text" name="name" id="name" label="Name" placeholder="Full Name" />
                        </div>
                        <div class="col-12">
                            <x-select name="class" id="class" label="Class">
                                @foreach ($class as $classItem)
                                    <option value="{{ $classItem->id }}" {{ old('class') == $classItem->id ? 'selected' : '' }}>{{ $classItem->name }}</option>
                                @endforeach
                            </x-select>
                        </div>
                        <div class="col-12">
                            <x-input type="email" name="email" id="email" label="Email" placeholder="Email" />
                        </div>
                        <div class="col-12">
                            <x-input type="password" name="password" id="password" label="Password" placeholder="Password" />
                        </div>
                        <div class="col-12">
                            <div class="d-grid gap-2">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-8">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Table User</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Class</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $index => $userItem)
                                <tr class="align-middle">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ ucwords($userItem->name) }}</td>
                                    <td>{{ $userItem->email }}</td>
                                    <td>{{ $userItem->class->name }}</td>
                                    <td>{{ $userItem->status->name }}</td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm ">
                                            <a href="{{ route('participant.user.edit', ['user' => $userItem->uuid]) }}" class="btn btn-warning">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <a href="{{ route('delete.user', ['user' => $userItem->uuid]) }}" class="btn btn-danger" data-confirm-delete="true">
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
