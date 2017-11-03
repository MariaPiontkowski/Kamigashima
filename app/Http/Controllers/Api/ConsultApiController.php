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
        $date = isset($request->date) ? $request->date : date('Y-m-d');

        $consults = DB::select('CALL sp_se_consults(?)', [$date]);

        return Datatables::of($consults)
            ->addColumn("action", function ($consult) use ($request) {
                if (!$consult->name) {
                    return '<a href="' . route("agenda.create",  ['date' => $consult->date, 'hour' => $consult->hour]) . '" class="btn bg-green btn-xs waves-effect" data-toggle="tooltip" data-placement="top"  title="Agendar Consulta">
                                <i class="material-icons">group_add</i>
                            </a>';
                } else {
                    return '<form id="form-delete' . $consult->id . '" method="post"  
                        action="' . e(route("agenda.destroy", $consult->id)) . '">
                                <button type="submit" class="btn bg-red btn-xs waves-effect" title="Desmarcar Consulta"
                                data-toggle="tooltip" data-placement="top" id="btn-delete"
                                data-form="form-delete' . $consult->id . '" data-hour="' . $consult->hour . '">
                                    <input type="hidden" name="_token" value="' . $request->_token . '">
                                    <input type="hidden" name="_method" value="delete">
                                 <i class="material-icons">event_busy</i>
                             </button>
                            </form>';
                }

            })
            ->escapeColumns(false)
            ->make(true);


    }
}
