@extends('layout.app')

@section('Titulo', 'Sage2.0 - Divisiones')

@section('ContenidoPrincipal')
<section id="container" >
    <section id="main-content">
        <section class="wrapper">
            <!-- Inicio Selectores -->
            <a  href="/verArbolServicio#tab_2" class=""  title="Volver a Servicio"  >
                <span class="material-symbols-outlined">
                    reply_all
                </span> VOLVER
            </a>
            <div class="row">
                <!-- datos agente -->
                <div class="col-md-6">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">
                            <i class="fas fa-book"></i>
                            Panel de Control - Actualizar Información Docente 
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <form method="POST" action="{{ route('formularioActualizarAgente') }}" class="formularioActualizarAgente">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="Descripcion">Docente: </label>
                                    <input type="text" class="form-control" id="Descripcion" name="Descripcion" placeholder="Ingrese Descripcion" value="{{$infoNodos[0]->Nombres}}">
                                </div>
                                <div class="form-group">
                                    <label for="Curso">Cargos / Función</label>
                                    <select class="form-control" name="CargoSalarial" id="CargoSalarial">
                                     @foreach($CargosSalariales as $key => $o)
                                        @if ($o->idCargo == $infoNodos[0]->idCargo)
                                            <option value="{{$o->idCargo}}" selected="selected">({{$o->Codigo}}) - {{$o->Cargo}}</option>
                                        @else
                                            <option value="{{$o->idCargo}}">({{$o->Codigo}}) - {{$o->Cargo}}</option>
                                        @endif
                                    @endforeach 
                                    </select>
                                </div>  
                                <div class="form-group">
                                    <label for="EspCur">Espacio Curricular</label>
                                    <select class="form-control" name="EspCur" id="EspCur">
                                    @foreach($EspaciosCurriculares as $key => $o)
                                        @if ($o->idEspacioCurricular == $infoNodos[0]->EspacioCurricular)
                                            <option value="{{$o->idEspacioCurricular}}" selected="selected">{{$o->Descripcion}}</option>
                                        @else
                                            <option value="{{$o->idEspacioCurricular}}">{{$o->Descripcion}}</option>
                                        @endif
                                    @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="SitRev">Situación de Revista</label>
                                    <select class="form-control" name="SitRev" id="SitRev">
                                    @foreach($SituacionDeRevista as $key => $o)
                                        @if ($o->idSituacionRevista == $infoNodos[0]->SitRev)
                                            <option value="{{$o->idSituacionRevista}}" selected="selected">{{$o->Descripcion}}</option>
                                        @else
                                            <option value="{{$o->idSituacionRevista}}">{{$o->Descripcion}}</option>
                                        @endif
                                    @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="Division">Sala / Curso / División</label>
                                    <select class="form-control" name="Division" id="Division">
                                    @foreach($Divisiones as $key => $o)
                                        @if ($o->idDivision == $infoNodos[0]->Division)
                                            <option value="{{$o->idDivision}}" selected="selected">{{$o->Descripcion}} - {{$o->DescripcionTurno}}</option>
                                        @else
                                            <option value="{{$o->idDivision}}">{{$o->Descripcion}} - {{$o->DescripcionTurno}}</option>
                                        @endif
                                    @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="CantidadHoras">Cantidad de Horas</label>
                                    <input type="number" class="form-control" id="CantidadHoras" name="CantidadHoras" placeholder="Ingrese Cantidad de Horas trabajadas" value="{{$infoNodos[0]->CantidadHoras}}">
                                </div>
                                <div class="form-group">
                                    <label for="FA">Fecha de Alta</label>
                                    <input type="date" class="form-control" id="FA" name="FA" placeholder="Ingrese Fecha de Alta" value="{{ \Carbon\Carbon::parse($infoNodos[0]->FechaDeAlta)->format('Y-m-d')}}">
                                    <input type="hidden" name="nodo" value="{{$infoNodos[0]->idNodo}}">
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Actualizar Informacion</button>
                                </div>
                            </div>
                        </form>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- datos horario -->
                <div class="col-md-6">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">
                            <i class="fas fa-book"></i>
                            Panel de Control - Dias Disponibles y Horarios
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <form method="POST" action="{{ route('formularioActualizarAgente') }}" class="formularioActualizarAgente">
                            @csrf
                            <div class="card-body">
                                @php
                                $contador=1;
                                @endphp
                                @foreach($DiasSemana as $key => $o)
                                    @php
                                        $DiasRelNodo= DB::table('tb_horarios')
                                                ->where([
                                                    ['Nodo',$Nodo],
                                                    ['DiaDeLaSemana',$o->idDiaSemana]
                                                ])
                                                ->get();
                                        $contador=1;
                                    @endphp 
                                    @if (count($DiasRelNodo)>0)
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-3">
                                                    <label>{{$o->Descripcion}}</label>
                                                </div>
                                                <div class="col-8">
                                                    <div class="icheck-danger d-inline">
                                                        <input type="radio" name="r{{$o->idDiaSemana}}"  value="NO" id="turnos{{$o->idDiaSemana}}">
                                                        <label for="turnos{{$o->idDiaSemana}}"></label>
                                                    </div>
                                                    <div class="icheck-success d-inline">
                                                        <input type="radio" name="r{{$o->idDiaSemana}}" checked="true" value="SI" id="turnosx{{$o->idDiaSemana}}">
                                                        <label for="turnosx{{$o->idDiaSemana}}"><input type="text" class="form-control"  name="horario_si"></label>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group clearfix"></div>
                                        </div>                                        
                                    @else
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-3">
                                                    <label>{{$o->Descripcion}}</label>
                                                </div>
                                                <div class="col-8">
                                                    <div class="icheck-danger d-inline">
                                                        <input type="radio" name="r{{$o->idDiaSemana}}" checked="true" value="NO" id="turnos{{$o->idDiaSemana}}">
                                                        <label for="turnos{{$o->idDiaSemana}}"></label>
                                                    </div>
                                                    <div class="icheck-success d-inline">
                                                        <input type="radio" name="r{{$o->idDiaSemana}}" value="SI" id="turnosx{{$o->idDiaSemana}}">
                                                        <label for="turnosx{{$o->idDiaSemana}}"><input type="text" class="form-control"  name="horario_si"></label>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group clearfix"></div>
                                        </div> 
                                    @endif
                                 @endforeach
                        
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Actualizar Informacion</button>
                                </div>
                            </div>
                        </form>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                                
                
            </div>
            
        </section>
    </section>
