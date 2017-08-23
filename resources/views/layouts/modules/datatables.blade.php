@push('styles')
    <link href="{{ asset('plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('plugins/jquery-datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>

    <script>
        $('.table-basic').DataTable({
            language: {
                url: "{{ asset('plugins/jquery-datatable/i18n/Portuguese-Brasil.json') }}"
            },
            responsive: true,
            columnDefs: [{
                orderable: false,
                targets: [-1]
            }]
        });

        $('.table-exportable').DataTable({
            language: {
                url: "{{ asset('plugins/jquery-datatable/i18n/Portuguese-Brasil.json') }}"
            },
            dom: 'Bfrtip',
            responsive: true,
            buttons: [
                'excel', 'pdf', 'print'
            ],
            columnDefs: [{ "orderable": false, "targets": [-1] }]
        });
    </script>
@endpush