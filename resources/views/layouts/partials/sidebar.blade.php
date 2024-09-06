<x-maz-sidebar :href="route('dashboard')" :logo="asset('images/logo/robotickidz.png')">

    <!-- Add Sidebar Menu Items Here -->

    <x-maz-sidebar-item name="Dashboard" :link="route('dashboard')" icon="bi bi-grid-fill"></x-maz-sidebar-item>
    <x-maz-sidebar-item name="Data Siswa" :link="route('students.index')" icon="bi bi-person-fill"></x-maz-sidebar-item>
    <x-maz-sidebar-item name="Jadwal Siswa" :link="route('jadwal.index')" icon="bi bi-calendar-fill"></x-maz-sidebar-item>
    <x-maz-sidebar-item name="Data Transaksi SPP" :link="route('payments.index')" icon="bi bi-cash-stack"></x-maz-sidebar-item>




</x-maz-sidebar>