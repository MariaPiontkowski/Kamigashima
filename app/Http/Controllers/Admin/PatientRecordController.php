<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cid;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($paciente)
    {
        return view("admin.records.index", [
            'patient' => Patient::find($paciente)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.records.create", [
            "records" => new Cid(),
            "action" => route("records.store"),
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
        $this->saveCid(new Cid(), $request);

        return redirect()
            ->route("records.index")
            ->with("success", 'CID "' . $request->code . '" cadastrado com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view("admin.records.edit", [
            "records" => Cid::find($id),
            "action" => route("records.update", $id),
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
        $this->saveCid(Cid::find($id), $request);

        return redirect()
            ->route("records.index")
            ->with("success", 'CID "' . $request->code . '" editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $records = Cid::find($id);
        Cid::destroy($id);

        return redirect()
            ->route("records.index")
            ->with("success", 'CID "' . $records->code . '" removido com sucesso!');
    }

    /**
     * @param Cid $operator
     * @param Request $request
     */
    private function saveCid(Cid $operator, Request $request)
    {
        $operator->code = $request->code;
        $operator->description = $request->description;
        $operator->save();
    }
}
