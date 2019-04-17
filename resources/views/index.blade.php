@extends('template')
@section('content')

@push('scripts')
<script>
    var comfalemais;
    var semfalemais;

    $("form").submit(function (e) {
        e.preventDefault();
        if (plano()) {

            switch ($("#plano").val()) {
                case '1':
                    if ($("#tempo").val() > 30) {
                        comfalemais = calcular_juros(calcular_tempo(30));
                    } else {
                        comfalemais = "R$ 00,00";
                    }
                    break;

                case '2':
                    if ($("#tempo").val() > 60) {
                        comfalemais = calcular_juros(calcular_tempo(60));
                    } else {
                        comfalemais = "R$ 00,00";
                    }
                    break;

                case '3':
                    if ($("#tempo").val() > 120) {
                        comfalemais = calcular_juros(calcular_tempo(120));
                    } else {
                        comfalemais = "R$ 00,00";
                    }
                    break;
            }
            semfalemais = calcular_tempo(0);

            $("table tbody").append(
                '<tr>'
                + '<td>' + $("#origem").val() + '</td>'
                + '<td>' + $("#destino").val() + '</td>'
                + '<td>' + $("#tempo").val() + ' minutos</td>'
                + '<td>' + $("#plano option:selected").text() + '</td>'
                + '<td>' + real(comfalemais) + '</td>'
                + '<td>' + real(semfalemais) + '</td></tr>'
            );
            this.reset();
        }
    });

    function calcular_tempo(t) {
        var tempo = $("#tempo").val() - t;
        var origem = parseInt($("#origem").val());
        var destino = parseInt($("#destino").val());

        switch (origem) {
            case 11:
                if (destino == 16) {
                    return tempo * 1.9;
                } else if (destino == 17) {
                    return tempo * 1.7;
                } else {
                    return tempo * 0.9;
                }
                break;

            case '016':
                return tempo * 2.9;
                break;

            case '017':
                return tempo * 2.7;
                break;

            case '018':
                return tempo * 1.9;
                break;
        }
    }

    function calcular_juros(valor) {
        return (valor * 0.1) + valor;
    }

    function real(valor) {
        return valor.toLocaleString('pt-br', { style: 'currency', currency: 'BRL' });
    }

    function plano() {
        var origem = parseInt($("#origem").val());
        var destino = parseInt($("#destino").val());
        if (origem === destino) {
            swal({ title: 'Origem deve ser diferente do destino', icon: 'error' });
            return false;
        } else if (origem > 11 || origem < 16) {
            swal({ title: "Apenas trabalhamos nos ddd's 11, 16, 17, 18 como origem", icon: 'error' });
            return false;
        } else if (origem > 18 || origem < 11) {
            swal({ title: "Apenas trabalhamos nos ddd's 11, 16, 17, 18 como origem", icon: 'error' });
            return false;
        } else if (destino > 11 || destino < 16) {
            swal({ title: "Apenas trabalhamos nos ddd's 11, 16, 17, 18 como destino", icon: 'error' });
            return false;
        } else if (destino > 18 || destino < 11) {
            swal({ title: "Apenas trabalhamos nos ddd's 11, 16, 17, 18 como destino", icon: 'error' });
            return false;
        }
    }
</script>
@endpush

<div id="main">
    <div class="row">
        <div id="breadcrumbs-wrapper" data-image="{{asset('img/bg/breadcrumb.jpg')}}">
            <div class="container">
                <div class="row">
                    <div class="col s12 m6 l6">
                        <h5 class="breadcrumbs-title mt-0 mb-0">Fale Mais</h5>
                    </div>
                    <div class="col s12 m6 l6 right-align-md">
                        <ol class="breadcrumbs mb-0">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12">
            <div class="container">
                <div class="seaction">
                    <div class="card">
                        <div class="card-content">
                            <h3 class="caption mb-0">Seja bem vindo ao VxTel</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <div id="placeholder" class="card card card-default scrollspy">
                                <div class="card-content">
                                    <h4 class="card-title">Calcule o Valor da Liganção</h4>
                                    <form>
                                        <div class="row">
                                            <div class="input-field col s3">
                                                <input type="number" id="origem" name="origem" placeholder="011">
                                                <label for="origem">DDD Origem</label>
                                            </div>
                                            <div class="input-field col s3">
                                                <input type="number" id="destino" name="destino" placeholder="011">
                                                <label for="destino">DDD Destino</label>
                                            </div>
                                            <div class="input-field col s3">
                                                <input type="number" id="tempo" name="tempo" placeholder="300">
                                                <label for="tempo">Tempo de Liganção em Minutos</label>
                                            </div>
                                            <div class="input-field col s3">
                                                <select id="plano" name="plano">
                                                    <option value="" disabled selected>Escolha o plano FaleMais</option>
                                                    <option value="1">FaleMais 30</option>
                                                    <option value="2">FaleMais 60</option>
                                                    <option value="3">FaleMais 120</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <button type="submit" class="btn cyan waves-effect waves-light right">
                                                    Calcular<i class="material-icons right">send</i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <div id="basic-form" class="card card card-default scrollspy">
                                <div class="card-content">
                                    <h4 class="card-title">Tabela de DDD</h4>
                                    <table class="table">
                                        <thead>
                                            <th>Origem</th>
                                            <th>Destino</th>
                                            <th>Tempo em Minutos</th>
                                            <th>Plano FaleMais</th>
                                            <th>Com FaleMais</th>
                                            <th>Sem FaleMais</th>
                                        </thead>
                                        <tbody>                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection