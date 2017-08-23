<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Patient;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.patient.index', [
            'patients' => Patient::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.patient.create', [
            'patient' => new Patient(),
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

        $patient = new Patient();
        $patient->reference = $request->reference;
        $patient->name = $name;
        $patient->phone = $request->phone;
        $patient->email = $request->email;
        $patient->birthday = $birthday;
        $patient->commission = $request->commission;
        $patient->save();

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
        return view('admin.patient.edit', [
            'patient' => Patient::find($id),
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

        $patient = Patient::find($id);
        $patient->reference = $request->reference;
        $patient->name = $name;
        $patient->phone = $request->phone;
        $patient->email = $request->email;
        $patient->birthday = $birthday;
        $patient->commission = $request->commission;
        $patient->save();

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
        $patient = Patient::find($id);
        $name = $patient->name;

        Patient::destroy($id);

        return redirect()
            ->route('fornecedor.index')
            ->with('success', 'Fornecedor "' . $name . '" cadastrado com sucesso!');
    }
}
