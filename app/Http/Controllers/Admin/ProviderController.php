<?php

namespace App\Http\Controllers\Admin;

use App\Provider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.provider.index', [
            'providers' => Provider::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.provider.create', [
            'provider' => new Provider(),
            'action' => route('fornecedor.store'),
            'method' => 'post'
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
        $name = $request->name;
        $birthday = Carbon::parse(str_replace('/', '-', $request->birthday))
            ->format('Y-m-d');

        $provider = new Provider();
        $provider->reference = $request->reference;
        $provider->name = $name;
        $provider->phone = $request->phone;
        $provider->email = $request->email;
        $provider->birthday = $birthday;
        $provider->commission = $request->commission;
        $provider->save();

        return redirect()
            ->route('fornecedor.index')
            ->with('success', 'Fornecedor "' . $name . '" cadastrado com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.provider.edit', [
            'provider' => Provider::find($id),
            'action' => route('fornecedor.update', $id),
            'method' => 'put'
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
        $name = $request->name;
        $birthday = Carbon::parse(str_replace('/', '-', $request->birthday))
            ->format('Y-m-d');

        $provider = Provider::find($id);
        $provider->reference = $request->reference;
        $provider->name = $name;
        $provider->phone = $request->phone;
        $provider->email = $request->email;
        $provider->birthday = $birthday;
        $provider->commission = $request->commission;
        $provider->save();

        return redirect()
            ->route('fornecedor.index')
            ->with('success', 'Fornecedor "' . $name . '" editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $provider = Provider::find($id);
        $name = $provider->name;

        Provider::destroy($id);

        return redirect()
            ->route('fornecedor.index')
            ->with('success', 'Fornecedor "' . $name . '" cadastrado com sucesso!');
    }
}
