<x-app-nosidebar-layout>
    <x-slot name="header">
        <h2>Progress Murid</h2>
    </x-slot>

    <div class="container-fluid mt-5">
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
        @endif

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
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @section('scripts')
    <script>
        $(document).ready(function() {
            $('#progressReportsTable').DataTable({
                "pagingType": "full_numbers",
                "searching": true,
            });
        });
        
    </script>
    @endsection
</x-app-nosidebar-layout>