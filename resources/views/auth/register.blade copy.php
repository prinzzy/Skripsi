<x-guest-layout>
    <div id="auth-left">
        <div class="auth-logo">
            <a href="index.html"><img src="{{ asset('/images/logo/robotickidz.png') }}" alt="Logo"></a>
        </div>
        <div class="container mt-5">
            <h2 class="mb-4">Form Pendaftaran Robotickidz</h2>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group position-relative">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required required minlength="8">
                    <button type="button" class="btn btn-secondary toggle-password" id="togglePassword">Show</button>
                </div>
                <div class="form-group position-relative">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required required minlength="8">
                    <button type="button" class="btn btn-secondary toggle-password" id="togglePasswordConfirmation">Show</button>
                </div>
                <div class="form-group">
                    <label for="nama">Nama murid</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
                <div class="form-group">
                    <label for="sekolah">Sekolah</label>
                    <select class="form-control" id="sekolah" name="sekolah" required>
                        <option value="SD">SD</option>
                        <option value="SMP">SMP</option>
                        <option value="SMA">SMA</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tanggal_mulai">Tanggal Mulai Robotic Kids</label>
                    <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" required>
                </div>
                <div class="form-group">
                    <label for="jadwal_kelas">Jadwal Kelas "hari dan jam"</label>
                    <input type="text" class="form-control" id="jadwal_kelas" name="jadwal_kelas" required>
                </div>
                <div class="form-group">
                    <label for="level">Level</label>
                    <select class="form-control" id="level" name="level" required>
                        <option value="toodler">Toodler</option>
                        <option value="preschool">Preschool</option>
                        <option value="pre robotic 1">Pre Robotic 1</option>
                        <option value="pre robotic 2">Pre Robotic 2</option>
                        <option value="pre robotic 3">Pre Robotic 3</option>
                        <option value="pre robotic 4">Pre Robotic 4</option>
                        <option value="robotic 1">Robotic 1</option>
                        <option value="robotic 2">Robotic 2</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="pilih_les">Pilih Les</label>
                    <select class="form-control" id="pilih_les" name="pilih_les" required>
                        <option value="Robotic">Robotic</option>
                        <option value="Coding">Coding</option>
                        <option value="Animasi">Animasi</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="kelas">Kelas Sekolah</label>
                    <input type="text" class="form-control" id="kelas" name="kelas" required>
                </div>
                <div class="form-group">
                    <label for="nama_orangtua">Nama Orang Tua</label>
                    <input type="text" class="form-control" id="nama_orangtua" name="nama_orangtua" required>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label for="no_hp">No. Handphone</label>
                    <input type="tel" class="form-control" id="no_hp" name="no_hp" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="text-center mt-5 text-lg fs-5">
            <p class='text-gray-600'>Kembali Ke Login <a href="{{ route('login') }}" class="font-bold">Log in</a>.</p>
        </div>
    </div>
</x-guest-layout>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<style>
    .field-icon {
        float: right;
        margin-left: -25px;
        margin-top: -25px;
        position: relative;
        z-index: 2;
        cursor: pointer;
    }
</style>
<script>
    $(document).ready(function() {
        $('#togglePassword').on('click', function() {
            var input = $('#password');
            if (input.attr("type") === "password") {
                input.attr("type", "text");
                $(this).text("Hide");
            } else {
                input.attr("type", "password");
                $(this).text("Show");
            }
        });

        $('#togglePasswordConfirmation').on('click', function() {
            var input = $('#password_confirmation');
            if (input.attr("type") === "password") {
                input.attr("type", "text");
                $(this).text("Hide");
            } else {
                input.attr("type", "password");
                $(this).text("Show");
            }
        });
    });
</script>