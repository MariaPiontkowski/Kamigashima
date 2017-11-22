<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cid;
use App\Models\Patient;
use App\Models\PatientRecord;
use Illuminate\Http\Request;

class PatientRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param $paciente
     *
     * @return \Illuminate\Http\Response
     */
    public function index($paciente)
    {
        return view("admin.records.index", [
            "patient" => Patient::find($paciente)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $paciente
     *
     * @return \Illuminate\Http\Response
     */
    public function create($paciente)
    {

        $date = new \DateTime();

        $firstrecord = PatientRecord::where('patient_id', $paciente)->orderBy('created_at', 'ASC')->first();

        $prevrecord = PatientRecord::where('patient_id', $paciente)->where('created_at', '<', $date)
            ->orderBy('created_at', 'DESC')->first();

        return view("admin.records.create", [
            "patient" => Patient::find($paciente),
            "record" => new PatientRecord(),
            "firstrecord" => $firstrecord,
            "prevrecord" => $prevrecord,
            "action" => route("paciente.prontuario.store", $paciente),
            "method" => "post"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @param $paciente
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $paciente)
    {
        $this->saveHistoric(new PatientRecord(), $paciente, $request);

        return redirect()
            ->route("paciente.prontuario.index", $paciente)
            ->with("success", 'Histórico cadastrado com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $paciente
     * @param $prontuario
     *
     * @return \Illuminate\Http\Response
     * @internal param int $id
     *
     */
    public function edit($paciente, $prontuario)
    {

        $record = PatientRecord::find($prontuario);

        $firstrecord = PatientRecord::where('patient_id', $record['patient_id'])->orderBy('created_at', 'ASC')->first();

        $prevrecord = PatientRecord::where('patient_id', $record['patient_id'])->where('created_at', '<', $record['created_at'])
            ->orderBy('created_at', 'DESC')->first();

        $nextrecord = PatientRecord::where('patient_id', $record['patient_id'])->where('created_at', '>', $record['created_at'])
            ->orderBy('created_at', 'ASC')->first();

        $lastrecord = PatientRecord::where('patient_id', $record['patient_id'])->orderBy('created_at', 'DESC')->first();

        return view("admin.records.edit", [
            "patient" => Patient::find($paciente),
            "record" => $record,
            "firstrecord" => $firstrecord,
            "prevrecord" => $prevrecord,
            "nextrecord" => $nextrecord,
            "lastrecord" => $lastrecord,
            "action" => route("paciente.prontuario.update", [
                "paciente" => $paciente,
                "prontuario" => $prontuario
            ]),
            "method" => "put"
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param $paciente
     * @param $prontuario
     *
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(Request $request, $paciente, $prontuario)
    {
        $this->saveHistoric(PatientRecord::find($prontuario), $paciente, $request);

        return redirect()
            ->route("paciente.prontuario.index", $paciente)
            ->with("success", 'Histório "' . $request->code . '" alterado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $paciente
     * @param $prontuario
     *
     * @return \Illuminate\Http\Response
     * @internal param int $id
     *
     */
    public function destroy($paciente, $prontuario)
    {
        $patient = Patient::find($paciente);
        PatientRecord::destroy($prontuario);

        return redirect()
            ->route("records.index")
            ->with("success", 'Histórico de "' . $patient->name . '" removido com sucesso!');
    }
    /**
     * Clone a newly created resource in storage.
     *
     * @param $paciente
     *
     * @param $prontuario
     *
     * @return \Illuminate\Http\Response
     */
    public function twin($paciente, $prontuario)
    {
        $recordClone = PatientRecord::find($prontuario);

        $record = new PatientRecord();

        $record->patient_id = $paciente;
        $record->historic = $recordClone->historic;
        $record->evolution = $recordClone->evolution;
        $record->procedure = $recordClone->procedure;
        $record->updated_at = null;
        $record->save();


        return redirect()
            ->route('paciente.prontuario.edit', ['paciente'   => $paciente, 'prontuario' => $record->id])
            ->with("success", 'Histórico clonado com sucesso!');
    }



    /**
     * @param PatientRecord $record
     * @param $patient
     * @param Request $request
     */
    private function saveHistoric(PatientRecord $record, $patient, Request $request)
    {
        $record->patient_id = $patient;
        $record->historic = $request->historic;
        $record->evolution = $request->evolution;
        $record->procedure = $request->procedure;
        $record->save();
    }
}
