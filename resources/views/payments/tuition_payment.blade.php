<!-- resources/views/parents/tuition_payment.blade.php -->
<x-app-nosidebar-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Dashboard Orang Tua</h3>
                <a href=""><img class="logoicon2" src="{{ asset('images/logo/robotickidz.png') }}" alt="Logo" style="width: 90%; height:auto;"></a>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>

    <div class="container mt-5">
        <h2>Tuition Payment</h2>
        <p>Please complete the payment form below.</p>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <form method="POST" action="{{ route('payment.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- Payment Date Field -->
            <div class="form-group">
                <label for="payment_date">Payment Date</label>
                <input type="date" class="form-control" id="payment_date" name="payment_date" required>
            </div>

            <!-- Amount Field -->
            <div class="form-group">
                <label for="amount">Amount (Rp)</label>
                <input type="number" class="form-control" id="amount" name="amount" required>
            </div>

            <!-- Receipt Upload -->
            <div class="form-group">
                <label for="receipt">Upload Receipt</label>
                <input type="file" class="form-control-file" id="receipt" name="receipt" accept=".jpeg,.png,.pdf" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Submit Payment</button>
        </form>
    </div>
</x-app-nosidebar-layout>