@push('styles')
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert/sweetalert.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('plugins/sweetalert/sweetalert.min.js') }}"></script>

    <script>
        $(function () {
            $('body').on('click', '.dialog-btn', function (e) {
                e.preventDefault();
                var type = $(this).data('type');
                switch (type) {
                    case 'confirm':
                        showConfirmMessage($(this));
                        break;
                }
            });
        });

        function showConfirmMessage(button) {
            swal({
                title: "Deseja realmente remover?",
                text: "Você não poderá mais recuperar esta informação!",
                type: "warning",
                showCancelButton: true,
                cancelButtonText: "Cancelar",
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Sim, quero remover!",
                closeOnConfirm: false
            }, function () {
                var form = $("#" + button.data('form'));
                form.submit();
            });
        }
    </script>
@endpush