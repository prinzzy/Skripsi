<x-app-layout>
    <x-slot name="header">
        <div class="row">
        </div>
    </x-slot>
    <div class="container">
        <h1>Data Murid</h1>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createStudentModal">Add Student</button>
        <br><br>
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
        @endif
        <table id="studentsTable" class="table table-hover">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Sekolah</th>
                    <th>Tanggal Lahir</th>
                    <th>Tanggal Mulai</th>
                    <th>Jadwal Kelas</th>
                    <th>Level</th>
                    <th>No HP</th>
                    <th>Nama Ortu</th>
                    <th>Alamat</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                <tr>
                    <td>{{ $student->nama }}</td>
                    <td>{{ $student->sekolah }}</td>
                    <td>{{ $student->tanggal_lahir }}</td>
                    <td>{{ $student->tanggal_mulai }}</td>
                    <td>{{ $student->jadwal_kelas }}</td>
                    <td>{{ $student->level }}</td>
                    <td>{{ $student->no_hp }}</td>
                    <td>{{ $student->nama_orangtua }}</td>
                    <td>{{ $student->alamat }}</td>
                    <td>
                        <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#showStudentModal-{{ $student->id }}">Show</button>
                        <br>
                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editStudentModal-{{ $student->id }}">Edit</button>
                        <br>
                        <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger delete-btn">Delete</button>
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
                                <p><strong>No Hp:</strong> {{ $student->no_hp }}</p>
                                <p><strong>Nama Ortu:</strong> {{ $student->nama_orangtua }}</p>
                                <p><strong>Alamat:</strong> {{ $student->alamat }}</p>
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
                                    <div class="mb-3">
                                        <label for="nama_orangtua-{{ $student->id }}" class="form-label">Nama Ortu</label>
                                        <input type="text" name="no_hp" class="form-control" id="nama_orangtua-{{ $student->id }}" value="{{ $student->nama_orangtua }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="alamat-{{ $student->id }}" class="form-label">Alamat</label>
                                        <input type="text" name="alamat" class="form-control" id="alamat-{{ $student->id }}" value="{{ $student->alamat }}" required>
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
                        <div class="mb-3">
                            <label for="nama_orangtua" class="form-label">Nama Ortu</label>
                            <input type="text" name="nama_orangtua" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">alamat</label>
                            <input type="text" name="alamat" class="form-control" required>
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
        $('#studentsTable').DataTable({
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