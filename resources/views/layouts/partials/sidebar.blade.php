<x-maz-sidebar :href="route('dashboard')" :logo="asset('images/logo/robotickidz.png')">

    <!-- Add Sidebar Menu Items Here -->

    <x-maz-sidebar-item name="Dashboard" :link="route('dashboard')" icon="bi bi-grid-fill"></x-maz-sidebar-item>
    <x-maz-sidebar-item name="Siswa" icon="bi bi-stack">
        <x-maz-sidebar-sub-item name="Data Siswa" :link="route('students.index')"></x-maz-sidebar-sub-item>
        <x-maz-sidebar-sub-item name="Jadwal Siswa" :link="route('components.alert')"></x-maz-sidebar-sub-item>
    </x-maz-sidebar-item>
    <x-maz-sidebar-item name="Pengajar" icon="bi bi-stack">
        <x-maz-sidebar-sub-item name="Data pengajar" :link="route('components.alert')"></x-maz-sidebar-sub-item>
        <x-maz-sidebar-sub-item name="Ubah Jadwal Pengajar" :link="route('components.alert')"></x-maz-sidebar-sub-item>
    </x-maz-sidebar-item>
    <x-maz-sidebar-item name="Pembayaran" icon="bi bi-stack">
        <x-maz-sidebar-sub-item name="Data Pembayaran" :link="route('components.accordion')"></x-maz-sidebar-sub-item>
    </x-maz-sidebar-item>

</x-maz-sidebar>