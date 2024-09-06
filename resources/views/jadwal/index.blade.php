<x-app-layout>
    <x-slot name="header">
        <div class="row">
        </div>
    </x-slot>
    <div class="container-fluid mt-5">
        <h1>Jadwal Murid</h1>

        <!-- Success Message -->
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif

        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createSessionModal">Tambah Jadwal</button>

        <div class="table-responsive">
            <table id="sessionsTable" class="table table-hover w-100">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Parent Name</th>
                        <th>Minggu 1 Status</th>
                        <th>Nama Pengajar</th>
                        <th>Attendance Date 1</th>
                        <th>Minggu 2 Status</th>
                        <th>Nama Pengajar</th>
                        <th>Attendance Date 2</th>
                        <th>Minggu 3 Status</th>
                        <th>Nama Pengajar</th>
                        <th>Attendance Date 3</th>
                        <th>Minggu 4 Status</th>
                        <th>Nama Pengajar</th>
                        <th>Attendance Date 4</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sessions as $session)
                    <tr>
                        <td>{{ $session->id }}</td>
                        <td>{{ $session->nama }}</td>
                        <td>{{ $session->nama_orangtua }}</td>
                        <td>{{ $session->attendance_status1 }}</td>
                        <td>{{ $session->nama_pengajar1 }}</td>
                        <td>{{ $session->attendance_date1 }}</td>
                        <td>{{ $session->attendance_status2 }}</td>
                        <td>{{ $session->nama_pengajar2 }}</td>
                        <td>{{ $session->attendance_date2 }}</td>
                        <td>{{ $session->attendance_status3 }}</td>
                        <td>{{ $session->nama_pengajar3 }}</td>
                        <td>{{ $session->attendance_date3 }}</td>
                        <td>{{ $session->attendance_status4 }}</td>
                        <td>{{ $session->nama_pengajar4 }}</td>
                        <td>{{ $session->attendance_date4 }}</td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editSessionModal-{{ $session->id }}">
                                Edit
                            </button>
                            <form action="{{ route('jadwal.destroy', $session->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger delete-btn">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Create Session Modal -->
    <div class="modal fade" id="createSessionModal" tabindex="-1" aria-labelledby="createSessionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createSessionModalLabel">Create Session</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('jadwal.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="student_id" class="form-label">Student</label>
                            <select id="student_id" name="student_id" class="form-control" required>
                                <option value="">Select a student</option>
                                @foreach ($students as $student)
                                <option value="{{ $student->id }}">{{ $student->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Student Name</label>
                            <input type="text" id="nama" name="nama" class="form-control" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="nama_orangtua" class="form-label">Parent Name</label>
                            <input type="text" id="nama_orangtua" name="nama_orangtua" class="form-control" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="attendance_status1" class="form-label">Status Minggu 1</label>
                            <select name="attendance_status1" class="form-control" required>
                                <option value="Present">Present</option>
                                <option value="Absent">Absent</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nama_pengajar1" class="form-label">Nama Pengajar 1</label>
                            <input type="text" id="nama_pengajar1" name="nama_pengajar1" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="attendance_date1" class="form-label">Attendance Date 1</label>
                            <input type="date" name="attendance_date1" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="attendance_status2" class="form-label">Status Minggu 2</label>
                            <select name="attendance_status2" class="form-control" required>
                                <option value="Present">Present</option>
                                <option value="Absent">Absent</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nama_pengajar2" class="form-label">Nama Pengajar 2</label>
                            <input type="text" id="nama_pengajar2" name="nama_pengajar2" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="attendance_date2" class="form-label">Attendance Date 2</label>
                            <input type="date" name="attendance_date2" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="attendance_status3" class="form-label">Status Minggu 3</label>
                            <select name="attendance_status3" class="form-control" required>
                                <option value="Present">Present</option>
                                <option value="Absent">Absent</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nama_pengajar3" class="form-label">Nama Pengajar 3</label>
                            <input type="text" id="nama_pengajar3" name="nama_pengajar3" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="attendance_date3" class="form-label">Attendance Date 3</label>
                            <input type="date" name="attendance_date3" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="attendance_status4" class="form-label">Status Minggu 4</label>
                            <select name="attendance_status4" class="form-control" required>
                                <option value="Present">Present</option>
                                <option value="Absent">Absent</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nama_pengajar4" class="form-label">Nama Pengajar 4</label>
                            <input type="text" id="nama_pengajar4" name="nama_pengajar4" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="attendance_date4" class="form-label">Attendance Date 4</label>
                            <input type="date" name="attendance_date4" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Session Modals -->
    @foreach ($sessions as $session)
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
                        <div class="mb-3">
                            <label for="edit_student_id_{{ $session->id }}" class="form-label">Student</label>
                            <select id="edit_student_id_{{ $session->id }}" name="student_id" class="form-control edit-student-id" required>
                                <option value="">Select a student</option>
                                @foreach ($students as $student)
                                <option value="{{ $student->id }}" {{ $session->student_id == $student->id ? 'selected' : '' }}>
                                    {{ $student->nama }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_nama_{{ $session->id }}" class="form-label">Student Name</label>
                            <input type="text" id="edit_nama_{{ $session->id }}" name="nama" class="form-control edit-nama" value="{{ $session->nama }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="edit_nama_orangtua_{{ $session->id }}" class="form-label">Parent Name</label>
                            <input type="text" id="edit_nama_orangtua_{{ $session->id }}" name="nama_orangtua" class="form-control edit-nama-orangtua" value="{{ $session->nama_orangtua }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="edit_attendance_status1" class="form-label">Status Minggu 1</label>
                            <select name="attendance_status1" class="form-control" required>
                                <option value="Present" {{ $session->attendance_status1 == 'Present' ? 'selected' : '' }}>Present</option>
                                <option value="Absent" {{ $session->attendance_status1 == 'Absent' ? 'selected' : '' }}>Absent</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_nama_pengajar1" class="form-label">Nama Pengajar 1</label>
                            <input type="text" id="edit_nama_pengajar1" name="nama_pengajar1" class="form-control" value="{{ $session->nama_pengajar1 }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_attendance_date1" class="form-label">Attendance Date 1</label>
                            <input type="date" name="attendance_date1" class="form-control" value="{{ $session->attendance_date1 }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_attendance_status2" class="form-label">Status Minggu 2</label>
                            <select name="attendance_status2" class="form-control" required>
                                <option value="Present" {{ $session->attendance_status2 == 'Present' ? 'selected' : '' }}>Present</option>
                                <option value="Absent" {{ $session->attendance_status2 == 'Absent' ? 'selected' : '' }}>Absent</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_nama_pengajar2" class="form-label">Nama Pengajar 2</label>
                            <input type="text" id="edit_nama_pengajar2" name="nama_pengajar2" class="form-control" value="{{ $session->nama_pengajar2 }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_attendance_date2" class="form-label">Attendance Date 2</label>
                            <input type="date" name="attendance_date2" class="form-control" value="{{ $session->attendance_date2 }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_attendance_status3" class="form-label">Status Minggu 3</label>
                            <select name="attendance_status3" class="form-control" required>
                                <option value="Present" {{ $session->attendance_status3 == 'Present' ? 'selected' : '' }}>Present</option>
                                <option value="Absent" {{ $session->attendance_status3 == 'Absent' ? 'selected' : '' }}>Absent</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_nama_pengajar3" class="form-label">Nama Pengajar 3</label>
                            <input type="text" id="edit_nama_pengajar3" name="nama_pengajar3" class="form-control" value="{{ $session->nama_pengajar3 }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_attendance_date3" class="form-label">Attendance Date 3</label>
                            <input type="date" name="attendance_date3" class="form-control" value="{{ $session->attendance_date3 }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_attendance_status4" class="form-label">Status Minggu 4</label>
                            <select name="attendance_status4" class="form-control" required>
                                <option value="Present" {{ $session->attendance_status4 == 'Present' ? 'selected' : '' }}>Present</option>
                                <option value="Absent" {{ $session->attendance_status4 == 'Absent' ? 'selected' : '' }}>Absent</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_nama_pengajar4" class="form-label">Nama Pengajar 4</label>
                            <input type="text" id="edit_nama_pengajar4" name="nama_pengajar4" class="form-control" value="{{ $session->nama_pengajar4 }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_attendance_date4" class="form-label">Attendance Date 4</label>
                            <input type="date" name="attendance_date4" class="form-control" value="{{ $session->attendance_date4 }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const studentSelect = document.getElementById('student_id');
        const namaInput = document.getElementById('nama');
        const namaOrangtuaInput = document.getElementById('nama_orangtua');

        studentSelect.addEventListener('change', function() {
            const studentId = this.value;

            fetch(`/students/${studentId}`)
                .then(response => response.json())
                .then(data => {
                    namaInput.value = data.nama;
                    namaOrangtuaInput.value = data.nama_orangtua;
                });
        });
        document.querySelectorAll('.edit-student-id').forEach(select => {
            select.addEventListener('change', function() {
                const studentId = this.value;
                const modal = this.closest('.modal');
                const namaInput = modal.querySelector('.edit-nama');
                const namaOrangtuaInput = modal.querySelector('.edit-nama-orangtua');

                fetch(`/students/${studentId}`)
                    .then(response => response.json())
                    .then(data => {
                        namaInput.value = data.nama;
                        namaOrangtuaInput.value = data.nama_orangtua;
                    });
            });
        });
    });

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