<x-app-layout>
    <x-slot name="header">
        <div class="row">
        </div>
    </x-slot>
    <div class="container mt-5">
        <h1>Jadwal Murid</h1>

        <!-- Success Message -->
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif

        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createSessionModal">Tambah Jadwal</button>

        <table id="sessionsTable" class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Year</th>
                    <th>Month</th>
                    <th>Week</th>
                    <th>Day of Week</th>
                    <th>Attendance Status 1</th>
                    <th>Attendance Date 1</th>
                    <th>Attendance Status 2</th>
                    <th>Attendance Date 2</th>
                    <th>Attendance Status 3</th>
                    <th>Attendance Date 3</th>
                    <th>Attendance Status 4</th>
                    <th>Attendance Date 4</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sessions as $session)
                <tr>
                    <td>{{ $session->id }}</td>
                    <td>{{ $session->year }}</td>
                    <td>{{ $session->month }}</td>
                    <td>{{ $session->week }}</td>
                    <td>{{ $session->day_of_week }}</td>
                    <td>{{ $session->attendance_status1 }}</td>
                    <td>{{ $session->attendance_date1 }}</td>
                    <td>{{ $session->attendance_status2 }}</td>
                    <td>{{ $session->attendance_date2 }}</td>
                    <td>{{ $session->attendance_status3 }}</td>
                    <td>{{ $session->attendance_date3 }}</td>
                    <td>{{ $session->attendance_status4 }}</td>
                    <td>{{ $session->attendance_date4 }}</td>
                    <td>
                        <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#editSessionModal-{{ $session->id }}">Edit</button>
                        <form class="delete-form" action="{{ route('jadwal.destroy', $session->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger delete-btn">Delete</button>
                        </form>
                    </td>
                </tr>

                <!-- Edit Session Modal -->
                <div class="modal fade" id="editSessionModal-{{ $session->id }}" tabindex="-1" aria-labelledby="editSessionModalLabel-{{ $session->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editSessionModalLabel-{{ $session->id }}">Edit Session</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('jadwal.update', $session->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-3">
                                        <label for="year" class="form-label">Year</label>
                                        <input type="text" name="year" class="form-control" value="{{ $session->year }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="month" class="form-label">Month</label>
                                        <input type="text" name="month" class="form-control" value="{{ $session->month }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="week" class="form-label">Week</label>
                                        <input type="text" name="week" class="form-control" value="{{ $session->week }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="day_of_week" class="form-label">Day of Week</label>
                                        <input type="text" name="day_of_week" class="form-control" value="{{ $session->day_of_week }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="attendance_status1" class="form-label">Attendance Status 1</label>
                                        <select name="attendance_status1" class="form-control" required>
                                            <option value="Present" {{ $session->attendance_status1 == 'Present' ? 'selected' : '' }}>Present</option>
                                            <option value="Absent" {{ $session->attendance_status1 == 'Absent' ? 'selected' : '' }}>Absent</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="attendance_date1" class="form-label">Attendance Date 1</label>
                                        <input type="date" name="attendance_date1" class="form-control" value="{{ $session->attendance_date1 }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="attendance_status2" class="form-label">Attendance Status 2</label>
                                        <select name="attendance_status2" class="form-control" required>
                                            <option value="Present" {{ $session->attendance_status2 == 'Present' ? 'selected' : '' }}>Present</option>
                                            <option value="Absent" {{ $session->attendance_status2 == 'Absent' ? 'selected' : '' }}>Absent</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="attendance_date2" class="form-label">Attendance Date 2</label>
                                        <input type="date" name="attendance_date2" class="form-control" value="{{ $session->attendance_date2 }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="attendance_status3" class="form-label">Attendance Status 3</label>
                                        <select name="attendance_status3" class="form-control" required>
                                            <option value="Present" {{ $session->attendance_status3 == 'Present' ? 'selected' : '' }}>Present</option>
                                            <option value="Absent" {{ $session->attendance_status3 == 'Absent' ? 'selected' : '' }}>Absent</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="attendance_date3" class="form-label">Attendance Date 3</label>
                                        <input type="date" name="attendance_date3" class="form-control" value="{{ $session->attendance_date3 }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="attendance_status4" class="form-label">Attendance Status 4</label>
                                        <select name="attendance_status4" class="form-control" required>
                                            <option value="Present" {{ $session->attendance_status4 == 'Present' ? 'selected' : '' }}>Present</option>
                                            <option value="Absent" {{ $session->attendance_status4 == 'Absent' ? 'selected' : '' }}>Absent</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="attendance_date4" class="form-label">Attendance Date 4</label>
                                        <input type="date" name="attendance_date4" class="form-control" value="{{ $session->attendance_date4 }}" required>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Create Session Modal -->
    <div class="modal fade" id="createSessionModal" tabindex="-1" aria-labelledby="createSessionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createSessionModalLabel">Add Session</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('jadwal.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="year" class="form-label">Year</label>
                            <input type="text" name="year" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="month" class="form-label">Month</label>
                            <input type="text" name="month" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="week" class="form-label">Week</label>
                            <input type="text" name="week" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="day_of_week" class="form-label">Day of Week</label>
                            <input type="text" name="day_of_week" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="attendance_status1" class="form-label">Attendance Status 1</label>
                            <select name="attendance_status1" class="form-control" required>
                                <option value="Present">Present</option>
                                <option value="Absent">Absent</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="attendance_date1" class="form-label">Attendance Date 1</label>
                            <input type="date" name="attendance_date1" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="attendance_status2" class="form-label">Attendance Status 2</label>
                            <select name="attendance_status2" class="form-control" required>
                                <option value="Present">Present</option>
                                <option value="Absent">Absent</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="attendance_date2" class="form-label">Attendance Date 2</label>
                            <input type="date" name="attendance_date2" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="attendance_status3" class="form-label">Attendance Status 3</label>
                            <select name="attendance_status3" class="form-control" required>
                                <option value="Present">Present</option>
                                <option value="Absent">Absent</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="attendance_date3" class="form-label">Attendance Date 3</label>
                            <input type="date" name="attendance_date3" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="attendance_status4" class="form-label">Attendance Status 4</label>
                            <select name="attendance_status4" class="form-control" required>
                                <option value="Present">Present</option>
                                <option value="Absent">Absent</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="attendance_date4" class="form-label">Attendance Date 4</label>
                            <input type="date" name="attendance_date4" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    $(document).ready(function() {
        $('#sessionsTable').DataTable({
            "pagingType": "full_numbers", // Enable pagination with all features
            "searching": true, // Enable search box
            // Add other configuration options as needed
        });

        $('.delete-btn').on('click', function(e) {
            e.preventDefault();
            var form = $(this).closest('form');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            })
        });
    });
</script>