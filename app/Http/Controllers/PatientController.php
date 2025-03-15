<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;


class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::all();
        return view('patients.index', compact('patients'));
    }

    // إضافة مريض جديد
    public function create()
    {
        return view('patients.create');
    }

    // حفظ مريض جديد
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|string',
            'dob' => 'required|date',
            'phone' => 'required|string|unique:patients',
            'address' => 'nullable|string',
        ]);

        Patient::create($request->all());
        return redirect()->route('patients.index');
    }

    public function destroy($id)
    {
        $patient = Patient::find($id);
        $patient->delete();
        return redirect()->route('patients.index');
    }


    public function edit($id)
{
    $patient = Patient::find($id);

    return view('patients.edit', compact('patient'));
}


public function update(Request $request,$id)
{
    $patient = Patient::find($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'gender' => 'required|string',
        'dob' => 'required|date',
        'phone' => 'required|string|unique:patients,phone,'. $id,
        'address' => 'nullable|string',
    ]);

    $patient->update([
        'name' => $request->name,
        'gender' => $request->gender,
        'dob' => $request->dob,
        'phone' => $request->phone,
        'address' => $request->address,
    ]);
    $patients = Patient::all();
    return view('patients.index', compact('patients'));
}



}
