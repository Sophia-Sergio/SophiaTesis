<style>
    .form-group input[type="checkbox"] {
        display: none;
    }
    .form-group input[type="checkbox"] + .btn-group > label span {
        width: 20px;
    }
    .form-group input[type="checkbox"] + .btn-group > label span:first-child {
        display: none;
    }
    .form-group input[type="checkbox"] + .btn-group > label span:last-child {
        display: inline-block;
    }
    .form-group input[type="checkbox"]:checked + .btn-group > label span:first-child {
        display: inline-block;
    }
    .form-group input[type="checkbox"]:checked + .btn-group > label span:last-child {
        display: none;
    }
</style>
<form action="{{ route('tomaDocentes') }}" method="post" name="tomaCarrera" id="tomaCarrera">
    <hr/>
    @foreach($ramos as $ramo)
    <label> Ramo {{$ramo->nombre_ramo}}</label>
        @foreach($ramoDocentes as $rDocente)
            @if($ramo->id==$rDocente->id_ramo)
                <div class="form-group">
                    <input type="checkbox" name="ramo_docente[]" value="{{$rDocente->id}}" id="ramo_docente{{$rDocente->id}}" autocomplete="off" style="display: none;">
                    <div class="btn-group" style="width:100%">
                        <label for="ramo_docente{{$rDocente->id}}" class="btn btn-warning">
                            <span class="[ glyphicon glyphicon-ok ]"></span>
                            <span>&nbsp;</span>
                        </label>
                        <label for="ramo_docente{{$rDocente->id}}" class="[ btn btn-default active ]">
                            {{ $rDocente->nombre }} {{$rDocente->apellido_paterno}} {{$rDocente->apellido_materno}}
                        </label>
                    </div>
                </div>
            @endif
        @endforeach
        <hr/>
    @endforeach
    <input type="hidden" name="_token" value="{{ Session::token() }}">
    <button type="submit" class="btn btn-primary">Siguiente</button>
</form>