<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cid;
use App\Models\Patient;
use App\Models\PatientRecord;
use Illuminate\Http\Request;

class PatientRecordController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @param $paciente
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index( $paciente ) {
		return view( "admin.records.index", [
			"patient" => Patient::find( $paciente )
		] );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @param $paciente
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create( $paciente ) {
		return view( "admin.records.create", [
			"patient" => Patient::find( $paciente ),
			"record"  => new PatientRecord(),
			"action"  => route( "paciente.prontuario.store", $paciente ),
			"method"  => "post"
		] );
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
	public function store( Request $request, $paciente ) {
		$this->saveHistoric( new PatientRecord(), $paciente, $request );

		return redirect()
			->route( "paciente.prontuario.index" )
			->with( "success", 'CID "' . $request->code . '" cadastrado com sucesso!' );
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
	public function edit( $paciente, $prontuario ) {
		return view( "admin.records.edit", [
			"patient" => Patient::find( $paciente ),
			"record"  => PatientRecord::find( $prontuario ),
			"action"  => route( "paciente.prontuario.update", [
				"paciente"   => $paciente,
				"prontuario" => $prontuario
			] ),
			"method"  => "put"
		] );
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
	public function update( Request $request, $paciente, $prontuario ) {
		$this->saveHistoric( PatientRecord::find( $prontuario ), $paciente, $request );

		return redirect()
			->route( "paciente.prontuario.index", $paciente )
			->with( "success", 'Histório "' . $request->code . '" editado com sucesso!' );
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
	public function destroy( $paciente, $prontuario ) {
		$patient = Patient::find( $paciente );
		PatientRecord::destroy( $prontuario );

		return redirect()
			->route( "records.index" )
			->with( "success", 'Histórico de "' . $patient->name . '" removido com sucesso!' );
	}

	/**
	 * @param PatientRecord $record
	 * @param $patient
	 * @param Request $request
	 */
	private function saveHistoric( PatientRecord $record, $patient, Request $request ) {
		$record->patient_id = $patient;
		$record->historic   = $request->historic;
		$record->evolution  = $request->evolution;
		$record->procedure  = $request->procedure;
		$record->save();
	}
}
