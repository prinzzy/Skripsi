<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col">
                <h2>Manage Teachers</h2>
            </div>
            <div class="col text-end">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createTeacherModal">Tambah Pengajar</button>
            </div>
        </div>
    </x-slot>

    <div class="container mt-5">
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif

        <table id="teachersTable" class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>No Hp</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($teachers as $teacher)
                <tr>
                    <td>{{ $teacher->id }}</td>
                    <td>{{ $teacher->nama }}</td>
                    <td>{{ $teacher->no_hp }}</td>
                    <td>
                        <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#editTeacherModal-{{ $teacher->id }}">Edit</button>
                        <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST" class="d-inline delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger delete-btn">Delete</button>
                        </form>
                    </td>
                </tr>

                <!-- Edit Teacher Modal -->
                <div class="modal fade" id="editTeacherModal-{{ $teacher->id }}" tabindex="-1" aria-labelledby="editTeacherModalLabel-{{ $teacher->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editTeacherModalLabel-{{ $teacher->id }}">Edit Pengajar</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('teachers.update', $teacher->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama</label>
                                        <input type="text" class="form-control" id="nama" name="nama" value="{{ $teacher->nama }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="no_hp" class="form-label">No Hp</label>
                                        <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ $teacher->no_hp }}" required>
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

    <!-- Create Teacher Modal -->
    <div class="modal fade" id="createTeacherModal" tabindex="-1" aria-labelledby="createTeacherModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createTeacherModalLabel">Tambah Pengajar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('teachers.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="no_hp" class="form-label">No Hp</label>
                            <input type="text" class="form-control" id="no_hp" name="no_hp" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#teachersTable').DataTable({
            "pagingType": "full_numbers",
            "searching": true,
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