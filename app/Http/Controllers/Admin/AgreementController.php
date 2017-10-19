<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agreement;
use Illuminate\Http\Request;

class AgreementController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		return view( "admin.agreement.index" );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return view( "admin.agreement.create", [
			"agreement" => new Agreement(),
			"action"    => route( "convenio.store" ),
			"method"    => "post"
		] );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store( Request $request ) {
		$this->saveAgreement( new Agreement(), $request );

		return redirect()
			->route( "convenio.index" )
			->with( "success", 'Convênio "' . $request->name . '" cadastrado com sucesso!' );
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit( $id ) {
		return view( "admin.agreement.edit", [
			"agreement" => Agreement::find( $id ),
			"action"    => route( "convenio.update", $id ),
			"method"    => "put"
		] );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update( Request $request, $id ) {
		$this->saveAgreement( Agreement::find( $id ), $request );

		return redirect()
			->route( "convenio.index" )
			->with( "success", 'Convênio "' . $request->name . '" editado com sucesso!' );
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy( $id ) {
		$agreement = Agreement::find( $id );
		Agreement::destroy( $id );

		return redirect()
			->route( "convenio.index" )
			->with( "success", 'Convênio "' . $agreement->name . '" removido com sucesso!' );
	}

	/**
	 * @param Agreement $operator
	 * @param Request $request
	 */
	private function saveAgreement( Agreement $operator, Request $request ) {
		$operator->agreement = $request->name;
		$operator->save();
	}
}
