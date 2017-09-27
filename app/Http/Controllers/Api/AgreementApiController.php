<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Agreement;
use App\Models\Patient;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class AgreementApiController extends Controller
{

    /**
     * Display DataTables result.
     *
     * @return Datatables
     */
    public function getAgreementsData()
    {
        $agreements = Agreement::all();

        return Datatables::of($agreements)
            ->addColumn("action", function ($agreement) {
                return '<a href="' . route("convenio.edit", $agreement->id) . '" 
                        class="btn bg-grey btn-xs waves-effect" title="Editar convênio"
                        data-toggle="tooltip" data-placement="top"> 
                            <i class="material-icons">edit</i>
                        </a>';
            })
            ->escapeColumns(false)
            ->make(true);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getPatientsByDocument(Request $request)
    {
        $patient = [];

        if ($request->document) {
            $document = mask("###.###.###-##", $request->document);
            $patient = Patient::where("document", $document)->first();
        }

        return $patient;
    }

}
