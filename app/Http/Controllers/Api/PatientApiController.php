<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\PatientAddress;
use App\Models\PatientPhone;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class PatientApiController extends Controller
{

    /**
     * Display DataTables result.
     *
     * @return Datatables
     */
    public function getPatientsData()
    {
        $patients = Patient::select([
            "name",
            "id",
            "document",
            "updated_at"
        ]);

        return Datatables::of($patients)
            ->addColumn("status", function ($patient) {
                $status = "done_all";
                $class = "col-green";
                $title = "Paciente atualizado";

                if (!$patient->updated_at) {
                    $status = "warning";
                    $class = "col-yellow";
                    $title = "Paciente desatualizado";
                }

                if (!$patient->document) {
                    $status = "error";
                    $class = "col-red";
                    $title = "Paciente incompleto";
                }

                return '<i class="material-icons ' . $class . '" title="' . $title . '" 
                        data-toggle="tooltip" data-placement="top" 
                        style="cursor:default">' . $status . '</i>';
            })
            ->addColumn("action", function ($patient) {
                return '<a href="' . route("paciente.edit", $patient->id) . '" 
                        class="btn bg-blue-grey btn-xs btn-copy waves-effect" title="Detalhes Paciente"
                        data-toggle="tooltip" data-placement="top" 
                        data-clipboard-action="copy" data-clipboard-text="'.$patient->name.'"> 
                            <i class="material-icons">person</i>
                        </a>
                        <a href="' . route("paciente.prontuario.index", $patient->id) . '" 
                        class="btn bg-teal btn-xs btn-copy waves-effect" title="Prontuário"
                          data-toggle="tooltip" data-placement="top" 
                        data-clipboard-action="copy" data-clipboard-text="'.$patient->name.'"> 
                            <i class="material-icons">content_paste</i>
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
