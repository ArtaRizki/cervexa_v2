<?php

namespace App\Http\Controllers\Cervexa;

use App\Http\Controllers\Controller;
use App\Models\Cervexa\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function lookup(Request $request)
    {
        $nik = $request->query('nik');
        if (!$nik) {
            return response()->json(['found' => false, 'data' => null]);
        }

        $patient = Patient::where('nik', $nik)->first();

        if ($patient) {
            return response()->json([
                'found' => true,
                'data' => [
                    'id' => $patient->id,
                    'nama' => $patient->nama,
                    'nik' => $patient->nik,
                    'hospital_name' => $patient->hospital_name,
                    'nrm' => $patient->nrm,
                    'age' => null, // Calculate if dob exists
                    'dob' => $patient->dob,
                    'sessions_count' => $patient->sessions()->count(),
                    'created_at' => $patient->created_at->toIso8601String()
                ]
            ]);
        }

        return response()->json(['found' => false, 'data' => null]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|string',
            'nik' => 'required|string|unique:cervexa_patients,nik',
            'hospital_name' => 'required|string',
            'nrm' => 'nullable|string'
        ]);

        $dob = null;
        if ($request->has('dob_utc') && $request->dob_utc) {
            $dob = date('Y-m-d', $request->dob_utc / 1000);
        }

        $patient = Patient::create([
            'nama' => $request->input('nama'),
            'nik' => $request->input('nik'),
            'hospital_name' => $request->input('hospital_name'),
            'nrm' => $request->input('nrm'),
            'dob' => $dob
        ]);

        return response()->json([
            'message' => 'Patient created successfully',
            'data' => [
                'id' => $patient->id,
                'nama' => $patient->nama,
                'nik' => $patient->nik,
                'hospital_name' => $patient->hospital_name,
                'nrm' => $patient->nrm,
                'age' => null,
                'dob' => $patient->dob,
                'sessions_count' => 0,
                'created_at' => $patient->created_at->toIso8601String()
            ]
        ], 201);
    }

    public function show($id)
    {
        $patient = Patient::find($id);

        if (!$patient) {
            return response()->json(['message' => 'Patient not found'], 404);
        }

        return response()->json([
            'message' => 'Success',
            'data' => [
                'id' => $patient->id,
                'nama' => $patient->nama,
                'nik' => $patient->nik,
                'hospital_name' => $patient->hospital_name,
                'nrm' => $patient->nrm,
                'age' => null,
                'dob' => $patient->dob,
                'sessions_count' => $patient->sessions()->count(),
                'created_at' => $patient->created_at->toIso8601String()
            ]
        ]);
    }
}
