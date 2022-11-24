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
                <h3 class="card-title p-3">Panel de Control POF</h3>
                <ul class="nav nav-pills ml-auto p-2">
                  <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Agregar Agente</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Ver Agentes</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">Extras</a></li>
                  
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                    
                    <h3>Configurar Nuevo Agente:</h3>
                        <div class="container mt-3 d-block">
                        <form method="POST" action="{{ route('agregaragenteaesuela') }}" class="formularioCarreras">
                            @csrf
                          <div class="row">
                            <!--primera Card-->
                            <div class="ml-1">
                              <div class="card shadow-lg bg-suplente">
                                <div class="card-title mt-4 d-flex justify-content-center">
                                  <h5 id="DescripcionNombreAgente" class="mb-0">Docente: </h5>
                                  <input type="hidden" name="idAgente" id="idAgente" value="">
                                </div>
                                <div class="card-body">
                                  <p class="mb-0">Cargo: 
                                    <select name="Asignatura">
                                    @foreach ($CargosInicial as $c)
                                      <option value='{{$c->idAsignatura}}'>{{$c->Descripcion}}</option>
                                    @endforeach
                                    </select>
                                  </p>
                                  <p class="mb-0">Sit.Rev:
                                  <select name="SituacionDeRevista" id="SituacionDeRevista" onchange="controlarCambio()">
                                    @foreach ($SituacionDeRevista as $sr)
                                      <option value='{{$sr->idSituacionRevista}}'>{{$sr->Descripcion}}</option>
                                    @endforeach
                                    </select>
                                  </p>
                                  <p class="mb-0">Licencia: XXXX</p>
                                  <p class="mb-0">Division/Año: 
                                  <select name="Curso">
                                    <option value="">1</option>
                                    <option value="">2</option>
                                    <option value="">3...</option>
                                  <select>
                                   - 
                                   <select name="Division">
                                    <option value="">1</option>
                                    <option value="">A</option>
                                    <option value="">I...</option>
                                  <select>
                                   </p>
                                  <p class="mb-0">Horas: <input type="number" name="cant_horas" style="width:50px" value="{{rand(1,40)}}"></p>
                                </div>
                                <div class="card-footer">
                                  <a type="button" href="#" class="btn mx-1" data-toggle="tooltip" data-placement="top" title="Licencia">
                                    <span class="material-symbols-outlined pt-1">medical_services</span>
                                  </a>
                                  <a  href="#modalAgente" class="btn mx-1 " data-toggle="modal" data-placement="top" title="Agregar Docente"  data-target="#modalAgente">
                                    <span class="material-symbols-outlined pt-1" >group_add</span>
                                  </a>
                                  <a href="#" class="btn mx-1">
                                    <span class="material-symbols-outlined pt-1" data-toggle="modal" data-placement="top" title="Traslado/Afectación">transfer_within_a_station</span>
                                  </a>
                                  <a href="#" class="btn mx-1">
                                    <span class="material-symbols-outlined pt-1" data-toggle="tooltip" data-placement="top" title="Confirmar">done</span>
                                  </a>
                                  <a href="{{route('agregaNodo',1)}}" class="btn mx-1">
                                    <span class="material-symbols-outlined pt-1" data-toggle="tooltip" data-placement="top" title="Vincular">compare_arrows</span>
                                  </a>
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
                                  <h5 class="mb-0">Docente: </h5>
                                </div>
                                <div class="card-body">
                                  <p class="mb-0">Cargo: 
                                    <select name="Asignatura">
                                    @foreach ($CargosInicial as $c)
                                      <option value='{{$c->idAsignatura}}'>{{$c->Descripcion}}</option>
                                    @endforeach
                                    </select>
                                  </p>
                                  <p class="mb-0">Sit.Rev:
                                  <select name="SituacionDeRevista">
                                    @foreach ($SituacionDeRevista as $sr)
                                      <option value='{{$sr->idSituacionRevista}}'>{{$sr->Descripcion}}</option>
                                    @endforeach
                                    </select>
                                  </p>
                                  <p class="mb-0">Licencia: XXXX</p>
                                  <p class="mb-0">Division/Año: 
                                  <select name="Curso">
                                    <option value="">1</option>
                                    <option value="">2</option>
                                    <option value="">3...</option>
                                  <select>
                                   - 
                                   <select name="Division">
                                    <option value="">1</option>
                                    <option value="">A</option>
                                    <option value="">I...</option>
                                  <select>
                                   </p>
                                  <p class="mb-0">Horas: <input type="number" name="cant_horas" style="width:50px" value="{{rand(1,40)}}"></p>
                                </div>
                                <div class="card-footer">
                                  <a type="button" href="#" class="btn mx-1" data-toggle="tooltip" data-placement="top" title="Licencia">
                                    <span class="material-symbols-outlined pt-1">medical_services</span>
                                  </a>
                                  <a href="#" class="btn mx-1 " data-toggle="tooltip" data-placement="top" title="Agregar Docente">
                                    <span class="material-symbols-outlined pt-1" >group_add</span>
                                  </a>
                                  <a href="#" class="btn mx-1">
                                    <span class="material-symbols-outlined pt-1" data-toggle="tooltip" data-placement="top" title="Traslado/Afectación">transfer_within_a_station</span>
                                  </a>
                                  <a href="#" class="btn mx-1">
                                    <span class="material-symbols-outlined pt-1" data-toggle="tooltip" data-placement="top" title="Confirmar">done</span>
                                  </a>
                                  <a href="{{route('agregaNodo',1)}}" class="btn mx-1">
                                    <span class="material-symbols-outlined pt-1" data-toggle="tooltip" data-placement="top" title="Vincular">compare_arrows</span>
                                  </a>
                                </div>
                              </div>
                            </div>
                            <!--Fin segunda Card-->
                          </div>
                        <form>
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
                          <div class="row">
                            <!--primera Card-->
                            <div class="ml-1">
                              <div class="card shadow-lg bg-suplente">
                                <div class="card-title mt-4 d-flex justify-content-center">
                                  <h5 class="mb-0">({{$o->idNodo}})-Docente: {{strtoupper($o->Nombres)}}</h5>
                                </div>
                                <div class="card-body">
                                  <p class="mb-0">Cargo: 
                                    <select name="Asignatura">
                                    @foreach ($CargosInicial as $c)
                                      <option value='{{$c->idAsignatura}}'>{{$c->Descripcion}}</option>
                                    @endforeach
                                    </select>
                                  </p>
                                  <p class="mb-0">Sit.Rev:
                                  <select name="SituacionDeRevista">
                                    @foreach ($SituacionDeRevista as $sr)
                                      <option value='{{$sr->idSituacionRevista}}'>{{$sr->Descripcion}}</option>
                                    @endforeach
                                    </select>
                                  </p>
                                  <p class="mb-0">Licencia: XXXX</p>
                                  <p class="mb-0">Division/Año: 
                                  <select name="Curso">
                                    <option value="">1</option>
                                    <option value="">2</option>
                                    <option value="">3...</option>
                                  <select>
                                   - 
                                   <select name="Division">
                                    <option value="">1</option>
                                    <option value="">A</option>
                                    <option value="">I...</option>
                                  <select>
                                   </p>
                                  <p class="mb-0">Horas: <input type="number" name="cant_horas" style="width:50px" value="{{rand(1,40)}}"></p>
                                </div>
                                <div class="card-footer">
                                  <a type="button" href="#" class="btn mx-1" data-toggle="tooltip" data-placement="top" title="Licencia">
                                    <span class="material-symbols-outlined pt-1">medical_services</span>
                                  </a>
                                  <a href="#" class="btn mx-1 " data-toggle="tooltip" data-placement="top" title="Agregar Docente">
                                    <span class="material-symbols-outlined pt-1" >group_add</span>
                                  </a>
                                  <a href="#" class="btn mx-1">
                                    <span class="material-symbols-outlined pt-1" data-toggle="tooltip" data-placement="top" title="Traslado/Afectación">transfer_within_a_station</span>
                                  </a>
                                  <a href="#" class="btn mx-1">
                                    <span class="material-symbols-outlined pt-1" data-toggle="tooltip" data-placement="top" title="Confirmar">done</span>
                                  </a>
                                  <a href="{{route('agregaNodo',$o->idNodo)}}" class="btn mx-1">
                                    <span class="material-symbols-outlined pt-1" data-toggle="tooltip" data-placement="top" title="Vincular">compare_arrows</span>
                                  </a>
                                </div>
                              </div>
                            </div>
                            <!--Fin primera Card-->
                            <!--Flechita-->
                            @if($o->PosicionSiguiente != "")
                            @php
                              //traigo los nodos
                              $infoNodoSiguiente=DB::table('tb_nodos')
                              ->leftjoin('tb_agentes', 'tb_agentes.idAgente', '=', 'tb_nodos.Agente')
                              ->where('tb_nodos.idNodo',$o->PosicionSiguiente)
                              ->select('*')
                              ->get();
                            @endphp
                            <div class="d-flex align-self-center ml-2 mb-4">
                              <div class="align-items-center st0"></div>
                              <div class="align-items-center st2"></div>
                            </div>

                            <!--segunda Card-->
                            @foreach ($infoNodoSiguiente as $sig)
                              <div class="ml-1">
                                <div class="card shadow-lg bg-suplente">
                                  <div class="card-title mt-4 d-flex justify-content-center">
                                    <h5 class="mb-0">({{$sig->idNodo}})-Docente: {{strtoupper($sig->Nombres)}}</h5>
                                  </div>
                                  <div class="card-body">
                                    <p class="mb-0">Cargo: 
                                      <select name="Asignatura">
                                      @foreach ($CargosInicial as $c)
                                        <option value='{{$c->idAsignatura}}'>{{$c->Descripcion}}</option>
                                      @endforeach
                                      </select>
                                    </p>
                                    <p class="mb-0">Sit.Rev:
                                    <select name="SituacionDeRevista">
                                      @foreach ($SituacionDeRevista as $sr)
                                        <option value='{{$sr->idSituacionRevista}}'>{{$sr->Descripcion}}</option>
                                      @endforeach
                                      </select>
                                    </p>
                                    <p class="mb-0">Licencia: XXXX</p>
                                    <p class="mb-0">Division/Año: 
                                    <select name="Curso">
                                      <option value="">1</option>
                                      <option value="">2</option>
                                      <option value="">3...</option>
                                    <select>
                                    - 
                                    <select name="Division">
                                      <option value="">1</option>
                                      <option value="">A</option>
                                      <option value="">I...</option>
                                    <select>
                                    </p>
                                    <p class="mb-0">Horas: <input type="number" name="cant_horas" style="width:50px" value="{{rand(1,40)}}"></p>
                                  </div>
                                  <div class="card-footer">
                                  <a type="button" href="#" class="btn mx-1" data-toggle="tooltip" data-placement="top" title="Retornar">
                                      <span class="material-symbols-outlined pt-1">swipe_left</span>
                                    </a>
                                    <a type="button" href="#" class="btn mx-1" data-toggle="tooltip" data-placement="top" title="Licencia">
                                      <span class="material-symbols-outlined pt-1">medical_services</span>
                                    </a>
                                    <a href="#" class="btn mx-1 " data-toggle="tooltip" data-placement="top" title="Agregar Docente">
                                      <form action="/agregarDatoANodo" method="POST" class="ConfirmarAgregarAgenteANodo">
                                        @csrf
                                        <input type="hidden" name="idNodo" value="{{$sig->idNodo}}">
                                        <input type="text" name="idAgente" style="width:100px">
                                        <button type="submit" class="btn btn-success">+</button>
                                      </form>
                                      <span class="material-symbols-outlined pt-1" >group_add</span>
                                    </a>
                                    <a href="#" class="btn mx-1">
                                      <span class="material-symbols-outlined pt-1" data-toggle="tooltip" data-placement="top" title="Traslado/Afectación">transfer_within_a_station</span>
                                    </a>
                                    <a href="#" class="btn mx-1">
                                      <span class="material-symbols-outlined pt-1" data-toggle="tooltip" data-placement="top" title="Confirmar">done</span>
                                    </a>
                                    <a href="{{route('agregaNodo',$sig->idNodo)}}" class="btn mx-1">
                                      <span class="material-symbols-outlined pt-1" data-toggle="tooltip" data-placement="top" title="Vincular">compare_arrows</span>
                                    </a>
                                  </div>
                                  
                                  
                                </div>
                              </div>
                            @endforeach
                            <!--Fin segunda Card-->
                            @endif
                          </div>
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
   

     @if (session('ConfirmarNuevoAgente')=='OK')
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

    $('.formularioNuevoAgente').submit(function(e){
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


