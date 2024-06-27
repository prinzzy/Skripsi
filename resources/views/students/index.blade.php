<x-app-layout>
    <x-slot name="header">
        <div class="row">
        </div>
    </x-slot>
    <div class="container">
        <h1>Student List</h1>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createStudentModal">Add Student</button>
        <br><br>
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
        @endif
        <table id="studentsTable" class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Sekolah</th>
                    <th>Tanggal Lahir</th>
                    <th>Tanggal Mulai</th>
                    <th>Jadwal Kelas</th>
                    <th>Level</th>
                    <th>No HP</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->nama }}</td>
                    <td>{{ $student->sekolah }}</td>
                    <td>{{ $student->tanggal_lahir }}</td>
                    <td>{{ $student->tanggal_mulai }}</td>
                    <td>{{ $student->jadwal_kelas }}</td>
                    <td>{{ $student->level }}</td>
                    <td>{{ $student->no_hp }}</td>
                    <td>
                        <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#showStudentModal-{{ $student->id }}">Show</button>
                        <br>
                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editStudentModal-{{ $student->id }}">Edit</button>
                        <br>
                        <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this student?')">Delete</button>
                        </form>
                    </td>
                </tr>

                <!-- Show Student Modal -->
                <div class="modal fade" id="showStudentModal-{{ $student->id }}" tabindex="-1" aria-labelledby="showStudentModalLabel-{{ $student->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="showStudentModalLabel-{{ $student->id }}">Student Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>ID:</strong> {{ $student->id }}</p>
                                <p><strong>Nama:</strong> {{ $student->nama }}</p>
                                <p><strong>Sekolah:</strong> {{ $student->sekolah }}</p>
                                <p><strong>Tanggal Lahir:</strong> {{ $student->tanggal_lahir }}</p>
                                <p><strong>Tanggal Mulai:</strong> {{ $student->tanggal_mulai }}</p>
                                <p><strong>Jadwal Kelas:</strong> {{ $student->jadwal_kelas }}</p>
                                <p><strong>Level:</strong> {{ $student->level }}</p>
                                <p><strong>No HP:</strong> {{ $student->no_hp }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Student Modal -->
                <div class="modal fade" id="editStudentModal-{{ $student->id }}" tabindex="-1" aria-labelledby="editStudentModalLabel-{{ $student->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editStudentModalLabel-{{ $student->id }}">Edit Student</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('students.update', $student->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="nama-{{ $student->id }}" class="form-label">Nama</label>
                                        <input type="text" name="nama" class="form-control" id="nama-{{ $student->id }}" value="{{ $student->nama }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="sekolah-{{ $student->id }}" class="form-label">Sekolah</label>
                                        <input type="text" name="sekolah" class="form-control" id="sekolah-{{ $student->id }}" value="{{ $student->sekolah }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tanggal_lahir-{{ $student->id }}" class="form-label">Tanggal Lahir</label>
                                        <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir-{{ $student->id }}" value="{{ $student->tanggal_lahir }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tanggal_mulai-{{ $student->id }}" class="form-label">Tanggal Mulai</label>
                                        <input type="date" name="tanggal_mulai" class="form-control" id="tanggal_mulai-{{ $student->id }}" value="{{ $student->tanggal_mulai }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="jadwal_kelas-{{ $student->id }}" class="form-label">Jadwal Kelas</label>
                                        <input type="text" name="jadwal_kelas" class="form-control" id="jadwal_kelas-{{ $student->id }}" value="{{ $student->jadwal_kelas }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="level-{{ $student->id }}" class="form-label">Level</label>
                                        <input type="text" name="level" class="form-control" id="level-{{ $student->id }}" value="{{ $student->level }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="no_hp-{{ $student->id }}" class="form-label">No HP</label>
                                        <input type="text" name="no_hp" class="form-control" id="no_hp-{{ $student->id }}" value="{{ $student->no_hp }}" required>
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

    <!-- Create Student Modal -->
    <div class="modal fade" id="createStudentModal" tabindex="-1" aria-labelledby="createStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createStudentModalLabel">Add Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('students.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="sekolah" class="form-label">Sekolah</label>
                            <input type="text" name="sekolah" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                            <input type="date" name="tanggal_mulai" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="jadwal_kelas" class="form-label">Jadwal Kelas</label>
                            <input type="text" name="jadwal_kelas" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="level" class="form-label">Level</label>
                            <input type="text" name="level" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="no_hp" class="form-label">No HP</label>
                            <input type="text" name="no_hp" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    console.log('Script loaded');
    $(document).ready(function() {
        $('#studentsTable').DataTable({
            "pagingType": "full_numbers", // Enable pagination with all features
            "searching": true, // Enable search box
            // Add other configuration options as needed
        });
    });
</script>