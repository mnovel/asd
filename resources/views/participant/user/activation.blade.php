<x-app>
    <x-slot name="header">
        <div class="col-sm-6">
            <h3 class="mb-0">User Activation</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="#">Participant</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    User Activation
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
                var table = $('#table').DataTable({
                    columnDefs: [{
                        targets: '_all',
                        className: 'dt-head-left dt-body-left'
                    }],
                    order: [
                        [4, 'asc'],
                        [2, 'asc']
                    ]
                });

                table
                    .on('order.dt search.dt', function() {
                        let i = 1;

                        table
                            .cells(null, 0, {
                                search: 'applied',
                                order: 'applied'
                            })
                            .every(function(cell) {
                                this.data(i++);
                            });
                    })
                    .draw();
            })

            $('#class').change(function(e) {
                var url = "{{ route('participant.activation', ['class' => ':class']) }}"
                url = url.replace(':class', $(this).val())
                window.location = url;
            });
        </script>
    </x-slot>

    <div class="col-12 col-md-4">
        <div class="card">
            <div class="card-header bg-brown">
                <h3 class="card-title">Filter Class</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('create.user') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-12">
                            <x-select name="class" id="class" label="Class">
                                <option value="all" {{ $class == 'all' ? 'selected' : '' }}>All</option>
                                @foreach ($classes as $classesItem)
                                    <option value="{{ $classesItem->id }}" {{ $class == $classesItem->id ? 'selected' : '' }}>{{ $classesItem->name }}</option>
                                @endforeach
                            </x-select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-8">
        <div class="card">
            <div class="card-header bg-brown">
                <h3 class="card-title">Table User</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Name</th>
                                <th>NIS</th>
                                <th>Email</th>
                                <th>Class</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $userItem)
                                <tr class="align-middle">
                                    <td></td>
                                    <td>{{ ucwords($userItem->name) }}</td>
                                    <td>{{ $userItem->nis }}</td>
                                    <td>{{ $userItem->email }}</td>
                                    <td>{{ $userItem->class->name }}</td>
                                    <td>{{ $userItem->status->name }}</td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm ">
                                            @if ($userItem->status_id == 1)
                                                <a href="{{ route('participant.activation.verify', ['user' => $userItem->uuid]) }}" class="btn btn-success">
                                                    <i class="fa-solid fa-check-to-slot"></i>
                                                </a>
                                            @endif
                                            @if ($userItem->status_id >= 3)
                                                <a href="{{ route('participant.user.reset', ['user' => $userItem->uuid]) }}" class="btn btn-warning">
                                                    <i class="fa-solid fa-rotate"></i>
                                                </a>
                                            @endif
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
