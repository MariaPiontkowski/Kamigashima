@push('styles')
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert/sweetalert.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('plugins/sweetalert/sweetalert.min.js') }}"></script>

    <script>
        $(function () {
            $('.dialog-btn').on('click', function () {
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
                title: "Deseja realmente excluir?",
                text: "Você não poderá mais recuperar esta informação!",
                type: "warning",
                showCancelButton: true,
                cancelButtonText: "Cancelar",
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Sim, quero excluir!",
                closeOnConfirm: false
            }, function () {
                button.closest('form').submit();
            });
        }
    </script>
@endpush