<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active">
        <a href="#tab-profile" data-toggle="tab">
            <i class="material-icons">account_circle</i> Perfil
        </a>
    </li>
    <li role="presentation">
        <a href="#tab-address" data-toggle="tab">
            <i class="material-icons">home</i> Endereço
        </a>
    </li>
    <li role="presentation">
        <a href="#tab-contact" data-toggle="tab">
            <i class="material-icons">import_contacts</i> Contato
        </a>
    </li>
    <li role="presentation">
        <a href="#tab-agreements" data-toggle="tab">
            <i class="material-icons">card_membership</i> Convênio
        </a>
    </li>
    <li role="presentation">
        <a href="#tab-responsible" data-toggle="tab">
            <i class="material-icons">card_membership</i> Responsável
        </a>
    </li>
</ul>

<form class="form-validation" action="{{ $action }}" method="post">
    {{ csrf_field() }}
    {{ method_field($method) }}

    <div class="tab-content p-l-15 p-r-15 p-t-35">
        <div id="tab-profile" class="tab-pane fade in active" role="tabpanel">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <div class="form-line">
                            <input id="name" name="name" class="form-control" value="{{ $patient->name }}"
                                   placeholder="Digite o nome do paciente" required autofocus>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="document">CPF</label>
                        <div class="form-line">
                            <input id="document" name="document" class="form-control document"
                                   value="{{ $patient->document }}"
                                   placeholder="Digite o documento do paciente"
                                   {{ $patient->document ? "disabled" : "" }} required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="gender">Sexo</label>
                        <div class="form-line">
                            <select name="gender" class="form-control show-tick selectpicker"
                                    title="Selecione o sexo do paciente">
                                <option value="F" {{ $patient->gender == "F" ? "selected" : "" }}>Feminino</option>
                                <option value="M" {{ $patient->gender == "M" ? "selected" : "" }}>Masculino</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="birthday">Data de Aniversário <span></span></label>
                        <div class="form-line">
                            <input id="birthday" name="birthday" class="form-control"
                                   value="{{ $patient->birthday ? \Carbon\Carbon::parse($patient->birthday)->format("d/m/Y") : "" }}"
                                   placeholder="Escolha a data de aniversário do paciente">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <div class="form-line">
                            <label for="profession">Profissão</label>
                            <input id="profession" name="profession" class="form-control"
                                   value="{{ $patient->profession }}"
                                   placeholder="Digite a profissão do paciente">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="indication">Indicação</label>
                        <div class="form-line">
                            <input id="indication" name="indication" class="form-control"
                                   value="{{ $patient->indication }}"
                                   placeholder="Digite quem indicou o paciente">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="tab-address" class="tab-pane fade" role="tabpanel">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <div class="form-line">
                            <label for="zip">CEP</label>
                            <input id="zip" name="zip" class="form-control address-group"
                                   value="{{ $patient->address ? $patient->address->zip_code : "" }}"
                                   placeholder="Digite o CEP do paciente">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <div class="form-line">
                            <label for="address">Endereço</label>
                            <input id="address" name="address" class="form-control address-group"
                                   value="{{ $patient->address ? $patient->address->address : "" }}"
                                   placeholder="Digite o endereço do paciente">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="number">Número</label>
                        <div class="form-line">
                            <input id="number" name="number" class="form-control address-group"
                                   value="{{ $patient->address ? $patient->address->number : "" }}"
                                   placeholder="Digite o número do endereço do paciente">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <div class="form-line">
                            <label for="complement">Complemento</label>
                            <input id="complement" name="complement" class="form-control"
                                   value="{{ $patient->address ? $patient->address->complement : "" }}"
                                   placeholder="Digite o complemento do endereço do paciente">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="district">Bairro</label>
                        <div class="form-line">
                            <input id="district" name="district" class="form-control address-group"
                                   value="{{ $patient->address ? $patient->address->district : "" }}"
                                   placeholder="Digite o bairro do endereço do paciente">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <div class="form-line">
                            <label for="city">Cidade</label>
                            <input id="city" name="city" class="form-control address-group"
                                   value="{{ $patient->address ? $patient->address->city : "" }}"
                                   placeholder="Digite a cidade do endereço do paciente">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="state">Estado</label>
                        <div class="form-line">
                            <input id="state" name="state" class="form-control address-group"
                                   value="{{ $patient->address ? $patient->address->state : "" }}"
                                   placeholder="Digite o estado do endereço do paciente">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="tab-contact" class="tab-pane fade" role="tabpanel">
            <div class="row">
                @php
                    $mobileNumber = "";
                    $phoneNumber = "";
                    foreach ($patient->phones as $phone) {
                        switch ($phone->type) {
                            case 1:
                                $phoneNumber = $phone->phone;
                            break;
                            case 2:
                                $mobileNumber = $phone->phone;
                            break;
                        }
                    }
                @endphp
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="phone">Telefone Fixo</label>
                        <div class="form-line">
                            <input type="tel" id="phone" name="phone" class="form-control" value="{{ $phoneNumber }}"
                                   placeholder="Digite um telefone fixo para o paciente">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="mobile">Telefone Celular</label>
                        <div class="form-line">
                            <input type="tel" id="mobile" name="mobile" class="form-control" value="{{ $mobileNumber }}"
                                   placeholder="Digite um telefone celular para o paciente">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <div class="form-line">
                            <input type="email" id="email" name="email" class="form-control"
                                   value="{{ $patient->email }}" placeholder="Digite o e-mail do paciente">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="tab-agreements" class="tab-pane fade" role="tabpanel">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="agreement">Convênio</label>
                        <div class="form-line">
                            <select name="agreement" class="form-control show-tick selectpicker agreement-group"
                                    title="Selecione o convênio">
                                @foreach($agreements as $agreement)
                                    <option value="{{ $agreement->id }}"
                                            {{ $patient->agreement && $agreement->id == $patient->agreement->agreement_id ? "selected" : "" }}>
                                        {{ $agreement->agreement }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="code">Código do Convênio</label>
                        <div class="form-line">
                            <input type="text" id="code" name="code" class="form-control agreement-group"
                                   value="{{ $patient->agreement ? $patient->agreement->code : "" }}"
                                   placeholder="Digite o código do convênio">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="type">Tipo do Convênio</label>
                        <div class="form-line">
                            <input type="text" id="type" name="type" class="form-control agreement-group"
                                   value="{{ $patient->agreement ? $patient->agreement->type : "" }}"
                                   placeholder="Digite o tipo do convênio">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="validity">Validade<span></span></label>
                        <div class="form-line">
                            <input id="validity" name="validity" class="form-control agreement-group"
                                   value="{{ $patient->agreement ? \Carbon\Carbon::parse($patient->agreement->validity)->format("d/m/Y") : "" }}"
                                   placeholder="Escolha a data de validade do convênio">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="tab-responsible" class="tab-pane fade" role="tabpanel">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="responsible">Responsável</label>
                        <div class="form-line">
                            <input type="text" id="responsible" name="responsible"
                                   class="form-control responsible-group"
                                   value="{{ $patient->responsible ? $patient->responsible->name : "" }}"
                                   placeholder="Digite o nome do responsável">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="responsibleDocument">Documento</label>
                        <div class="form-line">
                            <input type="text" id="responsibleDocument" name="responsibleDocument"
                                   class="form-control document responsible-group"
                                   value="{{ $patient->responsible ? $patient->responsible->document : "" }}"
                                   placeholder="Digite o documento do responsável">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row button-demo">
        <div class="col-sm-10">
            <button class="btn bg-light-green m-t-15 waves-effect">Salvar</button>
            <a href="{{ route("paciente.index") }}" class="btn bg-grey m-t-15 waves-effect">Voltar</a>
            @if($patient->id)
                <a href="{{route("paciente.prontuario.index", $patient->id)}}" class="btn bg-teal m-t-15 waves-effect">
                    Prontuário
                </a>
            @endif
        </div>
        @if($patient->id)
            <div class="col-sm-2">
                <a href="#" class="btn bg-red m-t-15 waves-effect dialog-btn" data-form="form-delete"
                   data-type="confirm">
                    Remover Paciente
                </a>
            </div>
        @endif
    </div>
</form>

@if($patient->id)
    <form id="form-delete" action="{{ route("paciente.destroy", $patient->id) }}" method="post">
        {{ csrf_field() }}
        {{ method_field("delete") }}
    </form>
@endif

@push("styles")
    <link rel="stylesheet"
          href="{{ asset("plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.min.css") }}">
@endpush

@push("scripts")
    <script src="{{ asset("plugins/momentjs/moment-with-locales.min.js") }}"></script>
    <script src="{{ asset("plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.min.js") }}"></script>
    <script src="{{ asset("plugins/jquery-inputmask/jquery.inputmask.bundle.min.js") }}"></script>

    <script>
        $(function () {
            $("#phone").inputmask({
                mask: "(99) 9999-9999",
                showMaskOnHover: false,
                clearIncomplete: true
            });

            $("#mobile").inputmask({
                mask: "(99) 99999-9999",
                showMaskOnHover: false,
                clearIncomplete: true
            });

            $(".document").inputmask({
                mask: "999.999.999-99",
                showMaskOnHover: false,
                clearIncomplete: true
            });

            $("#validity").bootstrapMaterialDatePicker({
                format: "DD/MM/YYYY",
                clearButton: true,
                time: false,
                lang: "pt-br",
                minDate: new Date(),
                cancelText: "Cancelar",
                clearText: "Limpar"
            });

            var zip = $("#zip");
            getZip(zip);

            zip.inputmask({
                mask: "99999-999",
                showMaskOnHover: false,
                clearIncomplete: true
            });

            var birthday = $("#birthday");
            birthday.bootstrapMaterialDatePicker({
                format: "DD/MM/YYYY",
                clearButton: true,
                time: false,
                lang: "pt-br",
                maxDate: new Date(),
                cancelText: "Cancelar",
                clearText: "Limpar"
            });
            calculateAge(birthday);

            birthday.on("change", function () {
                calculateAge($(this));
            });

            var addressGroup = $('.address-group');
            addressGroup.on("keyup", function () {
                requiredGroup(addressGroup);
            });

            var agreementGroup = $('.agreement-group');
            agreementGroup.on("keyup change", function () {
                requiredGroup(agreementGroup);
            });

            var responsibleGroup = $('.responsible-group');
            responsibleGroup.on("keyup", function () {
                requiredGroup(responsibleGroup);
            });

        });

        function requiredGroup(group) {
            var i = 0;
            group.each(function () {
                if ($(this).val()) {
                    i++;
                }
            });

            if (i === 0) {
                group.attr("required", false);
                group.parents(".form-line").removeClass("error");
                group.parents(".form-group").find("label.error").remove();
            } else {
                group.each(function () {
                    if ($(this).val()) {
                        $(this).parents(".form-line").removeClass("error");
                        $(this).parents(".form-group").find("label.error").remove();
                    }
                });
                group.attr("required", true);
            }
        }

        function getZip(zip) {
            zip.on("keyup change", function () {
                if (zip.val() && /^\d{5}-\d{3}$/.test(zip.val())) {
                    var zipValue = zip.val().replace("-", "");
                    $.ajax({
                        url: "https://viacep.com.br/ws/" + zipValue + "/json/unicode/",
                        async: false,
                        success: function (response) {
                            $("#address").val(response.logradouro);
                            $("#district").val(response.bairro);
                            $("#city").val(response.localidade);
                            $("#state").val(response.uf);

                            requiredGroup($('.address-group'));
                        }
                    })
                }
            });
        }

        function calculateAge(birthday) {
            var span = birthday.closest(".form-group").find("label").find("span"),
                dateFormatted = moment(birthday.val(), "L").format("YYYY-MM-DD 00:00:00"),
                today = new Date(),
                dob = new Date(dateFormatted),
                age = today.getFullYear() - dob.getFullYear(),
                ageText = " anos";

            if (new Date(today.getFullYear(), today.getMonth(), today.getDate()) <
                new Date(today.getFullYear(), dob.getMonth(), dob.getDate())) {
                age--;
            }

            if (age === 1) {
                ageText = " ano";
            }

            if (!isNaN(age)) {
                span.text("(" + age + ageText + ")");
            }
        }
    </script>
@endpush

@include("layouts.modules.dialogs")
@include("layouts.modules.validation")