</section>

@endsection

@section('Script')


    <script type="text/javascript" charset="utf-8">
        $(document).ready(function() {
            $('#example').dataTable( {
                "aaSorting": [[ 1, "asc" ]],
                "oLanguage": {
                    "sLengthMenu": "Escuelas _MENU_ por pagina",
                    "search": "Buscar:",
                    "oPaginate": {
                        "sPrevious": "Anterior",
                        "sNext": "Siguiente"
                    }
                }
            } );
        } );
  </script>


<script src="{{ asset('js/funcionesvarias.js') }}"></script>
        @if (session('ConfirmarActualizarDivisiones')=='OK')
            <script>
            Swal.fire(
                'Registro guardado',
                'Se actualizo correctamente',
                'success'
                    )
            </script>
        @endif
    <script>

    $('.formularioActualizarAgente').submit(function(e){
        e.preventDefault();
        Swal.fire({
            title: 'Esta seguro de querer actualizar la informacion del agente?',
            text: "Recuerde colocar datos verdaderos",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, guardo el registro!'
          }).then((result) => {
            if (result.isConfirmed) {
              this.submit();
            }
          })
    })
    
    
</script>
 <script src="{{ asset('js/funcionesvarias.js') }}"></script>
        @if (session('ConfirmarActualizarAgente')=='OK')
            <script>
            Swal.fire(
                'Registro guardado',
                'Se desvinculo correctamente',
                'success'
                    )
            </script>
        @endif
    



@endsection