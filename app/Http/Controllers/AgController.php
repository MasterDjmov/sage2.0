<?php

namespace App\Http\Controllers;

use App\Models\AsignaturaModel;
use App\Models\EspacioCurricularModel;
use App\Models\Nodo;
use Illuminate\Http\Request;
use App\Models\OrganizacionesModel;
use App\Models\PlazasModel;
use Illuminate\Support\Facades\DB;

class AgController extends Controller
{
    public function verArbolServicio(){

        //obtengo el usuario que es la escuela a trabajar
        $idReparticion = session('idReparticion');
        //consulto a reparticiones
        $reparticion = DB::table('tb_reparticiones')
        ->where('tb_reparticiones.idReparticion',$idReparticion)
        ->get();
        //dd($reparticion[0]->Organizacion);
        
        //traigo todo de suborganizacion pasada
        $subOrganizacion=DB::table('tb_suborganizaciones')
        ->where('tb_suborganizaciones.idsuborganizacion',$reparticion[0]->subOrganizacion)
        ->select('*')
        ->get();
        /*
            [
                {
                "org": 807
                }
            ]
                si lo llamo db:table me devuelve asi, leerlo como array primero objeto[0]->clave
        */
       
        //funcion previa, luego la desecho porque la idea es que use NODO en su lugar
        /*$suborganizaciones = DB::table('tb_suborganizaciones')
        ->where('tb_suborganizaciones.idSubOrganizacion',session('idSubOrg'))
        ->join('tb_plazas', 'tb_plazas.Suborganizacion', '=', 'tb_suborganizaciones.idSubOrganizacion')
        ->join('tb_agentes', 'tb_agentes.idAgente', '=', 'tb_plazas.DuenoActual')  
        ->join('tb_asignaturas', 'tb_asignaturas.idAsignatura', '=', 'tb_plazas.Asignatura')
        ->join('tb_situacionrevista', 'tb_situacionrevista.idSituacionRevista', '=', 'tb_plazas.SitRevDuenoActual')
        ->join('tb_espacioscurriculares', 'tb_espacioscurriculares.idEspacioCurricular', '=', 'tb_plazas.EspacioCurricular')
        ->select(
            'tb_suborganizaciones.*',
            'tb_plazas.*',
            'tb_agentes.*',
            'tb_asignaturas.Descripcion as DesAsc',
            'tb_situacionrevista.Descripcion as SR',
            'tb_espacioscurriculares.Horas as CargaHoraria',
        )
        ->orderBy('tb_agentes.idAgente','ASC')
        ->get();
*/
        //por ahora traigo las plazas de una determina SubOrganizacion
       /* $plazas = DB::table('tb_plazas')
        ->where('tb_plazas.SubOrganizacion',$idSubOrg)
        ->leftJoin('tb_agentes', 'tb_agentes.idAgente', '=', 'tb_plazas.DuenoActual')
        ->select(
            'tb_plazas.*',
            'tb_agentes.Nombres',
            'tb_agentes.Documento',

        )
        ->orderBy('tb_plazas.idPlaza','DESC')
        ->get();
*/
 /*       $turnos = DB::table('tb_turnos')->get();
        $regimen_laboral = DB::table('tb_regimenlaboral')->get();
        $fuentesDelFinanciamiento = DB::table('tb_fuentesdefinanciamiento')->get();
        $tiposDeFuncion = DB::table('tb_tiposdefuncion')->get();
        $Asignaturas = DB::table('tb_asignaturas')->get();
        $CargosSalariales = DB::table('tb_cargossalariales')->get();
        */
       /* $datos=array(
            'mensajeError'=>"",
            'idOrg'=>$organizacion[0]->Org,
            'NombreOrg'=>$organizacion[0]->Descripcion,
            'CueOrg'=>$organizacion[0]->CUE,
            'infoSubOrganizaciones'=>$suborganizaciones,
            'idSubOrg'=>$idSubOrg,  //la roto para pasarla a otras ventanas y saber donde volver
            'infoPlazas'=>$plazas,
            'CargosSalariales'=>$CargosSalariales,
            'Asignaturas'=>$Asignaturas,
            'tiposDeFuncion'=>$tiposDeFuncion,
        );
*/
        //traigo los nodos
        $infoNodos=DB::table('tb_nodos')
        ->join('tb_suborganizaciones', 'tb_suborganizaciones.CUE', '=', 'tb_nodos.CUE')
        ->leftjoin('tb_agentes', 'tb_agentes.idAgente', '=', 'tb_nodos.Agente')
        ->where('tb_suborganizaciones.idSubOrganizacion',$reparticion[0]->subOrganizacion)
        ->select('*')
        ->get();
        //dd($infoNodos);

        //traemos otros array
        $SituacionRevista = DB::table('tb_situacionrevista')->get();
        $CargosInicial=DB::table('tb_asignaturas')
        ->orWhere('Descripcion', 'like', '%Cargo -%')->get();
        
        $datos=array(
            'mensajeError'=>"",
            'CueOrg'=>$subOrganizacion[0]->cuecompleto,
            'nombreSubOrg'=>$subOrganizacion[0]->Descripcion,
            'infoSubOrganizaciones'=>$subOrganizacion,
            'idSubOrg'=>$reparticion[0]->subOrganizacion, 
            'infoNodos'=>$infoNodos,
            'CargosInicial'=>$CargosInicial,
            'SituacionDeRevista'=>$SituacionRevista
        );
        //lo guardo para controlar a las personas de una determinada cue/suborg
        session(['CUE'=>$subOrganizacion[0]->CUE]);
        session(['idSubOrg'=>$reparticion[0]->subOrganizacion]);
        //dd($plazas);
        return view('bandeja.AG.Servicios.arbol',$datos);
    }

