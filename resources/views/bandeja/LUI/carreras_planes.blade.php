@extends('layout.app')

@section('Titulo', 'Sage2.0 - Movimientos')

@section('ContenidoPrincipal')
<section id="container" >
    <section id="main-content">
        <section class="wrapper">
            <!-- Inicio Selectores -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">
                        <i class="fas fa-book"></i>
                        Panel de Control - Carreras
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <form method="POST" action="{{ route('formularioCarreras') }}" class="formularioCarreras">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="Carreras">Carreras Disponibles</label>
                            <select class="form-control" name="Carreras" id="Carreras">
                            @foreach($CarrerasTodas as $key => $o)
                                <option value="{{$o->idCarrera}}">{{$o->Descripcion}} - {{$o->Titulo }}</option>
                            @endforeach
                            </select>
                        </div>  
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Agregar</button>
                        </div>
                    </div>
                    </form>
                    <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <!-- Inicio Tabla-Card -->
                    <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Lista de Carreras Activas</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Carrera</th>
                                <th>Duracion(Años)</th>
                                <th>Instrumento Legal</th>
                                <th>Fecha de Alta</th>
                                <th>Opcion</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($CarrerasRelSubOrg as $key => $o)
                                <tr class="gradeX">
                                    <td>{{$o->idCarrera_SubOrg}}</td>
                                    <td>
                                        {{$o->Descripcion}}<br>
                                        <span>Titulo: {{$o->Titulo}}</span>
                                    </td>
                                    <td>{{$o->Duracion}}</td>
                                    <td>{{$o->InstrumentoLegal}}</td>
                                    <td>{{$o->FechaAlta}}</td>
                                    <td>
                                        <a href="{{route('desvincularCarrera',$o->idCarrera_SubOrg)}}">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->

                <div class="col-md-6">
                    <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">
                        <i class="fas fa-book"></i>
                        Panel de Control - Planes
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <form method="POST" action="{{ route('formularioPlanes') }}" class="formularioPlanes">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="Carrera">Carreras Disponibles</label>
                            <select class="form-control" name="Carrera" id="Carrera">
                            @foreach($CarrerasRelSubOrg as $key => $o)
                                <option value="{{$o->idCarrera}}">{{$o->Descripcion}}</option>
                            @endforeach
                            </select>
                        </div> 
                        <div class="form-group">
                            <label for="Plan">Planes Disponibles</label>
                            <select class="form-control" name="Plan" id="Plan">
                            @foreach($PlanesDeEstudio as $key => $p)
                                <option value="{{$p->idPlanEstudio}}">{{$p->Descripcion}}</option>
                            @endforeach
                            </select>
                        </div> 
                        @if(count($CarrerasRelSubOrg)>0)
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Agregar</button>
                            </div>
                        @endif 
                        
                    </div>
                    </form>
                    <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <!-- Inicio Tabla-Card -->
                    <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Lista de Planes Activos</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="" class="table table-bordered table-striped">
                        <div class="card-body">
                        <table id="" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Descripcion del Plan</th>
                                <th>Fecha de Alta</th>
                                <th>Opcion</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($PlanesRelSubOrg as $key => $o)
                                <tr class="gradeX">
                                    <td>{{$o->PlanEstudio}}</td>
                                    <td>{{$o->Descripcion}}</td>
                                    <td>{{$o->FechaAlta}}</td>
                                    <td>
                                        <a href="{{route('desvincularPlan',$o->idRelSuborganizacionPlan)}}">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
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
        @if (session('ConfirmarActualizarCarrera')=='OK')
            <script>
            Swal.fire(
                'Registro guardado',
                'Se actualizo correctamente',
                'success'
                    )
            </script>
        @endif
    <script>

    $('.formularioCarreras').submit(function(e){
        e.preventDefault();
        Swal.fire({
            title: 'Esta seguro de querer agregar una carrera a su Institucion?',
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
        @if (session('ConfirmarEliminarCarrera')=='OK')
            <script>
            Swal.fire(
                'Registro guardado',
                'Se desvinculo correctamente',
                'success'
                    )
            </script>
        @endif
    <script src="{{ asset('js/funcionesvarias.js') }}"></script>
        @if (session('ConfirmarActualizarPlanes')=='OK')
            <script>
            Swal.fire(
                'Registro guardado',
                'Se actualizo correctamente',
                'success'
                    )
            </script>
        @endif
    <script>

    $('.formularioPlanes').submit(function(e){
        e.preventDefault();
        Swal.fire({
            title: 'Esta seguro de querer vincular un Plan de Estudio a la carrera Seleccionada??',
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


@endsection