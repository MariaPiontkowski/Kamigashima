<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cid;
use Illuminate\Http\Request;

class CidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("admin.cid.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.cid.create", [
            "cid" => new Cid(),
            "action" => route("cid.store"),
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
            ->route("cid.index")
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
        return view("admin.cid.edit", [
            "cid" => Cid::find($id),
            "action" => route("cid.update", $id),
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
            ->route("cid.index")
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
        $cid = Cid::find($id);
        Cid::destroy($id);

        return redirect()
            ->route("cid.index")
            ->with("success", 'CID "' . $cid->code . '" removido com sucesso!');
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
