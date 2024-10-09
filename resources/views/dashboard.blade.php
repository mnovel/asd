<x-app>
    <x-slot name="header">
        <div class="col-sm-6">
            <h3 class="mb-0">Dashboard</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item active" aria-current="page">
                    Dashboard
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
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
        <script>
            const apiUrl = "{{ route('real-count') }}";

            fetch(apiUrl)
                .then(response => response.json())
                .then(data => {
                    const labels = data.map(item => item.name);
                    const votes = data.map(item => item.voting_count);


                    const ctx = document.getElementById('realCountChart').getContext('2d');
                    const realCountChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Total Votes',
                                data: votes,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    display: true,
                                    position: 'top',
                                },
                                tooltip: {
                                    enabled: true
                                }
                            }
                        }
                    });
                })
                .catch(error => console.error('Error fetching data:', error));
        </script>

        <script>
            $(document).ready(function() {
                var table = $('#table').DataTable({
                    columnDefs: [{
                        targets: '_all',
                        className: 'dt-head-left dt-body-left'
                    }],
                    order: [
                        [1, 'asc'],
                        [2, 'asc'],
                    ],
                    pageLength: 50,
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

                table.on('draw', function() {
                    var totalActiveCount = 0;
                    var totalVotersCount = 0;

                    $('#table tbody tr').each(function() {
                        var activeCount = parseInt($(this).find('td').eq(3).text());
                        var totalCount = parseInt($(this).find('td').eq(4).text());
                        var percentageCell = $(this).find('td').eq(5);

                        if (totalCount > 0) {
                            var percentage = (totalCount / activeCount) * 100;
                            percentageCell.text(percentage.toFixed(2) + '%');
                        } else {
                            percentageCell.text('0.00%');
                        }

                        totalActiveCount += activeCount;
                        totalVotersCount += totalCount;
                    });

                    $('#totalActive').text(totalActiveCount);
                    $('#totalVoters').text(totalVotersCount);
                    $('#totalPercentage').text((totalVotersCount / totalActiveCount * 100).toFixed(2) + '%');
                }).draw();
            });
        </script>
    </x-slot>

    <div class="col-12">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box text-bg-primary">
                    <div class="inner">
                        <h3>{{ $user->whereIn('status_id', ['2', '3', '4'])->count() }}</h3>
                        <p>Total Students</p>
                    </div>
                    <svg class="small-box-icon" fill="currentColor" viewBox="0 0 19 19" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path
                            d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4" />
                    </svg>
                    <a href="#" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">More info <i class="bi bi-link-45deg"></i> </a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box text-bg-success">
                    <div class="inner">
                        <h3>{{ $tps->count() }}</h3>
                        <p>Total TPS</p>
                    </div>
                    <svg class="small-box-icon" fill="currentColor" viewBox="0 -1 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path
                            d="M12.643 15C13.979 15 15 13.845 15 12.5V5H1v7.5C1 13.845 2.021 15 3.357 15zM5.5 7h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1M.8 1a.8.8 0 0 0-.8.8V3a.8.8 0 0 0 .8.8h14.4A.8.8 0 0 0 16 3V1.8a.8.8 0 0 0-.8-.8z" />
                    </svg>
                    <a href="#" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">More info <i class="bi bi-link-45deg"></i> </a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box text-bg-warning">
                    <div class="inner">
                        <h3>{{ $candidate->count() }}</h3>
                        <p>Total candidates</p>
                    </div>
                    <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path
                            d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z">
                        </path>
                    </svg>
                    <a href="#" class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">More info <i class="bi bi-link-45deg"></i> </a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box text-bg-danger">
                    <div class="inner">
                        <h3>{{ $voter->count() }}</h3>
                        <p>Total Voters</p>
                    </div>
                    <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path clip-rule="evenodd" fill-rule="evenodd" d="M2.25 13.5a8.25 8.25 0 018.25-8.25.75.75 0 01.75.75v6.75H18a.75.75 0 01.75.75 8.25 8.25 0 01-16.5 0z">
                        </path>
                        <path clip-rule="evenodd" fill-rule="evenodd" d="M12.75 3a.75.75 0 01.75-.75 8.25 8.25 0 018.25 8.25.75.75 0 01-.75.75h-7.5a.75.75 0 01-.75-.75V3z"></path>
                    </svg>
                    <a href="#" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">More info <i class="bi bi-link-45deg"></i> </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="card">
            <div class="card-header bg-brown">
                <h3 class="card-title">Real Count Graphic</h3>
            </div>
            <div class="card-body">
                <canvas id="realCountChart" class="rounded mx-auto d-block"></canvas>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="card">
            <div class="card-header bg-brown">
                <h3 class="card-title">Voter Report</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Session</th>
                                <th>Class</th>
                                <th>Number of Active Students</th>
                                <th>Number of Voters</th>
                                <th>Percentage</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($class as $classItem)
                                @php
                                    $partUsers = $classItem
                                        ->users()
                                        ->whereIn('status_id', ['2', '3', '4'])
                                        ->count();
                                    $totalUsers = $classItem
                                        ->users()
                                        ->whereIn('status_id', ['4'])
                                        ->count();
                                @endphp
                                <tr>
                                    <td></td>
                                    <td>{{ $classItem->votingSession->name }}</td>
                                    <td>{{ $classItem->name }}</td>
                                    <td>{{ $partUsers }}</td>
                                    <td>{{ $totalUsers }}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="fw-bold">
                            <tr>
                                <td colspan="3" class="text-center">Total</td>
                                <td id="totalActive">0</td>
                                <td id="totalVoters">0</td>
                                <td id="totalPercentage">0</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app>
