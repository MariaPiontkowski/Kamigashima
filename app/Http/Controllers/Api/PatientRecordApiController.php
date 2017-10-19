<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Agreement;
use App\Models\Patient;
use App\Models\PatientRecord;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class PatientRecordApiController extends Controller
{

    /**
     * Display DataTables result.
     *
     * @return Datatables
     */
    public function getRecordsData()
    {
        $records = PatientRecord::all();

        return Datatables::of($records)
            ->addColumn("action", function ($record) {
                return '<a href="' . route("convenio.edit", $record->id) . '" 
                        class="btn bg-grey btn-xs waves-effect" title="Editar histórico"
                        data-toggle="tooltip" data-placement="top"> 
                            <i class="material-icons">edit</i>
                        </a>';
            })
            ->escapeColumns(false)
            ->make(true);
    }

}
