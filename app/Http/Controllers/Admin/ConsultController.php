<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Consult;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpParser\Node\Scalar\String_;

class ConsultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("admin.consults.index");
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
     * @param  String $date
     * @param  String $hour
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $date, $hour)
    {
        $consult = new Consult();
        $consult->date = $date;
        $consult->hour = $hour;
        $consult->patient_id = $request->patient;
        $consult->note = $request->note;
        $consult->save();

        return redirect()
            ->route("agenda.index")
            ->with("success", "Consulta dia " . date('d/m/Y', strtotime($date)) . " às ". $hour. " agendada com sucesso!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $date
     * @param $hour
     * @return \Illuminate\Http\Response
     * @internal param int $id
     *
     */
    public function destroy($date, $hour)
    {
        $consult = Consult::where([
            'date' => $date,
            'hour' => $hour
        ])->first();

        var_dump($date);
        var_dump($hour);
//
//        $consult->delete();
//
//        return redirect()
//            ->route("agenda.index")
//            ->with("success", 'Consulta dia ' . date('d/m/Y', strtotime($date)) . ' às ' . $hour . ' removida com sucesso!');
    }
}
