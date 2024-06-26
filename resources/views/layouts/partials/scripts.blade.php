@vite(["resources/js/app.js"])

<script src="{{ asset('/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('/vendors/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('/js/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('/js/datatables.js') }}"></script>
<script src="{{ asset('/js/datatables.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>

@livewireScripts
<script src="{{ asset('/js/main.js') }}"></script>

{{ $script ?? ''}}