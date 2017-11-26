<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Consult;
use App\Models\Patient;
use Illuminate\Http\Request;
use DB;

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

        $date = $request->date && $request->date !== '' ? $request->date : date('Y-m-d');

        $consults = DB::select('CALL sp_se_consults(?)', [$date]);

        return view("admin.consults.index", [
            "consults" => $consults,
            "date" => $date
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = str_replace('-', '', $request->date).str_replace(':', '', $request->hour);

        $check = Consult::find($id);

        $consult = ($check) ? $check : new Consult();

        $consult->id = $id;
        $consult->date = $request->date;
        $consult->hour = $request->hour;
        $consult->patient = $request->name;
        $consult->phone = $request->phone;
        $consult->note =  $request->note;
        $consult->save();

        return $consult;
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
            "date" => $consult->date,
            "hour" => substr($consult->hour, 0, 5),
            "hours" => DB::select('CALL sp_se_hour_available(?)', [$consult->date]),
            "patient" => Patient::find($consult->patient_id),
            "note" => $consult->note,
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
        $consult->hour = $request->hour;
        $consult->note = $request->note;
        $consult->save();


        return redirect()
            ->route("agenda.index")
            ->with("success", "Consulta dia " . $request->date . " às ". $request->hour. " remarcada com sucesso!");

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

}
