<x-app-layout>
    <x-slot name="header">
        <div class="row">
        </div>
    </x-slot>
    </div>
    <div class="container">
        <h1>Add Student</h1>
        <form action="{{ route('students.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="sekolah">Sekolah</label>
                <input type="text" name="sekolah" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="tanggal_mulai">Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="jadwal_kelas">Jadwal Kelas</label>
                <input type="text" name="jadwal_kelas" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="level">Level</label>
                <input type="text" name="level" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="no_hp">No HP</label>
                <input type="text" name="no_hp" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </div>
</x-app-layout>