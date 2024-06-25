<x-app-layout>
    <x-slot name="header">
        <div class="row">
        </div>
    </x-slot>
    </div>
    <div class="container">
    <h1>Student List</h1>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createStudentModal">Add Student</button>
    <br><br>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif
    <table class="table table-bordered">
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
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>

                <!-- Show Student Modal -->
                <div class="modal fade" id="showStudentModal-{{ $student->id }}" tabindex="-1" aria-labelledby="showStudentModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="showStudentModalLabel">Student Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-bordered">
                                    <tr><th>ID</th><td>{{ $student->id }}</td></tr>
                                    <tr><th>Nama</th><td>{{ $student->nama }}</td></tr>
                                    <tr><th>Sekolah</th><td>{{ $student->sekolah }}</td></tr>
                                    <tr><th>Tanggal Lahir</th><td>{{ $student->tanggal_lahir }}</td></tr>
                                    <tr><th>Tanggal Mulai</th><td>{{ $student->tanggal_mulai }}</td></tr>
                                    <tr><th>Jadwal Kelas</th><td>{{ $student->jadwal_kelas }}</td></tr>
                                    <tr><th>Level</th><td>{{ $student->level }}</td></tr>
                                    <tr><th>No HP</th><td>{{ $student->no_hp }}</td></tr>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Student Modal -->
                <div class="modal fade" id="editStudentModal-{{ $student->id }}" tabindex="-1" aria-labelledby="editStudentModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editStudentModalLabel">Edit Student</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('students.update', $student->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama</label>
                                        <input type="text" name="nama" class="form-control" value="{{ $student->nama }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="sekolah" class="form-label">Sekolah</label>
                                        <input type="text" name="sekolah" class="form-control" value="{{ $student->sekolah }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                        <input type="date" name="tanggal_lahir" class="form-control" value="{{ $student->tanggal_lahir }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                                        <input type="date" name="tanggal_mulai" class="form-control" value="{{ $student->tanggal_mulai }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="jadwal_kelas" class="form-label">Jadwal Kelas</label>
                                        <input type="text" name="jadwal_kelas" class="form-control" value="{{ $student->jadwal_kelas }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="level" class="form-label">Level</label>
                                        <input type="text" name="level" class="form-control" value="{{ $student->level }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="no_hp" class="form-label">No HP</label>
                                        <input type="text" name="no_hp" class="form-control" value="{{ $student->no_hp }}" required>
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