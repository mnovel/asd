<x-app>
    <x-slot name="header">
        <div class="col-sm-6">
            <h3 class="mb-0">DPT</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    DPT
                </li>
            </ol>
        </div>
    </x-slot>

    <div class="col-12 col-md-6">
        <div class="card">
            <div class="card-header bg-brown">
                <h3 class="card-title">Participant Information</h3>
            </div>
            <div class="card-body">
                <div class="row g-4">
                    <div class="col-12 col-lg-4">
                        <img src="data:image/png;base64,  {!! base64_encode(
                            QrCode::format('png')->size(500)->generate($user->uuid),
                        ) !!} " class="img-fluid rounded mx-auto d-block">
                    </div>
                    <div class="col-12 col-md-8">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th class="col-3">Name</th>
                                    <td class="col-1">:</td>
                                    <td>{{ ucwords($user->name) }}</td>
                                </tr>
                                <tr>
                                    <th class="col-3">NIS</th>
                                    <td class="col-1">:</td>
                                    <td>{{ ucwords($user->nis) }}</td>
                                </tr>
                                <tr>
                                    <th class="col-3">Email</th>
                                    <td class="col-1">:</td>
                                    <td>{{ ucwords($user->email) }}</td>
                                </tr>
                                <tr>
                                    <th class="col-3">Class</th>
                                    <td class="col-1">:</td>
                                    <td>{{ ucwords($user->class->name) }}</td>
                                </tr>
                                <tr>
                                    <th class="col-3">Account Status</th>
                                    <td class="col-1">:</td>
                                    <td>{{ ucwords($user->status->name) }}</td>
                                </tr>
                                <tr>
                                    <th class="col-3">Session</th>
                                    <td class="col-1">:</td>
                                    <td>{{ ucwords($user->class->votingSession->name) }}</td>
                                </tr>
                                <tr>
                                    <th class="col-3">Date</th>
                                    <td class="col-1">:</td>
                                    <td>{{ ucwords(Carbon::parse($user->class->votingSession->open)->format('d F Y')) }}</td>
                                </tr>
                                <tr>
                                    <th class="col-3">Time</th>
                                    <td class="col-1">:</td>
                                    <td>{{ ucwords(Carbon::parse($user->class->votingSession->open)->format('h:i A')) . '-' . ucwords(Carbon::parse($user->class->votingSession->close)->format('h:i A')) }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app>
