<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class ConsultApiController extends Controller
{

    /**
     * Display DataTables result.
     *
     * @param Request $request
     * @return Datatables
     */
    public function getConsultsData(Request $request)
    {
        $consults = DB::select('CALL sp_se_consults(?)', ['2017-10-31']);

        return Datatables::of($consults)
            ->addColumn("action", function ($consult) use ($request) {
                if (!$consult->name) {
                    return '<a href="#" class="btn bg-green btn-xs waves-effect" data-toggle="tooltip" data-placement="top"  title="Agendar Consulta">
                                <i class="material-icons">group_add</i>
                                <span class="i-span">Nova</span>
                            </a>';
                } else {
                    return '<form id="form-delete" action="' . route("agenda.destroy", ['date' => $consult->date, 'hour' => $consult->hour]) . '" method="post">
                                <button type="submit" class="btn bg-red btn-xs waves-effect dialog-btn" title="Desmarcar Consulta"
                             data-toggle="tooltip" data-placement="top" id="btn-delete" data-form="form-delete" data-type="confirm">
                                    <input type="hidden" name="_token" value="' . $request->_token . '">
                                    <input type="hidden" name="_method" value="delete">
                                 <i class="material-icons">clear</i>
                             </button>
                            </form>';
                }

            })
            ->escapeColumns(false)
            ->make(true);


    }
}