    public function getAgentes($DNI){
        //traigo todos los agentes que coincidan con su DNI
        $Agentes = DB::table('tb_agentes')
        ->where('tb_agentes.Documento',$DNI)
        ->select(
            'tb_agentes.*',
        )
        ->orderBy('tb_agentes.idAgente','ASC')
        ->get();

       //print_r($Agentes);
        $respuesta="";
       
        foreach($Agentes as $a){
            $respuesta=$respuesta.'
            <tr class="gradeX">
                <td>'.$a->idAgente.'</td>
                <td>'.$a->Nombres.'<input type="hidden" id="nomAgenteModal'.$a->idAgente.'" value="'.$a->Nombres.'"</td>
                <td>'.$a->Documento.'</td>
                <td>
                    <input type="hidden" name="Agente" value="'.$a->idAgente.'">
                    <button type="button" name="btnAgregar" onclick="seleccionarAgentes('.$a->idAgente.')">Agregar Agente</button>
                </td>
            </tr>';
            
            
        }
        //<button type="submit" onclick="seleccionarAgente('.$a->idAgente.')">Agregar Agente</button>
        //echo $respuesta;
        return response()->json(array('status' => 200, 'msg' => $respuesta), 200);
    }

    public function getAgentesRel($DNI){
        //traigo todos los agentes que coincidan con su DNI
        $Agentes = DB::table('tb_agentes')
        ->where('tb_agentes.Documento',$DNI)
        ->select(
            'tb_agentes.*',
        )
        ->orderBy('tb_agentes.idAgente','ASC')
        ->get();

       //print_r($Agentes);
        $respuesta="";
       
        foreach($Agentes as $a){
            $respuesta=$respuesta.'
            <tr class="gradeX">
                <td>'.$a->idAgente.'</td>
                <td>'.$a->Nombres.'<input type="hidden" id="nomAgenteModal'.$a->idAgente.'" value="'.$a->Nombres.'"</td>
                <td>'.$a->Documento.'</td>
                <td>
                    <input type="hidden" name="Agente" value="'.$a->idAgente.'">
                    <button type="submit" name="btnAgregar">Agregar Agente</button>
                </td>
            </tr>';
            
            
        }
        //<button type="submit" onclick="seleccionarAgente('.$a->idAgente.')">Agregar Agente</button>
        //echo $respuesta;
        return response()->json(array('status' => 200, 'msg' => $respuesta), 200);
    }
    
    public function agregarAgenteEscuela(Request $request){
        echo $request->Agente." ".session('CUE') ;
        $nodo = new Nodo;
        $nodo->Agente = $request->input('Agente');
        $nodo->Usuario = session('idUsuario');
        $nodo->CUE = session('CUE');
        $nodo->save();
        
        return redirect()->back()->with('ConfirmarNuevoAgente','OK');
        
    }

