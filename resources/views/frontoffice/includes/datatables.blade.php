<link href="{{ asset('DataTables/datatables.css') }}" rel="stylesheet">
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('DataTables/datatables.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.DataTables').DataTable({
            pageLength: 10,
            language: {
                url: "{{ asset('/DataTables/bahasa.json') }}",
            }
        });
    });
</script>
