<x-guest-layout>
    <div id="auth-left">
        <div class="auth-logo">
            <a href="index.html"><img src="{{ asset('/images/logo/robotickidz.png') }}" alt="Logo"></a>
        </div>
        <div class="container mt-5">
            <h2 class="mb-4">Form Pendaftaran Robotickidz</h2>
            
                @csrf

                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                </div>
                <div class="form-group">
                    <label for="nama">Nama Calon Siswa</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
                <div class="form-group">
                    <label for="sekolah">Sekolah</label>
                    <select class="form-control" id="sekolah" name="sekolah">
                        <option>SD</option>
                        <option>SMP</option>
                        <option>SMA</option>
                        <option>Lainnya</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="namaSekolah">Nama Sekolah dan Kelas</label>
                    <input type="text" class="form-control" id="namaSekolah" name="nama_sekolah">
                </div>
                <div class="form-group">
                    <label for="tanggalLahir">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="tanggalLahir" name="tanggal_lahir" required>
                </div>
                <div class="form-group">
                    <label for="tanggalMulai">Tanggal Mulai Robotic Kids</label>
                    <input type="date" class="form-control" id="tanggalMulai" name="tanggal_mulai" required>
                </div>
                <div class="form-group">
                    <label for="kelas">Kelas</label>
                    <input type="text" class="form-control" id="kelas" name="kelas">
                </div>
                <div class="form-group">
                    <label for="hari">Hari</label>
                    <input type="text" class="form-control" id="hari" name="hari">
                </div>
                <div class="form-group">
                    <label for="jam">Jam</label>
                    <input type="text" class="form-control" id="jam" name="jam">
                </div>
                <div class="form-group">
                    <label for="holidayProgram">Holiday Program</label>
                    <input type="date" class="form-control" id="holidayProgram" name="holiday_program">
                </div>
                <div class="form-group">
                    <label for="namaOrangTua">Nama Orang Tua</label>
                    <input type="text" class="form-control" id="namaOrangTua" name="nama_orang_tua" required>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label for="noTelepon">No. Telepon Rumah</label>
                    <input type="tel" class="form-control" id="noTelepon" name="no_telepon">
                </div>
                <div class="form-group">
                    <label for="noHandphone">No. Handphone</label>
                    <input type="tel" class="form-control" id="noHandphone" name="no_handphone" required>
                </div>
                <div class="form-group">
                    <label for="infoRobotickidz">Dapat Info Robotickidz dari</label>
                    <input type="text" class="form-control" id="infoRobotickidz" name="info_robotickidz">
                </div>
                <div class="form-group">
                    <label for="instagram">Nama Instagram Ayah/Bunda</label>
                    <input type="text" class="form-control" id="instagram" name="instagram">
                </div>
                <div class="form-group">
                    <label for="biaya">Biaya Pendaftaran</label>
                    <input type="text" class="form-control" id="biaya" value="Rp.300.000" readonly>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</x-guest-layout>