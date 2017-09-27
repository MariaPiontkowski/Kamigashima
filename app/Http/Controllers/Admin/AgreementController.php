<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AgreementOperator;
use Illuminate\Http\Request;

class AgreementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("admin.agreement.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.agreement.create", [
            "agreement" => new AgreementOperator(),
            "action" => route("convenio.store"),
            "method" => "post"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->saveAgreement(new AgreementOperator(), $request);

        return redirect()
            ->route("convenio.index")
            ->with("success", 'Convênio "' . $request->name . '" cadastrado com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view("admin.agreement.edit", [
            "agreement" => AgreementOperator::find($id),
            "action" => route("convenio.update", $id),
            "method" => "put"
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->saveAgreement(AgreementOperator::find($id), $request);

        return redirect()
            ->route("convenio.index")
            ->with("success", 'Convênio "' . $request->name . '" editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patient = AgreementOperator::find($id);
        AgreementOperator::destroy($id);

        return redirect()
            ->route("convenio.index")
            ->with("success", 'Convênio "' . $patient->name . '" removido com sucesso!');
    }

    /**
     * @param AgreementOperator $operator
     * @param Request $request
     */
    private function saveAgreement(AgreementOperator $operator, Request $request)
    {
        $operator->name = $request->name;
        $operator->save();
    }
}
