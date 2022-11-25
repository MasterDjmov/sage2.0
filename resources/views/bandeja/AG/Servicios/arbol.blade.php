@extends('layout.app')

@section('Titulo', 'Sage2.0 - Movimientos')

@section('ContenidoPrincipal')
  
    <section id="container">
        <section id="main-content">
            <section class="wrapper">
        <h5 class="mt-4 mb-2">POF(Planta Organica Funcional) - Prueba</h5>

        <div class="row">
          <div class="col-12">
            <!-- Custom Tabs -->
            <div class="card">
              <div class="card-header d-flex p-0">
                <h3 class="card-title p-3">Panel de Control POF - CUE COMPLETO: {{session('CUEa')}}</h3>
                <ul class="nav nav-pills ml-auto p-2">
                  <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Agregar Agente</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Ver Agentes</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">Extras</a></li>
                  
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                    
                    <h3>Configurar Nuevo Agente / Docente:</h3>
                        <div class="container mt-3 d-block">
                         <form method="POST" action="{{ route('agregarAgenteEscuela') }}" class="formularioNuevoAgenteNodo">
                            @csrf
                          <div class="row">
                            <!--primera Card-->
                            <div class="ml-1">
                              <div class="card shadow-lg bg-suplente">
                                <div class="card-title mt-4 d-flex justify-content-center">
                                  <h5 id="DescripcionNombreAgente" class="mb-0">Docente: </h5>
                                  <input type="hidden" name="idAgenteNuevoNodo" id="idAgenteNuevoNodo" value="">
                                </div>
                                <div class="card-body">
                                  <p class="mb-0">Cargo/Función: <label for="cargo" id="DescripcionCargo"> Sin Selección </label>
                                   <input type="hidden" id="CargoSal" name="CargoSal" value="">
                                  </p>
                                  <p class="mb-0">Esp. Curricular: <label for="DescripcionEspCur" id="DescripcionEspCur"> Sin Selección </label>
                                   <input type="hidden" id="idEspCur" name="idEspCur" value="">
                                  </p>
                                  <p class="mb-0">Sit.Rev:
                                  <select name="SituacionDeRevista" id="SituacionDeRevista" onchange="controlarCambio()">
                                    @foreach ($SituacionDeRevista as $sr)
                                      <option value='{{$sr->idSituacionRevista}}'>{{$sr->Descripcion}}</option>
                                    @endforeach
                                    </select>
                                  </p>
                                  
                                  <p class="mb-0">Sala/Division/Año: 
                                      <select  name="idDivision" id="idDivision">
                                      @foreach($Divisiones as $key => $o)
                                          <option value="{{$o->idDivision}}">{{$o->DescripcionCurso}} - "{{$o->DescripcionDivision}}" - {{$o->DescripcionTurno}}</option>
                                      @endforeach
                                      </select>
                                   </p>
                                  <p class="mb-0">Horas: <input type="number" id="cant_horas"  name="cant_horas" style="width:50px" value=""></p>
                                  <p class="mb-0">Fecha de Alta(Res): <input type="date" id="FechaAltaN"  name="FechaAltaN" style="width:125px" value=""></p>
                                </div>
                                <div class="card-footer">
                                  {{-- <a type="button" href="#" class="btn mx-1" data-toggle="tooltip" data-placement="top" title="Licencia">
                                    <span class="material-symbols-outlined pt-1">medical_services</span>
                                  </a> --}}
                                  <a  href="#modalAgente" class="btn mx-1 " data-toggle="modal" data-placement="top" title="Agregar Docente"  data-target="#modalAgente">
                                    <span class="material-symbols-outlined pt-1" >group_add</span>
                                  </a>
                                  <a  href="#modalCargo" class="btn mx-1 " data-toggle="modal" data-placement="top" title="Cargo/Funcion"  data-target="#modalCargo">
                                    <span class="material-symbols-outlined pt-1" >library_add</span>
                                  </a>
                                  <a  href="#modalEspCur" class="btn mx-1 " data-toggle="modal" data-placement="top" title="Esp. Curricular"  data-target="#modalEspCur">
                                    <span class="material-symbols-outlined pt-1" >view_timeline</span>
                                  </a>
                                 
                                  {{-- <a href="#" class="btn mx-1">
                                    <span class="material-symbols-outlined pt-1" data-toggle="modal" data-placement="top" title="Traslado/Afectación">transfer_within_a_station</span>
                                  </a> --}}
                                  <button type="submit" name="btnAgregarAgenteNuevo" class="btn mx-1">
                                  {{-- <a href="#" > --}}
                                    <span class="material-symbols-outlined pt-1" data-toggle="tooltip" data-placement="top" title="Confirmar">done</span>
                                  {{-- </a> --}}
                                  </button>
                                  {{-- <a href="{{route('agregaNodo',1)}}" class="btn mx-1">
                                    <span class="material-symbols-outlined pt-1" data-toggle="tooltip" data-placement="top" title="Vincular">compare_arrows</span>
                                  </a> --}}
                                </div>
                              </div>
                            </div>
                            <!--Fin primera Card-->
                            <!--Flechita-->
                            <div class="d-flex align-self-center ml-2 mb-4">
                              <div class="align-items-center st0"></div>
                              <div class="align-items-center st2"></div>
                            </div>

                            <!--segunda Card-->
                            <div class="ml-1" id="SegundaVentana" style="display:none;">
                              <div class="card shadow-lg bg-suplente">
                                <div class="card-title mt-4 d-flex justify-content-center">
                                  <h5 id="xDescripcionNombreAgente" class="mb-0">Docente: </h5>
                                  <input type="hidden" name="xidAgenteNuevoNodo" id="xidAgenteNuevoNodo" value="">
                                </div>
                                <div class="card-body">
                                  <p class="mb-0">Cargo/Función: <label for="cargo" id="xDescripcionCargo"> Sin Selección </label>
                                   <input type="hidden" id="xCargoSal" name="xCargoSal" value="">
                                  </p>
                                  <p class="mb-0">Esp. Curricular: <label for="DescripcionEspCur" id="xDescripcionEspCur"> Sin Selección </label>
                                   <input type="hidden" id="xidEspCur" name="xidEspCur" value="">
                                  </p>
                                  <p class="mb-0">Sit.Rev:
                                  <select name="xSituacionDeRevista" id="xituacionDeRevista" onchange="controlarCambio()">
                                    @foreach ($SituacionDeRevista as $sr)
                                      <option value='{{$sr->idSituacionRevista}}'>{{$sr->Descripcion}}</option>
                                    @endforeach
                                    </select>
                                  </p>
                                  
                                  <p class="mb-0">Sala/Division/Año: 
                                      <select  name="xidDivision" id="xidDivision">
                                      @foreach($Divisiones as $key => $o)
                                          <option value="{{$o->idDivision}}">{{$o->DescripcionCurso}} - "{{$o->DescripcionDivision}}" - {{$o->DescripcionTurno}}</option>
                                      @endforeach
                                      </select>
                                   </p>
                                  <p class="mb-0">Horas: <input type="number" id="xcant_horas"  name="xcant_horas" style="width:50px" value=""></p>
                                  <p class="mb-0">Fecha de Alta(Res): <input type="date" id="xFechaAltaN"  name="xFechaAltaN" style="width:125px" value=""></p>
                                </div>
                                <div class="card-footer">
                                  {{-- <a type="button" href="#" class="btn mx-1" data-toggle="tooltip" data-placement="top" title="Licencia">
                                    <span class="material-symbols-outlined pt-1">medical_services</span>
                                  </a> --}}
                                  <a  href="#modalAgente" class="btn mx-1 " data-toggle="modal" data-placement="top" title="Agregar Docente"  data-target="#modalAgente">
                                    <span class="material-symbols-outlined pt-1" >group_add</span>
                                  </a>
                                  <a  href="#modalCargo" class="btn mx-1 " data-toggle="modal" data-placement="top" title="Cargo/Funcion"  data-target="#modalCargo">
                                    <span class="material-symbols-outlined pt-1" >library_add</span>
                                  </a>
                                  <a  href="#modalEspCur" class="btn mx-1 " data-toggle="modal" data-placement="top" title="Esp. Curricular"  data-target="#modalEspCur">
                                    <span class="material-symbols-outlined pt-1" >view_timeline</span>
                                  </a>
                                 
                                  {{-- <a href="#" class="btn mx-1">
                                    <span class="material-symbols-outlined pt-1" data-toggle="modal" data-placement="top" title="Traslado/Afectación">transfer_within_a_station</span>
                                  </a> --}}
                                  <button type="submit" name="btnAgregarNodo" class="btn mx-1">
                                  {{-- <a href="#" > --}}
                                    <span class="material-symbols-outlined pt-1" data-toggle="tooltip" data-placement="top" title="Confirmar">done</span>
                                  {{-- </a> --}}
                                  </button>
                                  {{-- <a href="{{route('agregaNodo',1)}}" class="btn mx-1">
                                    <span class="material-symbols-outlined pt-1" data-toggle="tooltip" data-placement="top" title="Vincular">compare_arrows</span>
                                  </a> --}}
                                </div>
                              </div>
                            </div>
                            <!--Fin segunda Card-->
                          </div>
                        </form>
                      </div>




                      <!-- /.modal -->
                      <div class="modal fade" id="modalEspCur">
                        <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h4 class="modal-title">Buscar Espacios Curriculares</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                            
                                <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">Buscar Cargos / Funciones: </h3>
                                            {{-- <input type="text" class="form-control" id="btCargos" onkeyup="getCargosFunciones()" placeholder="Ingrese Cargo/Funcion o Codigo Salarial"> --}}
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <table id="example" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Descripcion</th>
                                                    <th>Opciones</th>
                                                </tr>
                                            </thead>
                                            <tbody id="contenidoEspCur">
                                             @foreach($EspaciosCurriculares as $key => $o)
                                                <tr class="gradeX">
                                                  <td>{{$o->idEspacioCurricular}}</td>
                                                  <td>{{$o->Descripcion}}
                                                    <input type="hidden" id="nomAsignaturaAgenteModal{{$o->idEspacioCurricular}}" value="{{$o->Descripcion}}">
                                                    <input type="hidden" id="idAsignaturaAgenteModal{{$o->idEspacioCurricular}}" value="{{$o->idEspacioCurricular}}">
                                                  </td>
                                                  <td>
                                                      <button type="button" name="btnSeleccionar" onclick="seleccionarAsigAgente({{$o->idEspacioCurricular}})">Seleccionar Asignatura</button>
                                                  </td>
                                                </tr>
                                              @endforeach
                                            </tbody>
                                            </table>
                                        </div>
                                        <!-- /.card-body -->
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-primary"  data-dismiss="modal">Salir</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                      </div>
                      <!-- /.modal -->

                      <!-- /.modal -->
                      <div class="modal fade" id="modalCargo">
                        <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h4 class="modal-title">Buscar Cargo/Función</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                            
                                <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">Buscar Cargos / Funciones: </h3>
                                            <input type="text" class="form-control" id="btCargos" onkeyup="getCargosFunciones()" placeholder="Ingrese Cargo/Funcion o Codigo Salarial">
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <table id="examplex" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Apellido y Nombre</th>
                                                    <th>DNI</th>
                                                    <th>Opciones</th>
                                                </tr>
                                            </thead>
                                            <tbody id="contenidoCargosFunciones">
                                            
                                            </tbody>
                                            </table>
                                        </div>
                                        <!-- /.card-body -->
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-primary"  data-dismiss="modal">Salir</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                      </div>
                      <!-- /.modal -->

                    <div class="modal fade" id="modalAgente">
                        <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h4 class="modal-title">Buscar Agente</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                            
                                <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">Lista de Agentes: </h3>
                                            <input type="text" class="form-control" id="buscarAgente" placeholder="Ingrese DNI sin Puntos" value="">
                                            <button class="btn btn-success" type="button" id="traerAgentes" onclick="getAgentes()">buscar
                                                <i class="fa fa-search"></i></button>
                                        
                                        <label>CUE:<b>{{ session('CUE') }}</b></label>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <table id="examplex" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Apellido y Nombre</th>
                                                    <th>DNI</th>
                                                    <th>Opciones</th>
                                                </tr>
                                            </thead>
                                            <tbody id="contenidoAgentes">
                                            
                                            </tbody>
                                            </table>
                                        </div>
                                        <!-- /.card-body -->
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-primary"  data-dismiss="modal">Salir</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2">
                      {{-- Agente info Inicio--}}
                      <h3>Organizacion: {{$nombreSubOrg}} - CUE: {{ $CueOrg }}</h3>
                      {{-- RepNodos --}}
                      @foreach ($infoNodos as $key => $o)
                        <div class="container mt-3 d-block">
                         <form method="POST" action="" class="">
                            @csrf
                          <div class="row">
                            <!--primera Card-->
                            <div class="ml-1">
                              <div class="card shadow-lg bg-suplente">
                                <div class="card-title mt-4 d-flex justify-content-center">
                                  <h5 id="DescripcionNombreAgente" class="mb-0">({{$o->idNodo}})Docente: {{$o->Nombres}} </h5>
                                  <input type="hidden" name="idAgente" id="idAgente2" value="{{$o->idAgente}}">
                                </div>
                                <div class="card-body">
                                  <p class="mb-0">Cargo/Función: <label for="cargo" id="DescripcionCargo">{{$o->nomCargo}} - ({{$o->nomCodigo}})</label>
                                   <input type="hidden" id="CargoSal2" name="CargoSal" value="{{$o->idCargo}}">
                                  </p>
                                  <p class="mb-0">Esp. Curricular: <label for="DescripcionEspCur" id="DescripcionEspCur">{{$o->nomAsignatura}}</label>
                                   <input type="hidden" id="idEspCur2" name="idEspCur" value="{{$o->idAsignatura}}">
                                  </p>
                                  <p class="mb-0">Sit.Rev: 
                                  
                                    @foreach ($SituacionDeRevista as $sr)
                                      @if ($sr->idSituacionRevista == $o->idSituacionRevista)
                                        <label for="SituacionDeRevista" id="SituacionDeRevista">{{$sr->Descripcion}}</label>
                                      @endif
                                    @endforeach
                                    
                                  </p>
                                  
                                  <p class="mb-0">Sala/Division/Año: 
                                      @foreach($Divisiones as $key => $d)
                                        @if ($d->idDivision == $o->idDivision)
                                          <label for="idDivision" id="idDivision">{{$d->Descripcion}} - {{$d->DescripcionTurno}}</label>
                                        @endif 
                                      @endforeach
                                      
                                   </p>
                                  <p class="mb-0">Horas: <label for="CantidadHoras" id="CantidadHoras">{{$o->CantidadHoras}}</label></p>
                                  <p class="mb-0">Fecha de Alta(Res): <label for="Fa" id="Fa">{{ \Carbon\Carbon::parse($o->FechaDeAlta)->format('d-m-Y')}}</label></p>
                                </div>
                                <div class="card-footer">
                                  {{-- <a type="button" href="#" class="btn mx-1" data-toggle="tooltip" data-placement="top" title="Licencia">
                                    <span class="material-symbols-outlined pt-1">medical_services</span>
                                  </a> --}}
                                  <a  href="{{route('ActualizarNodoAgente',$o->idNodo)}}" class="btn mx-1 "  data-placement="top" title="Agregar Docente"  >
                                    <span class="material-symbols-outlined pt-1" >edit_square</span>
                                  </a>
                                  <a type="button" href="#" class="btn mx-1" data-toggle="tooltip" data-placement="top" title="Licencia">
                                    <span class="material-symbols-outlined pt-1">medical_services</span>
                                  </a>
                                  
                                  <a href="#" class="btn mx-1">
                                    <span class="material-symbols-outlined pt-1" data-toggle="modal" data-placement="top" title="Traslado/Afectación">transfer_within_a_station</span>
                                  </a>
                                  <a href="{{route('agregaNodo',1)}}" class="btn mx-1">
                                    <span class="material-symbols-outlined pt-1" data-toggle="tooltip" data-placement="top" title="Vincular">compare_arrows</span>
                                  </a>
                                </div>
                              </div>
                            </div>
                            <!--Fin primera Card-->
                          </div>
                        </form>
                      </div>
                      @endforeach
                      {{-- Agente info Fin --}}
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_3">
                    opcion3
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- ./card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

            </section>
        </section>
    </section>
