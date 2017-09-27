<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\PatientAddress;
use App\Models\PatientPhone;
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
        return view("admin.patient.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.patient.create", [
            "patient" => new Patient(),
            "action" => route("paciente.store"),
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
        $this->savePatient(new Patient(), $request);

        return redirect()
            ->route("paciente.index")
            ->with("success", 'Paciente "' . $request->name . '" cadastrado com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view("admin.patient.edit", [
            "patient" => Patient::find($id),
            "action" => route("paciente.update", $id),
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
        $this->savePatient(Patient::find($id), $request);

        return redirect()
            ->route("paciente.index")
            ->with("success", 'Paciente "' . $request->name . '" editado com sucesso!');
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
        Patient::destroy($id);

        return redirect()
            ->route("paciente.index")
            ->with("success", 'Paciente "' . $patient->name . '" removido com sucesso!');
    }

    /**
     * @param Patient $patient
     * @param Request $request
     */
    private function savePatient(Patient $patient, Request $request)
    {
        $birthday = Carbon::parse(str_replace("/", "-", $request->birthday))
            ->format("Y-m-d");

        $patient->name = $request->name;

        if (!$patient->document) {
            $patient->document = $request->document;
        }

        $patient->email = $request->email;
        $patient->gender = $request->gender;
        $patient->birthday = $birthday;
        $patient->profession = $request->profession;
        $patient->indication = $request->indication;

        $patient->save();

        $this->saveAddress($patient, $request);
        $this->savePhones($patient, $request);

    }

    /**
     * @param Patient $patient
     * @param Request $request
     */
    private function saveAddress(Patient $patient, Request $request)
    {
        if ($request->zip) {
            $address = new PatientAddress();

            if ($patient->address) {
                $address = $patient->address;
            }

            $address->patient_id = $patient->id;
            $address->address = $request->address;
            $address->number = $request->number;
            $address->complement = $request->complement;
            $address->district = $request->district;
            $address->city = $request->city;
            $address->state = $request->state;
            $address->zip_code = $request->zip;

            $address->save();
        }
    }

    /**
     * @param Patient $patient
     * @param Request $request
     */
    private function savePhones(Patient $patient, Request $request)
    {
        if ($phoneNumber = $request->phone) {
            $phone = new PatientPhone();

            if (count($patient->phones->where("type", 1)) > 0) {
                $phone = $patient->phones->where("type", 1)->first();
            }

            $phone->patient_id = $patient->id;
            $phone->phone = $phoneNumber;
            $phone->type = 1;

            $phone->save();
        }

        if ($mobileNumber = $request->mobile) {
            $mobile = new PatientPhone();

            if (count($patient->phones->where("type", 2)) > 0) {
                $mobile = $patient->phones->where("type", 2)->first();
            }

            $mobile->patient_id = $patient->id;
            $mobile->phone = $mobileNumber;
            $mobile->type = 2;

            $mobile->save();
        }
    }
}
