<!-- resources/views/teacherhome.blade.php -->
<x-app-nosidebar-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Dashboard Pengajar</h3>
                <a href=""><img class="logoicon2" src="{{ asset('images/logo/robotickidz.png') }}" alt="Logo" style="width: 90%; height:auto;"></a>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                </nav>
            </div>
        </div>
    </x-slot>

    <br>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Pilihan Menu Pengajar</h4>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-4 mb-4">
                        <a href="{{ route('teacher.view-sessions') }}" style="text-decoration: none; color: inherit;">
                            <div class="box" style="border: 2px solid #ddd; padding: 20px; border-radius: 5px; cursor: pointer;">
                                <h5>Jadwal Murid</h5>
                                <p>Klik disini untuk melihat jadwal.</p>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-4 mb-4">
                        <a href="{{ route('progress_reports.index') }}" style="text-decoration: none; color: inherit;">
                            <div class="box" style="border: 2px solid #ddd; padding: 20px; border-radius: 5px; cursor: pointer;">
                                <h5>Progress Murid</h5>
                                <p>Klik disini untuk update Progress Murid.</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-nosidebar-layout>