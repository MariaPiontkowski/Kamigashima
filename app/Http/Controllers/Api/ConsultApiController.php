<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Consult;
use Illuminate\Support\Collection;
use Yajra\Datatables\Datatables;

class ConsultApiController extends Controller
{

    /**
     * Display DataTables result.
     *
     * @return Datatables
     */
    public function getConsultsData()
    {

        $consults = Consult::all();
        $agenda = new Collection();

            $agenda->push(["id_agenda" => "", "patient_id" => "", "date" => "", "hour" => "08:00", "note" => ""]);
            $agenda->push(["id_agenda" => "", "patient_id" => "", "date" => "", "hour" => "08:20", "note" => ""]);
            $agenda->push(["id_agenda" => "", "patient_id" => "", "date" => "", "hour" => "08:40", "note" => ""]);
            $agenda->push(["id_agenda" => "", "patient_id" => "", "date" => "", "hour" => "09:00", "note" => ""]);
            $agenda->push(["id_agenda" => "", "patient_id" => "", "date" => "", "hour" => "09:20", "note" => ""]);
            $agenda->push(["id_agenda" => "", "patient_id" => "", "date" => "", "hour" => "09:40", "note" => ""]);
            $agenda->push(["id_agenda" => "", "patient_id" => "", "date" => "", "hour" => "10:00", "note" => ""]);
            $agenda->push(["id_agenda" => "", "patient_id" => "", "date" => "", "hour" => "10:20", "note" => ""]);
            $agenda->push(["id_agenda" => "", "patient_id" => "", "date" => "", "hour" => "10:40", "note" => ""]);
            $agenda->push(["id_agenda" => "", "patient_id" => "", "date" => "", "hour" => "11:00", "note" => ""]);
            $agenda->push(["id_agenda" => "", "patient_id" => "", "date" => "", "hour" => "11:20", "note" => ""]);
            $agenda->push(["id_agenda" => "", "patient_id" => "", "date" => "", "hour" => "11:40", "note" => ""]);
            $agenda->push(["id_agenda" => "", "patient_id" => "", "date" => "", "hour" => "13:00", "note" => ""]);
            $agenda->push(["id_agenda" => "", "patient_id" => "", "date" => "", "hour" => "13:20", "note" => ""]);
            $agenda->push(["id_agenda" => "", "patient_id" => "", "date" => "", "hour" => "13:40", "note" => ""]);
            $agenda->push(["id_agenda" => "", "patient_id" => "", "date" => "", "hour" => "13:00", "note" => ""]);
            $agenda->push(["id_agenda" => "", "patient_id" => "", "date" => "", "hour" => "13:20", "note" => ""]);
            $agenda->push(["id_agenda" => "", "patient_id" => "", "date" => "", "hour" => "13:40", "note" => ""]);
            $agenda->push(["id_agenda" => "", "patient_id" => "", "date" => "", "hour" => "14:00", "note" => ""]);
            $agenda->push(["id_agenda" => "", "patient_id" => "", "date" => "", "hour" => "14:20", "note" => ""]);
            $agenda->push(["id_agenda" => "", "patient_id" => "", "date" => "", "hour" => "14:40", "note" => ""]);
            $agenda->push(["id_agenda" => "", "patient_id" => "", "date" => "", "hour" => "15:00", "note" => ""]);
            $agenda->push(["id_agenda" => "", "patient_id" => "", "date" => "", "hour" => "15:20", "note" => ""]);
            $agenda->push(["id_agenda" => "", "patient_id" => "", "date" => "", "hour" => "15:40", "note" => ""]);
            $agenda->push(["id_agenda" => "", "patient_id" => "", "date" => "", "hour" => "16:00", "note" => ""]);
            $agenda->push(["id_agenda" => "", "patient_id" => "", "date" => "", "hour" => "16:20", "note" => ""]);
            $agenda->push(["id_agenda" => "", "patient_id" => "", "date" => "", "hour" => "16:40", "note" => ""]);
            $agenda->push(["id_agenda" => "", "patient_id" => "", "date" => "", "hour" => "17:00", "note" => ""]);
            $agenda->push(["id_agenda" => "", "patient_id" => "", "date" => "", "hour" => "17:20", "note" => ""]);
            $agenda->push(["id_agenda" => "", "patient_id" => "", "date" => "", "hour" => "17:40", "note" => ""]);


        for($j = 0; $j<count($consults); $j++){

            $hour = substr($consults[$j]['attributes']['hour'], 0, 5);

            foreach ($agenda->all() as $key => $val) {

                if ($val['hour'] == $hour) {
                    $agenda->all()[$key] = $consults[$j]["attributes"];


                }
            }
        }

        return Datatables::of($agenda)
             ->addColumn("action", function ($consult) {
                 return '<a href="' . route("agenda.edit", $consult->id) . '"
                         class="btn bg-blue btn-xs waves-effect" title="Editar Consulta"
                         data-toggle="tooltip" data-placement="top">
                             <i class="material-icons">edit</i>
                         </a>
                         <a href="#"
                         class="btn bg-red btn-xs waves-effect" title="Desmarcar Consulta"
                         data-toggle="tooltip" data-placement="top">
                             <i class="material-icons">clear</i>
                         </a>';
             })
            ->escapeColumns(false)
            ->make(true);


    }

}
