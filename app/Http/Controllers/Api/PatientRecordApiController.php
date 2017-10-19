<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Agreement;
use App\Models\Patient;
use App\Models\PatientRecord;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class PatientRecordApiController extends Controller {

	/**
	 * Display DataTables result.
	 *
	 * @param $patient
	 *
	 * @return Datatables
	 */
	public function getRecordsData( $patient ) {
		$records = PatientRecord::where( 'patient_id', $patient )->get();

		return Datatables::of( $records )
		                 ->addColumn( "action", function ( $record ) use ( $patient ) {
			                 return '<a href="' . route( "paciente.prontuario.edit", [
					                 'paciente'   => $patient,
					                 'prontuario' => $record
				                 ] ) . '" 
                        class="btn bg-grey btn-xs waves-effect" title="Editar histórico"
                        data-toggle="tooltip" data-placement="top"> 
                            <i class="material-icons">edit</i>
                        </a>';
		                 } )
		                 ->escapeColumns( false )
		                 ->make( true );
	}

}
