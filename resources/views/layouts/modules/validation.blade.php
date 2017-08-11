@push('scripts')
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-validation/localization/messages_pt_BR.js') }}"></script>

    <script>
        $(function () {
            $('.form-validation').validate({
                rules: {
                    email: {
                        myEmail: true
                    },
                    password_confirmation: {
                        equalTo: "#password"
                    }
                },
                highlight: function (input) {
                    $(input).parents('.form-line').addClass('error');
                },
                unhighlight: function (input) {
                    $(input).parents('.form-line').removeClass('error');
                },
                errorPlacement: function (error, element) {
                    $(element).parents('.input-group').append(error);
                    $(element).parents('.form-group').append(error);
                }
            });
        });

        $.validator.addMethod("myEmail", function (value, element) {
            return this.optional(element) || ( /^[a-z0-9]+([-._][a-z0-9]+)*@([a-z0-9]+(-[a-z0-9]+)*\.)+[a-z]{2,4}$/.test(value)
                && /^(?=.{1,64}@.{4,64}$)(?=.{6,100}$).*/.test(value) );
        }, 'Por favor, forneça um endereço de email válido.');
    </script>
@endpush