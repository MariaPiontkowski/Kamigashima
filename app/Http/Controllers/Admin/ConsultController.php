<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\Agenda;
use App\Models\Consult;
use App\Models\Patient;
use App\Models\PatientPhone;
use App\Models\PatientRecord;
use Illuminate\Http\Request;
use DB;
use Mail;

class ConsultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

//        Mail::to('maria.piontkowski@hotmail.com')->send(new Agenda());die;

        $date = $request->date ? $request->date : date('Y-m-d');

        $consults = DB::select('CALL sp_se_consults(?)', [$date]);
        $patient = Patient::select('name')->get()->toArray();

        return view("admin.consults.index", [
            "consults" => $consults,
            "date" => $date,
            "patient" => $patient
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($date, $hour)
    {
        return view("admin.consults.create", [
            "consult" => new Consult(),
            "date" => $date,
            "hour" => $hour,
            "patients" => Patient::all(),
            "action" => route("agenda.store", ['date' => $date, 'hour' => $hour]),
            "method" => "post"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return string $email
     */
    public function store(Request $request)
    {

        $id  = str_replace('-', '', $request->date);
        $id .= str_replace(':', '', $request->hour);
        $email = '';

        $patient = Patient::where('name', $request->name)->first();

        if($patient){
            $email = $patient->email;
            $phone = PatientPhone::where("patient_id", $patient->id)
                ->first();


            if(!($request->phone) && ($phone)){
                $request->phone = $phone->phone;
            }
            elseif(!($phone)&& ($request->phone)){
                    $patientphone = new PatientPhone();
                    $patientphone->patient_id = $patient->id;
                    $patientphone->phone = $request->phone;
                    $patientphone->type = 1;
                    $patientphone->save();
                }

        }

        $check = Consult::find($id);

        $consult = ($check) ? $check : new Consult();

        $consult->id = $id;
        $consult->date = $request->date;
        $consult->hour = $request->hour;
        $consult->patient = $request->name;
        $consult->phone = $request->phone;
        $consult->note =  $request->note;
        $consult->session = ($request->sess) ? ($request->sess) : 1;
        $consult->save();

        $return = array();

        $return[] = $email;
        $return[] = $consult;

        if(!isset($check) && $request->sess == 0){
            for($i = 1; $i < 10; $i++){

                $request->date = date('Y-m-d', strtotime($request->date . ' +7 day'));

                $id  = str_replace('-', '', $request->date);
                $id .= str_replace(':', '', $request->hour);

                $checkloop[$i] = Consult::find($id);

                if(!$checkloop[$i]){
                    $consultsession =  new Consult();

                    $consultsession->id = $id;
                    $consultsession->date = $request->date;
                    $consultsession->hour = $request->hour;
                    $consultsession->patient = $request->name;
                    $consultsession->phone = $request->phone;
                    $consultsession->note =  $request->note;
                    $consultsession->session = ($i+1);
                    $consultsession->save();

                    $return[] = $consultsession;

                }

            }
        }

        return $return;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit( $id ) {
        $consult = Consult::find( $id );
        return view( "admin.consults.edit", [
            "consult" => $consult,
            "hours" => DB::select('CALL sp_se_hour_available(?)', [$consult->date]),
            "action" => route( "agenda.update", $id ),
            "method" => "put"
        ] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, $id ) {

        $date = date('Y-m-d', strtotime(str_replace('/', '-', $request->date)));
        $newid = str_replace('-', '', $date).str_replace(':', '', $request->hour);

        $consult = Consult::find($id);
        $consult->id = $newid;
        $consult->date = $date;
        $consult->phone = $request->phone;
        $consult->hour = $request->hour;
        $consult->note = $request->note;
        $consult->session = $request->sess;
        $consult->save();

        return redirect()
            ->route("agenda.index", $date)
            ->with("success", "Consulta dia " . date('d/m/Y', strtotime($request->date)) . " às ". $request->hour. " remarcada com sucesso!");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param int $id
     *
     */
    public function destroy($id)
    {
        $consult = Consult::find($id);
        Consult::destroy($id);


        return redirect()
            ->route("agenda.index", date('Y-m-d', strtotime($consult->date)))
            ->with("success", 'Consulta dia ' . date('d/m/Y', strtotime($consult->date)) . ' às ' . $consult->hour . ' removida com sucesso!', $consult->date);

    }

    /**
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param int $id
     *
     */
    public function presence(Request $request, $id)
    {

        $consult = Consult::find($id);

        if($request->_method == $consult->presence){
            $presence = null;
            $op = " desfeita";
        }else{
            $presence = $request->_method;
            $op = " registrada";
        }
        $consult->presence = $presence;
        $consult->save();

        if($request->_method == 'FT'){
            $msg = 'Falta';
        }elseif($request->_method == 'NV'){
            $msg = 'Ausência';
        }elseif($request->_method == 'OK'){
            $msg = 'Presença';
        }

        if($request->page && $request->page == "paciente"){
            return redirect()
                ->route("agenda.paciente", $consult->patient)
                ->with("success", $msg. $op ." com sucesso!");
        }else{
            return redirect()
                ->route("agenda.index", date('Y-m-d', strtotime($consult->date)))
                ->with("success", $msg. $op ." com sucesso!");
        }

    }

    public function patient($name)
    {
        $consults = Consult::where('patient', $name)->get();

        $patient = Patient::where('name', $name)->first();

        $sessions = count($consults);
        $presence = 0;


        foreach ($consults as $consult){
            if($consult->presence == 'OK'){
                $presence = $presence+1;
            }
        }

        $remaining = $sessions - $presence;

        return view("admin.patient.consults", ['consults' => $consults  , 'patient' => $patient, 'name' => $name, 'remaining' => $remaining]);

    }

}
