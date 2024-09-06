<x-guest-layout>
    <div id="auth-left" class="d-flex flex-column align-items-center justify-content-center vh-100 bg-light">
        <div class="auth-logo mb-4">
            <a href="/">
                <img src="{{ asset('/images/logo/robotickidz.png') }}" alt="Robotickidz Logo" width="150">
            </a>
        </div>
        <div class="container bg-white p-5 rounded shadow-sm">
            <h2 class="mb-4 text-center text-primary">Pembayaran Bank Transfer</h2>
            <p class="text-center">Silahkan Transfer Ke Rekening Dibawah ini:</p>
            <div class="card mb-4">
                <div class="card-body">
                    <ul class="list-unstyled text-center">
                        <li class="mb-2"><strong>Bank:</strong> BCA</li>
                        <li class="mb-2"><strong>Nomor Rekening:</strong> 0951222509</li>
                        <li class="mb-2"><strong>Atas Nama:</strong> Primadini Asri</li>
                        <li><strong>Jumlah:</strong> Rp 300.000</li>
                    </ul>
                </div>
            </div>
            <form method="POST" action="{{ route('bank-transfer.upload') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-4">
                    <label for="receipt" class="form-label">Silahkan Upload Bukti Transfer</label>
                    <input type="file" class="form-control" id="receipt" name="receipt" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </div>
            </form>
        </div>
        <!-- <div class="text-center mt-4">
            <p class="text-muted">Terimakasih Atas Pembayaran nya</p>
        </div> -->
    </div>
</x-guest-layout>