    public function getBuscarAgente($DNI){
        //traigo todos los agentes que coincidan con su DNI
        $Agentes = DB::table('tb_agentes')
        ->where('tb_agentes.Documento',$DNI)
        ->select(
            'tb_agentes.*',
        )
        ->orderBy('tb_agentes.idAgente','ASC')
        ->get();
        if($Agentes->count()>0)
        {
            $respuesta=true;
        }else{
            $respuesta=false;
        }
        return response()->json(array('status' => 200, 'msg' => $respuesta), 200);
    }

    public function getLocalidades($localidad){
        //traigo las relaciones Suborg->planes->carrera
        $Localidades = DB::table('tb_localidades')
        ->leftjoin('tb_provincias', 'tb_provincias.idProvincia', '=', 'tb_localidades.IdProvincia')
        ->orWhere('localidad', 'like', '%' . $localidad . '%')->get();

       //dd($Divisiones);
        $respuesta="";
       
        foreach($Localidades as $obj){
            $respuesta=$respuesta.'
            <tr class="gradeX">
                <td>'.$obj->idLocalidad.'</td>
                <td>'.$obj->localidad.'<input type="hidden" id="nomLocalidadModal'.$obj->idLocalidad.'" value="'.$obj->localidad.'"</td>
                <td>'.$obj->nombre.'</td>
                <td>
                    <button type="button" onclick="seleccionarLocalidad('.$obj->idLocalidad.')">Seleccionar</button>
                </td>
            </tr>';
            
            
        }
       
        return response()->json(array('status' => 200, 'msg' => $respuesta), 200);
    }

    public function getDepartamentos($departamento){
        //traigo las relaciones Suborg->planes->carrera
        //por alguna razon esta ligado y cargo en localiddes los dpto

        $Departamentos = DB::table('tb_localidades')
        //->join('tb_provincias', 'tb_provincias.idProvincia', '=', 'tb_departamentos.Provincia')
        ->orWhere('localidad', 'like', '%' . $departamento . '%')
    
        ->get();

       //dd($Divisiones);
        $respuesta="";
       
        foreach($Departamentos as $obj){
            $respuesta=$respuesta.'
            <tr class="gradeX">
                <td>'.$obj->idLocalidad.'</td>
                <td>'.$obj->localidad.'<input type="hidden" id="nomDepartamentoModal'.$obj->idLocalidad.'" value="'.$obj->localidad.'"</td>
                <td>
                    <button type="button" onclick="seleccionarDepartamento('.$obj->idLocalidad.')">Seleccionar</button>
                </td>
                
            </tr>';
            
            
        }
       
        return response()->json(array('status' => 200, 'msg' => $respuesta), 200);
    }


    public function agregaNodo($nodoActual){
        //creo el nodo siguiente
        $Nuevo = new Nodo;
        $Nuevo->Agente = null;
        $Nuevo->Usuario = session('idUsuario');
        $Nuevo->CUE = session('CUE');
        $Nuevo->PosicionAnterior = $nodoActual;
        $Nuevo->save();

        //obtengo el id y lo guardo relacionando al anterior que recibo por parametro
        $Nuevo->idNodo;
        $nodo = Nodo::where('idNodo', $nodoActual)->first();
        $nodo->PosicionSiguiente = $Nuevo->idNodo;
        $nodo->save();

        return redirect()->back()->with('ConfirmarNuevoNodo','OK');
    }

    public function agregarDatoANodo(Request $request){
        //actualizar el nodo creado vacio por el dato del interino, titular, etc
        $nodo = Nodo::where('idNodo', $request->input('idNodo'))->first();
        $nodo->Agente = $request->input('idAgente');
        $nodo->save();
        
        return redirect()->back()->with('ConfirmarNuevoNodo','OK');
    }

    public function getInfoNodo($nodo){
                //traigo los nodos
                $infoNodos=DB::table('tb_nodos')
                ->leftjoin('tb_agentes', 'tb_agentes.idAgente', '=', 'tb_nodos.Agente')
                ->where('tb_nodos.idNodo',$nodo)
                ->select('*')
                ->get();
                //dd($infoNodos);
        
                //traemos otros array
                $datos=array(
                    'mensajeError'=>"",
                    'infoNodoSiguiente'=>$infoNodos,
                );
                //lo guardo para controlar a las personas de una determinada cue/suborg

                //dd($plazas);
                return view('bandeja.AG.Servicios.arbol',$datos);
    }




}
