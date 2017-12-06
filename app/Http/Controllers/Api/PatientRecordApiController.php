<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Agreement;
use App\Models\Patient;
use App\Models\PatientRecord;
use Illuminate\Http\Request;
use Psy\Util\Json;
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
		$records = PatientRecord::where( 'patient_id', $patient )->orderBy('created_at', 'DESC')->get();

		return Datatables::of( $records )
		                 ->addColumn( "action", function ( $record ) use ( $patient ) {
			                 return '<a href="' . route( "paciente.prontuario.edit", [
					                 'paciente'   => $patient,
					                 'prontuario' => $record
				                 ] ) . '" 
                        class="btn bg-teal btn-xs waves-effect" title="Detalhar histórico"
                        data-toggle="tooltip" data-placement="top"> 
                            <i class="material-icons">search</i>
                        </a>';
		                 } )
		                 ->escapeColumns( false )
		                 ->make( true );
	}

    /**
     * Display List patients.
     *
     * @return Json
     */
    public function getPatientsData() {
        $patient = Patient::select('name')->get();

        return $patient->toJson();
    }


}
