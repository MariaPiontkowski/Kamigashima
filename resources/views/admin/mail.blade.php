<?
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

?>

<section style="font-family: 'Trebuchet MS', Helvetica, sans-serif">
    
    <h3>Nova Consulta!</h3>
    <br/>
    <p>Olá {{$return[0]->patient }}, sua consulta foi agendada com sucesso.</p>
    <br/>
    <p style="margin-bottom: 30px">Confira abaixo os detalhes:</p>

    <p style="margin-left: 30px">Dia: {{ ucwords(strftime('%A, %d  %B %Y', strtotime($return[0]->date))) }}</p>
    <p style="margin-left: 30px">Hora: {{ $return[0]-> hour }}</p>
    <p style="margin-left: 30px">Sessão: 1</p>

    @if(count($return) > 1)

        <br/>
        <p style="margin-bottom: 30px">Próximas Sessões:</p>

        @for($i=1; $i < count($return); $i++)
            <p style="margin-left: 30px">Dia: {{ ucwords(strftime('%A, %d %B %Y', strtotime($return[$i]->date)))  }}</p>
            <p style="margin-left: 30px">Hora: {{ $return[$i]-> hour }}</p>
            <p style="margin-left: 30px">Sessão: {{ 1+$i }} </p>
            <br/>
        @endfor

    @endif

</section>


