<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Patient;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.patient.index');
    }

    /**
     * Display DataTables result.
     *
     * @return Datatables
     */
    public function getPatientsData()
    {
        $patients = Patient::select([
            'name',
            'id',
            'document',
            'updated_at'
        ]);

        return Datatables::of($patients)
            ->addColumn('status', function ($patient) {
                $status = 'done_all';
                $class = 'col-green';

                if (!$patient->updated_at) {
                    $status = 'warning';
                    $class = 'col-yellow';
                }

                if (!$patient->document) {
                    $status = 'error';
                    $class = 'col-red';
                }

                return '<i class="material-icons ' . $class . '">' . $status . '</i>';
            })
            ->addColumn('action', function ($patient) {
                return '<a href="' . route('paciente.edit', $patient->id) . '" 
                        class="btn bg-grey btn-xs waves-effect" title="Editar paciente"> 
                            <i class="material-icons">edit</i>
                        </a>';
            })
            ->escapeColumns(false)
            ->make(true);
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
            'action' => route('paciente.store'),
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
        $patient->name = $name;
        $patient->document = $request->document;
        $patient->email = $request->email;
        $patient->gender = $request->gender;
        $patient->birthday = $birthday;
        $patient->profession = $request->profession;
        $patient->save();

        return redirect()
            ->route('paciente.index')
            ->with('success', 'Paciente "' . $name . '" cadastrado com sucesso!');
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
            'action' => route('paciente.update', $id),
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
        $patient->name = $name;
        $patient->document = $request->document;
        $patient->email = $request->email;
        $patient->gender = $request->gender;
        $patient->birthday = $birthday;
        $patient->profession = $request->profession;
        $patient->save();

        return redirect()
            ->route('paciente.index')
            ->with('success', 'Paciente "' . $name . '" editado com sucesso!');
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
            ->route('paciente.index')
            ->with('success', 'Paciente "' . $name . '" excluído com sucesso!');
    }
}
