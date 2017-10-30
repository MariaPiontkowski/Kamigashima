<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Consult;
use Illuminate\Support\Collection;
use Yajra\Datatables\Datatables;
use DB;

class ConsultApiController extends Controller
{

    /**
     * Display DataTables result.
     *
     * @return Datatables
     */
    public function getConsultsData()
    {

        $consults = DB::select('CALL sp_se_consults(?)', ['2017-10-31']);

        return Datatables::of($consults)
             ->addColumn("action", function ($consult) {

                 if(!$consult->name){
                     return '<a href="#" class="btn bg-green btn-xs waves-effect" data-toggle="tooltip" data-placement="top" = title="Agendar Consulta">
                                <i class="material-icons">group_add</i>
                                <span class="i-span">Nova</span>
                            </a>';
                 }else{
                     return '<a href="' . route("agenda.edit", $consult->hour) . '" class="btn bg-blue btn-xs waves-effect" title="Editar Consulta"
                             data-toggle="tooltip" data-placement="top">
                                <i class="material-icons">edit</i>
                             </a>
                             
                             <a href="#" class="btn bg-red btn-xs waves-effect" title="Desmarcar Consulta"
                             data-toggle="tooltip" data-placement="top">
                                 <i class="material-icons">clear</i>
                             </a>';
                 }

             })
            ->escapeColumns(false)
            ->make(true);


    }

}
