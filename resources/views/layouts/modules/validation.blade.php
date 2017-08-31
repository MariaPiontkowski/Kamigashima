@push("scripts")
    <script src="{{ asset("plugins/jquery-validation/jquery.validate.min.js") }}"></script>
    <script src="{{ asset("plugins/jquery-validation/additional-methods.min.js") }}"></script>
    <script src="{{ asset("plugins/jquery-validation/localization/messages_pt_BR.js") }}"></script>

    <script>
        $(function () {
            $(".form-validation").validate({
                ignore: ".ignore",
                rules: {
                    email: {
                        myEmail: true
                    },
                    password_confirmation: {
                        equalTo: "#password"
                    },
                    document: {
                        verifyCPF: true,
                        verifyCPFExists: true
                    }
                },
                invalidHandler: function (e, validator) {
                    if (validator.errorList.length) {
                        if ($(".nav-tabs").length) {
                            $(".nav-tabs a[href='#" + $(validator.errorList[0].element)
                                .closest(".tab-pane").attr("id") + "']").tab("show");
                        }
                    }
                },
                highlight: function (input) {
                    $(input).parents(".form-line").addClass("error");
                },
                unhighlight: function (input) {
                    $(input).parents(".form-line").removeClass("error");
                },
                errorPlacement: function (error, element) {
                    $(element).parents(".input-group").append(error);
                    $(element).parents(".form-group").append(error);
                }
            });
        });

        $.validator.addMethod("myEmail", function (value, element) {
            return this.optional(element) || (/^[a-z0-9]+([-._][a-z0-9]+)*@([a-z0-9]+(-[a-z0-9]+)*\.)+[a-z]{2,4}$/.test(value)
                && /^(?=.{1,64}@.{4,64}$)(?=.{6,100}$).*/.test(value));
        }, "Informe um endereço de e-mail válido.");

        $.validator.addMethod("verifyCPF", function (value) {
            var ret = true;

            var invalidos = [
                "111.111.111-11",
                "222.222.222-22",
                "333.333.333-33",
                "444.444.444-44",
                "555.555.555-55",
                "666.666.666-66",
                "777.777.777-77",
                "888.888.888-88",
                "999.999.999-99",
                "000.000.000-00"
            ];
            for (var i = 0; i < invalidos.length; i++) {
                if (invalidos[i] === value) {
                    ret = false;
                }
            }

            value = value.replace("-", "");
            value = value.replace(/\./g, "");

            var add = 0;
            for (i = 0; i < 9; i++) {
                add += parseInt(value.charAt(i), 10) * (10 - i);
            }

            var rev = 11 - ( add % 11 );
            if (rev === 10 || rev === 11) {
                rev = 0;
            }
            if (rev !== parseInt(value.charAt(9), 10)) {
                ret = false;
            }

            add = 0;
            for (i = 0; i < 10; i++) {
                add += parseInt(value.charAt(i), 10) * (11 - i);
            }
            rev = 11 - ( add % 11 );
            if (rev === 10 || rev === 11) {
                rev = 0;
            }
            if (rev !== parseInt(value.charAt(10), 10)) {
                ret = false;
            }

            return ret;
        }, "Informe um CPF válido.");

        $.validator.addMethod("verifyCPFExists", function (value) {
            var ret = true;

            value = value.replace("-", "");
            value = value.replace(/\./g, "");

            $.ajax({
                url: "{{ route("api.patient.document") }}",
                async: false,
                data: {document: value},
                success: function (response) {
                    if (response.id) {
                        ret = false;
                    }
                }
            });

            return ret;
        }, "Este CPF já está cadastrado.");
    </script>
@endpush