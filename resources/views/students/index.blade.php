<x-app-layout>
    <x-slot name="header">
        <div class="row">
        </div>
    </x-slot>
    </div>
    <div class="container">
        <h1>Student List</h1>
        <a href="{{ route('students.create') }}" class="btn btn-primary">Add Student</a>
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
                        <a href="{{ route('students.show', $student->id) }}" class="btn btn-info">Show</a>
                        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>