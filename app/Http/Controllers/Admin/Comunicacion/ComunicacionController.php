<?php

namespace App\Http\Controllers\Admin\Comunicacion;

use Alert;
use App\Http\Controllers\Controller;
use App\Mail\VariosEmail;
use App\Models\Postulante;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use infobip\api\client\SendSingleTextualSms;
use infobip\api\configuration\BasicAuthConfiguration;
use infobip\api\model\sms\mt\send\textual\SMSTextualRequest;
class ComunicacionController extends Controller
{
    public function index()
    {
    	return view('admin.comunicacion.index');
    }
    public function emails(Request $request)
    {
    	$postulante = Postulante::where('numero_identificacion',$request->input('dni'))->first();
    	if (isset($postulante)) {

    		$email['email'] = $postulante->email;
    		$email['destinatario'] = $postulante->nombre_completo;
    		$email['asunto'] = $request->input('asunto');
    		$email['mensaje'] = $request->input('mensaje');

    		Mail::to($email['email'])->queue(new VariosEmail($email));

    		Alert::success('Email enviado con exito');

    	}else Alert::warning('No se encontro postulante con ese DNI');
    	return back();
    }
    public function sms(Request $request)
    {
    	$celular = $request->get('celular');
    	$mensaje = $request->get('mensaje');

    	$client = new Client();
    	$url = 'http://mes.mowa.com.pe:8080/MES2App/sendSMS.jsp?mensaje='.$mensaje.'&numero='. $celular .'&usuario=uni';
    	$response = $client->request('GET', $url);

    	/*$auth = new BasicAuthConfiguration('AdmiUni','Q5ffTHdh');
    	$client = new SendSingleTextualSms($auth);
    	$requestBody = new SMSTextualRequest();
    	$requestBody->setFrom('051991801039');
		$requestBody->setTo('051991801039');
		$requestBody->setText("Esto es un mensaje");
		$response = $client->execute($requestBody);*/

    	Alert::success('Mensaje de texto enviado');
    	return back();
    }
}
