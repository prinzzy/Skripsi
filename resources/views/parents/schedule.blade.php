<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Murid</title>
    <style>
        .attendance-box {
            padding: 10px;
            border-radius: 5px;
            color: white;
            text-align: center;
            margin-bottom: 10px;
        }

        .attendance-box.present {
            background-color: green;
        }

        .attendance-box.absent {
            background-color: red;
        }

        .day-of-week {
            font-weight: bold;
        }

        .table-responsive {
            overflow-x: auto;
        }
    </style>
</head>

<body>
    <x-app-nosidebar-layout>
        <x-slot name="header">
            <h2>Jadwal dan Kehadiran Murid </h2>
        </x-slot>

        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col">
                    <div class="table-responsive">
                        <table id="sessionsTable" class="table table-hover w-100">
                            <thead>
                                <tr>
                                    <th>Student Name</th>
                                    <!-- <th>Parent Name</th> -->
                                    <th>Week 1</th>
                                    <th>Week 2</th>
                                    <th>Week 3</th>
                                    <th>Week 4</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sessions as $session)
                                <tr>
                                    <td>{{ $session->student->nama }}</td>
                                    <!-- <td>{{ $session->nama_orangtua }}</td> -->
                                    <td>
                                        <div class="attendance-box {{ strtolower($session->attendance_status1) }}">
                                            <div class="day-of-week">{{ \Carbon\Carbon::parse($session->attendance_date1)->format('l') }}</div>
                                            <div>{{ $session->attendance_date1 }}</div>
                                            <div>{{ $session->nama_pengajar1 }}</div>
                                            <div>{{ $session->attendance_status1 }}</div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="attendance-box {{ strtolower($session->attendance_status2) }}">
                                            <div class="day-of-week">{{ \Carbon\Carbon::parse($session->attendance_date2)->format('l') }}</div>
                                            <div>{{ $session->attendance_date2 }}</div>
                                            <div>{{ $session->nama_pengajar2 }}</div>
                                            <div>{{ $session->attendance_status2 }}</div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="attendance-box {{ strtolower($session->attendance_status3) }}">
                                            <div class="day-of-week">{{ \Carbon\Carbon::parse($session->attendance_date3)->format('l') }}</div>
                                            <div>{{ $session->attendance_date3 }}</div>
                                            <div>{{ $session->nama_pengajar3 }}</div>
                                            <div>{{ $session->attendance_status3 }}</div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="attendance-box {{ strtolower($session->attendance_status4) }}">
                                            <div class="day-of-week">{{ \Carbon\Carbon::parse($session->attendance_date4)->format('l') }}</div>
                                            <div>{{ $session->attendance_date4 }}</div>
                                            <div>{{ $session->nama_pengajar4  }}</div>
                                            <div>{{ $session->attendance_status4 }}</div>
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
    </x-app-nosidebar-layout>

    @section('scripts')
    <script>
        $(document).ready(function() {
            $('#sessionsTable').DataTable({
                "pagingType": "full_numbers",
                "searching": true,
            });
        });
    </script>
    @endsection
</body>

</html>