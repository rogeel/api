<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\RetosRepository;
use App\Repositories\EquiposRepository;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Libraries\Helper\ResponseMessage as ResponseMessage;

class RetosController extends Controller
{
    //

    protected $repository;


    public function __construct(RetosRepository $retosRepository, EquiposRepository $equiposRepository){
      $this->repository = $retosRepository;
      $this->equiposRepository = $equiposRepository;
      
    }


    /**
     * Show all addresses
     * @return array
     */
    public function index()
    {
       return response()->json($this->repository->all()); 
    }

    /**
     * Saves a address into the database
     * @return void
     */
    public function store( Request $request) {
      $retoData =  $request->all();
      try{
        
        //if(empty($_POST['mensaje'])) array_push($error,"Ingrese un mensaje.");
        if(!checkdate($retoData['mes'],$retoData['dia'],$retoData['ano'])){
          return ResponseMessage::dateNotValid();
        } 
        if($retoData['ano']."-".$retoData['mes']."-".$retoData['dia']==date("Y-m-d") && $retoData['hora']<=date("H")){
          return ResponseMessage::hourNotValid();
        } 
        if($retoData['ano']."-".$retoData['mes']."-".$retoData['dia']<date("Y-m-d")){
          return ResponseMessage::dateNotValid();
        }

        $equipo= $this->equiposRepository->find($retoData['id_equipo']);
        $retador=$this->equiposRepository->find($retoData['id_retador']);
            
        $tienePartidos=DB::table("partidos_equipos")
        ->join("partidos","partidos_equipos.id_partido","=","partidos.id_partido")
        ->where("id_equipo","=",$retoData['id_equipo'])
        ->where("fecha","=",$retoData['ano']."-".$retoData['mes']."-".$retoData['dia'])
        ->where("horario","=",$retoData['hora'].":".$retoData['minutos'].":00")
        ->count();
        
        if($tienePartidos>0){
          return ResponseMessage::teamNotAvailable($equipo["data"]["equipo"]);
        }
          
        
        $tengoPartidos=DB::table("partidos_equipos")
        ->join("partidos","partidos_equipos.id_partido","=","partidos.id_partido")
        ->where("id_equipo","=",$retador->id_equipo)
        ->where("fecha","=",$retoData['ano']."-".$retoData['mes']."-".$retoData['dia'])
        ->where("horario","=",$retoData['hora'].":".$retoData['minutos'].":00")
        ->count();
        
        if($tengoPartidos>0){
          return ResponseMessage::notAvailable();

        }

        \JWTAuth::parseToken();
        $user = \JWTAuth::parseToken()->authenticate(); 
        
        
            
            //consultar capita  n del equipo retado
          $capitanretado=DB::table('jugadores_equipos')
          ->wherein("capitan",array("t","s"))
          ->where("id_equipo","=",$retoData['id_equipo'])
          ->join("jugadores","jugadores.id_jugador","=","jugadores_equipos.id_jugador")
          ->get();

          $fechaReto=$retoData['ano']."-".$retoData['mes']."-".$retoData['dia'];
          $horaReto=$retoData['hora'].":".$retoData['minutos'].":00";


          $arrayReto = array('id_equipo' => $equipo["data"]["id"],'id_retador' => $retador["data"]["id"], 'mensaje' => $retoData['mensaje'], 'tipo' => $retoData['tipo'], 'fecha' => $fechaReto, 'hora'=> $horaReto, 'lugar'=> $retoData['lugar']);

          $reto = $this->repository-create($arrayReto);
          /*foreach($capitanretado as $destinatario){
              $datos['destinatario']=$destinatario;
              $datos['equipo']=$equipo;
              $datos['retador']=$retador;
              $datos['reto']=$reto;
              $datos['cadena']=base64_encode("aceptarreto||".$equipo->id_equipo."||".$retador->id_equipo."||".$destinatario->id_jugador."||".$reto->id_reto);
              if($_POST['tipo']=='a') $datos['tipo']="Amistoso"; else $datos['tipo']="Competitivo"; 
              $datos['mensaje']=$_POST['mensaje'];
              Mail::send('mails.reto', $datos, function($message) use ($destinatario) {
                  $message->to($destinatario->email)->subject('Tu equipo ha sido retado');
              });
              $alerta=new Alerta();
              $alerta->id_jugador=$destinatario->id_jugador;
              $alerta->estado="a";
              $alerta->id_tipo_alerta=2;
              $alerta->id_referencia=$reto->id_reto;
              $alerta->save();
              $alerta->alerta='<div onclick="window.open(\''.url().'/equipos/perfil?id_equipo='.$retador->id_equipo.'\')" class="orange">'.strtoupper($retador->equipo).'</div><span class="message" > quiere enfrentar a tu equipo '.strtoupper($equipo->equipo).' el d&iacute;a '.$reto->fecha.' a las '.date("H:i",strtotime($reto->fecha." ".$reto->hora)).'</span><br><input name="button" type="button" class="send4" onclick="responderAlerta('.$alerta->id_alerta.','.$reto->id_reto.',\'t\')" style="height: 30" id="button" value=" ACEPTAR "><input name="button" type="button" class="send3" style="height: 30" id="button" onclick="responderAlerta('.$alerta->id_alerta.','.$reto->id_reto.',\'f\')" value=" RECHAZAR ">';
              $alerta->save();
          }  
          //Realizar reserva si viene
          if(isset($_POST['id_campo'])){
              $campo=Campo::where("id_campo","=",$_REQUEST['id_campo'])
              ->join("canchas","campos.id_cancha","=","canchas.id_cancha")
              ->first();
              $fechado=explode("-",$reto->fecha);
              $traddia['1']="Lunes";
              $traddia['2']="Martes";
              $traddia['3']="Miercoles";
              $traddia['4']="Jueves";
              $traddia['5']="Viernes";
              $traddia['6']="Sabado";
              $traddia['7']="Domingo";
              $tradMes['01']="Enero";
              $tradMes['02']="Febrero";
              $tradMes['03']="Marzo";
              $tradMes['04']="Abril";
              $tradMes['05']="Mayo";
              $tradMes['06']="Junio";
              $tradMes['07']="Julio";
              $tradMes['08']="Agosto";
              $tradMes['09']="Septiembre";
              $tradMes['10']="Octubre";
              $tradMes['11']="Noviembre";
              $tradMes['12']="Diciembre";
              $fechaformat=strtr(date("N",strtotime($reto->fecha)),$traddia).", ".$fechado[2]." de ".strtr($fechado[1],$tradMes)." de ".$fechado[0];
                          
              $reserva=new Reserva();
              $reserva->id_cancha=$campo->id_cancha;
              $reserva->fecha=$reto->fecha;
              $reserva->hora=$_REQUEST['horareserva'].":00:00";
              $reserva->id_jugador=$usuario->id_jugador;
              $reserva->id_campo=$campo->id_campo;
              $reserva->total_horas=$_REQUEST['horas'];
              $reserva->save();
              
              $datos['campo']=$campo;
              $datos['fechaformat']=$fechaformat;
              $datos['hora']=$_REQUEST['horareserva'].":00 a ".($_REQUEST['horareserva']+$_REQUEST['horas']).":00";
              $datos['cadena']=base64_encode("cancelarReserva||".$campo->id_campo."||".$reto->fecha."||".$_REQUEST['horareserva']);
              Mail::send('mails.reserva', $datos, function($message) use ($usuario){
                  $message->to($usuario->email, $usuario->nombres)->subject('Confirmacion de reserva');
              }); 
          }*/ 

      }catch (\Exception $e) {
        if ($e instanceof ValidatorException) {
          return response()->json($e->toArray(), 400);

        } else {
   
          return response()->json($e->getMessage(), 500);

        }
      }
      
         
      

        
    }

    /**
     * Show a record by id
     * @return array
     */
    public function show($id){


    }

    /**
     * Update a address by id
     * @return array
     */
    public function update(Request $request, $id){
  
      
    }

    /**
     * Delete a record by id
     * @return array
     */
    public function destroy($id){

    }

     

    
}
