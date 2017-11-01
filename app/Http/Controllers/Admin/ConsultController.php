<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Consult;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
    public function create()
    {
        return view("admin.consults.create", [
            "cid" => new Cid(),
            "action" => route("cid.store"),
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

        $cid = new Cid();
        $cid->code = $request->code;
        $cid->description = $request->description;
        $cid->save();

        return redirect()
            ->route("cid.index")
            ->with("success", 'CID "' . $request->code . '" cadastrado com sucesso!');
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

        $consult->delete();

        return redirect()
            ->route("agenda.index")
            ->with("success", 'Consulta dia' . date('d/m/Y', strtotime($date)) . ' às ' . $hour . ' removida com sucesso!');
    }
}
