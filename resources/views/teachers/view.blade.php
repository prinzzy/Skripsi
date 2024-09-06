<x-app-nosidebar-layout>
    <x-slot name="header">
        <h2>Jadwal Murid</h2>
    </x-slot>
    <div class="container-fluid mt-5">
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
        @endif
        <!-- Bulk Update Form -->
        <form action="{{ route('jadwal.updateAll') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col">
                    <div class="table-responsive">
                        <table id="sessionsTable" class="table table-hover" style="table-layout: fixed; width: 100%;">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Student Name</th>
                                    <th>Attendance Status 1</th>
                                    <th>Attendance Date 1</th>
                                    <th>Nama Pengajar</th>
                                    <th>Attendance Status 2</th>
                                    <th>Attendance Date 2</th>
                                    <th>Nama Pengajar</th>
                                    <th>Attendance Status 3</th>
                                    <th>Attendance Date 3</th>
                                    <th>Nama Pengajar</th>
                                    <th>Attendance Status 4</th>
                                    <th>Attendance Date 4</th>
                                    <th>Nama Pengajar</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sessions as $session)
                                <tr>
                                    <td>{{ $session->id }}</td>
                                    <td>{{ $session->student->nama }}</td>
                                    <td>
                                        <select name="attendance_status1[{{ $session->id }}]" class="form-control">
                                            <option value="Present" {{ $session->attendance_status1 == 'Present' ? 'selected' : '' }}>Present</option>
                                            <option value="Absent" {{ $session->attendance_status1 == 'Absent' ? 'selected' : '' }}>Absent</option>
                                        </select>
                                    </td>
                                    <td>{{ $session->attendance_date1 }}</td>
                                    <td>{{ $session->nama_pengajar1 }}</td>
                                    <td>
                                        <select name="attendance_status2[{{ $session->id }}]" class="form-control">
                                            <option value="Present" {{ $session->attendance_status2 == 'Present' ? 'selected' : '' }}>Present</option>
                                            <option value="Absent" {{ $session->attendance_status2 == 'Absent' ? 'selected' : '' }}>Absent</option>
                                        </select>
                                    </td>
                                    <td>{{ $session->attendance_date2 }}</td>
                                    <td>{{ $session->nama_pengajar2 }}</td>
                                    <td>
                                        <select name="attendance_status3[{{ $session->id }}]" class="form-control">
                                            <option value="Present" {{ $session->attendance_status3 == 'Present' ? 'selected' : '' }}>Present</option>
                                            <option value="Absent" {{ $session->attendance_status3 == 'Absent' ? 'selected' : '' }}>Absent</option>
                                        </select>
                                    </td>
                                    <td>{{ $session->attendance_date3 }}</td>
                                    <td>{{ $session->nama_pengajar3 }}</td>
                                    <td>
                                        <select name="attendance_status4[{{ $session->id }}]" class="form-control">
                                            <option value="Present" {{ $session->attendance_status4 == 'Present' ? 'selected' : '' }}>Present</option>
                                            <option value="Absent" {{ $session->attendance_status4 == 'Absent' ? 'selected' : '' }}>Absent</option>
                                        </select>
                                    </td>
                                    <td>{{ $session->attendance_date4 }}</td>
                                    <td>{{ $session->nama_pengajar4 }}</td>
                                    <td>
                                        <!-- Single Update Button -->
                                        <button type="button" class="btn btn-info update-single" data-session-id="{{ $session->id }}">Update</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Update All</button>
        </form>
    </div>

    <!-- Hidden Form for Single Update -->
    <form id="updateSingleForm" method="POST" style="display: none;">
        @csrf
        <input type="hidden" name="attendance_status1" id="attendance_status1">
        <input type="hidden" name="attendance_status2" id="attendance_status2">
        <input type="hidden" name="attendance_status3" id="attendance_status3">
        <input type="hidden" name="attendance_status4" id="attendance_status4">
        <input type="hidden" name="nama_pengajar1" id="nama_pengajar1">
        <input type="hidden" name="nama_pengajar2" id="nama_pengajar2">
        <input type="hidden" name="nama_pengajar3" id="nama_pengajar3">
        <input type="hidden" name="nama_pengajar4" id="nama_pengajar4">
    </form>
</x-app-nosidebar-layout>
<script>
    $(document).ready(function() {
        $('#sessionsTable').DataTable({
            "pagingType": "full_numbers",
            "searching": true,
        });

        // Add event listener for update-single buttons
        $('.update-single').click(function() {
            var sessionId = $(this).data('session-id');

            console.log("Update button clicked for session ID:", sessionId); // Debugging line

            // Populate the form fields
            $('#attendance_status1').val($(`select[name="attendance_status1[${sessionId}]"]`).val());
            $('#attendance_status2').val($(`select[name="attendance_status2[${sessionId}]"]`).val());
            $('#attendance_status3').val($(`select[name="attendance_status3[${sessionId}]"]`).val());
            $('#attendance_status4').val($(`select[name="attendance_status4[${sessionId}]"]`).val());
            $('#nama_pengajar1').val($(`td:contains(${sessionId})`).siblings().eq(4).text().trim());
            $('#nama_pengajar2').val($(`td:contains(${sessionId})`).siblings().eq(7).text().trim());
            $('#nama_pengajar3').val($(`td:contains(${sessionId})`).siblings().eq(10).text().trim());
            $('#nama_pengajar4').val($(`td:contains(${sessionId})`).siblings().eq(13).text().trim());

            console.log("Form values set:", {
                attendance_status1: $('#attendance_status1').val(),
                attendance_status2: $('#attendance_status2').val(),
                attendance_status3: $('#attendance_status3').val(),
                attendance_status4: $('#attendance_status4').val(),
                nama_pengajar1: $('#nama_pengajar1').val(),
                nama_pengajar2: $('#nama_pengajar2').val(),
                nama_pengajar3: $('#nama_pengajar3').val(),
                nama_pengajar4: $('#nama_pengajar4').val(),
            }); // Debugging line

            // Set the action of the form
            $('#updateSingleForm').attr('action', `/jadwal/update-single/${sessionId}`);

            console.log("Form action set to:", $('#updateSingleForm').attr('action')); // Debugging line

            // Submit the form
            $('#updateSingleForm').submit();
        });
    });
</script>