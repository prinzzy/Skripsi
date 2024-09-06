<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col">
                <h2>Data Transaksi</h2>
            </div>
            <div class="col text-end">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createPaymentModal">Tambah Transaksi</button>
                <a href="{{ route('payments.exportPdf') }}" class="btn btn-secondary">Export to PDF</a>
            </div>
        </div>
    </x-slot>

    <div class="container-fluid mt-5">
        <!-- Success Message -->
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
        <div class="table-responsive">
            <table id="paymentsTable" class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Murid</th>
                        <th>Tanggal Transaksi</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th>Receipt/bukti</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $payment)
                    <tr>
                        <td>{{ $payment->id }}</td>
                        <td>{{ $payment->student->nama }}</td>
                        <td>{{ $payment->payment_date }}</td>
                        <td>{{ formatRupiah($payment->amount) }}</td>
                        <td>{{ $payment->status }}</td>
                        <td>
                            @if ($payment->receipt)
                            <a href="{{ asset('storage/' . $payment->receipt) }}" target="_blank">View Receipt</a>
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#editPaymentModal-{{ $payment->id }}">Edit</button>
                            <form action="{{ route('payments.destroy', $payment->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger delete-btn">Delete</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Edit Payment Modal -->
                    <div class="modal fade" id="editPaymentModal-{{ $payment->id }}" tabindex="-1" aria-labelledby="editPaymentModalLabel-{{ $payment->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editPaymentModalLabel-{{ $payment->id }}">Edit Payment</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('payments.update', $payment->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="student_id" class="form-label">Student</label>
                                            <select class="form-select" id="student_id" name="student_id" required>
                                                @foreach($students as $student)
                                                <option value="{{ $student->id }}" {{ $student->id == $payment->student_id ? 'selected' : '' }}>{{ $student->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="payment_date" class="form-label">Tanggal Transaksi</label>
                                            <input type="date" class="form-control" id="payment_date" name="payment_date" value="{{ $payment->payment_date }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="amount" class="form-label">Jumlah</label>
                                            <input type="text" class="form-control formatted-amount" data-payment-id="{{ $payment->id }}" value="{{ formatRupiah($payment->amount) }}" required>
                                            <input type="hidden" id="amount_{{ $payment->id }}" name="amount" value="{{ $payment->amount }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="status" class="form-label">Status Pembayaran</label>
                                            <select class="form-select" id="status" name="status" required>
                                                <option value="Pending" {{ $payment->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="Completed" {{ $payment->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                                <option value="Failed" {{ $payment->status == 'Failed' ? 'selected' : '' }}>Failed</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="receipt" class="form-label">Upload Bukti</label>
                                            <input type="file" name="receipt" class="form-control">
                                            @if ($payment->receipt)
                                            <a href="{{ asset('storage/' . $payment->receipt) }}" target="_blank">View Receipt</a>
                                            @endif
                                        </div>
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Create Payment Modal -->
    <div class="modal fade" id="createPaymentModal" tabindex="-1" aria-labelledby="createPaymentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createPaymentModalLabel">Tambah Transaksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('payments.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="student_id" class="form-label">Nama Murid</label>
                            <select class="form-select" id="student_id" name="student_id" required>
                                @foreach($students as $student)
                                <option value="{{ $student->id }}">{{ $student->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="payment_date" class="form-label">Tanggal Transaksi</label>
                            <input type="date" class="form-control" id="payment_date" name="payment_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="amount" class="form-label">Jumlah</label>
                            <input type="text" class="form-control formatted-amount" id="amount_formatted" required>
                            <input type="hidden" id="amount" name="amount">
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status Pembayaran</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="Pending">Pending</option>
                                <option value="Completed">Completed</option>
                                <option value="Failed">Failed</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="receipt" class="form-label">Upload Bukti</label>
                            <input type="file" name="receipt" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add event listener to all formatted amount inputs
        document.querySelectorAll('.formatted-amount').forEach(function(input) {
            input.addEventListener('input', function() {
                const value = this.value.replace(/[^0-9]/g, '');
                const formattedValue = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0,
                }).format(value);
                this.value = formattedValue;
                document.getElementById(`amount${this.dataset.paymentId ? '_' + this.dataset.paymentId : ''}`).value = value;
            });
        });
    });


    $(document).ready(function() {
        $('#paymentsTable').DataTable({
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