@endsection

@section('Script')
@section('Script')
    <script src="{{ asset('js/funcionesvarias.js') }}"></script>
   

     @if (session('ConfirmarNuevoAgenteNodo')=='OK')
        <script>
        Swal.fire(
            'Registro guardado',
            'Se creo un nuevo registro de un Agente',
            'success'
                )
        </script>
    @endif
    @if (session('ConfirmarNuevoNodo')=='OK')
        <script>
        Swal.fire(
            'Nodo Agregado',
            'Se creo un registro en Blanco, puede agregar los datos del Agente',
            'success'
                )
        </script>
    @endif
<script>

    $('.formularioNuevoAgenteNodo').submit(function(e){
      if($("#idAgente").val()=="" ||
        $("#CargoSal").val()=="" ||
        $("#idEspCur").val()=="" ||
        $("#cant_horas").val()==""){
        console.log("error")
         e.preventDefault();
          Swal.fire(
            'Error',
            'No se pudo agregar, hay datos incompletos',
            'error'
                )
      }else{
        e.preventDefault();
        Swal.fire({
            title: 'Esta seguro de querer agregar el Agente?',
            text: "Prueba por ahora",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, crear el registro!'
          }).then((result) => {
            if (result.isConfirmed) {
              this.submit();
            }
          })
      }
    })
    
    $('.ConfirmarAgregarAgenteANodo').submit(function(e){
        e.preventDefault();
        Swal.fire({
            title: 'Esta seguro de querer agregar el Agente?',
            text: "Prueba por ahora",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, crear el registro!'
          }).then((result) => {
            if (result.isConfirmed) {
              this.submit();
            }
          })
    })
</script>
@endsection


