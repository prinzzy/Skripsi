<x-app-nosidebar-layout>
    <x-slot name="header">
        <h2>Perkembangan Les</h2>
    </x-slot>

    <div class="container-fluid mt-5">
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
        @endif

        <!-- Button to trigger create modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
            Create Progress Report
        </button>

        <!-- Progress Reports Table -->
        <div class="table-responsive mt-3">
            <table id="progressReportsTable" class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Student Name</th>
                        <th>Module Name</th>
                        <th>Certificate</th>
                        <th>Note</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($progressReports as $report)
                    <tr>
                        <td>{{ $report->id }}</td>
                        <td>{{ $report->student->nama }}</td>
                        <td>{{ $report->module_name }}</td>
                        <td>
                            @if ($report->certificate_path)
                            <a href="{{ asset('storage/' . $report->certificate_path) }}" target="_blank">View Certificate</a>
                            @else
                            N/A
                            @endif
                        </td>
                        <td>{{ $report->note }}</td>
                        <td>
                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#editModal{{ $report->id }}">
                                Edit
                            </button>
                            <form action="{{ route('progress_reports.destroy', $report->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger delete-btn">Delete</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal{{ $report->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $report->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel{{ $report->id }}">Edit Progress Report</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('progress_reports.update', $report->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="student_id">Student</label>
                                            <select name="student_id" class="form-control" required>
                                                @foreach ($students as $student)
                                                <option value="{{ $student->id }}" {{ $report->student_id == $student->id ? 'selected' : '' }}>{{ $student->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="module_name">Module Name</label>
                                            <input type="text" name="module_name" class="form-control" value="{{ $report->module_name }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="certificate_path">Certificate</label>
                                            <input type="file" name="certificate_path" class="form-control">
                                            @if ($report->certificate_path)
                                            <a href="{{ asset('storage/' . $report->certificate_path) }}" target="_blank">View Certificate</a>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="note">Note</label>
                                            <textarea name="note" class="form-control">{{ $report->note }}</textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Create Progress Report</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('progress_reports.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="student_id">Student</label>
                            <select name="student_id" class="form-control" required>
                                @foreach ($students as $student)
                                <option value="{{ $student->id }}">{{ $student->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="module_name">Module Name</label>
                            <input type="text" name="module_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="certificate_path">Certificate</label>
                            <input type="file" name="certificate_path" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="note">Note</label>
                            <textarea name="note" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-nosidebar-layout>
<script>
    $(document).ready(function() {
        $('#progressReportsTable').DataTable({
            "pagingType": "full_numbers",
            "searching": true,
        });
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
</script>