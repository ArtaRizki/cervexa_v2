<?php

namespace App\Http\Controllers\Cervexa;

use App\Http\Controllers\Controller;
use App\Models\Cervexa\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SessionController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'patient_id' => 'required|integer|exists:cervexa_patients,id'
        ]);

        $session = Session::create([
            'session_code' => 'SESS-' . strtoupper(Str::random(8)),
            'patient_id' => $request->input('patient_id'),
            'status' => 'active',
            'hospital_name' => $request->input('hospital_name'),
            'notes' => $request->input('notes'),
            'started_at' => now()
        ]);

        return response()->json([
            'message' => 'Session created',
            'data' => [
                'id' => $session->id,
                'session_code' => $session->session_code,
                'patient_id' => $session->patient_id,
                'status' => $session->status,
                'hospital_name' => $session->hospital_name,
                'notes' => $session->notes,
                'started_at' => $session->started_at ? $session->started_at->toIso8601String() : null,
                'completed_at' => null,
                'media_count' => 0,
                'created_at' => $session->created_at->toIso8601String()
            ]
        ], 201);
    }

    public function show($id)
    {
        $session = Session::find($id);

        if (!$session) {
            return response()->json(['message' => 'Session not found'], 404);
        }

        return response()->json([
            'message' => 'Success',
            'data' => [
                'id' => $session->id,
                'session_code' => $session->session_code,
                'patient_id' => $session->patient_id,
                'status' => $session->status,
                'hospital_name' => $session->hospital_name,
                'notes' => $session->notes,
                'started_at' => $session->started_at ? $session->started_at->toIso8601String() : null,
                'completed_at' => $session->completed_at ? $session->completed_at->toIso8601String() : null,
                'media_count' => $session->media()->count(),
                'created_at' => $session->created_at->toIso8601String()
            ]
        ]);
    }

    public function complete(Request $request, $id)
    {
        $session = Session::find($id);

        if (!$session) {
            return response()->json(['message' => 'Session not found'], 404);
        }

        $session->status = 'completed';
        $session->completed_at = now();
        
        if ($request->has('notes')) {
            $session->notes = $request->input('notes');
        }

        $session->save();

        return response()->json([
            'message' => 'Session completed',
            'data' => [
                'id' => $session->id,
                'session_code' => $session->session_code,
                'patient_id' => $session->patient_id,
                'status' => $session->status,
                'hospital_name' => $session->hospital_name,
                'notes' => $session->notes,
                'started_at' => $session->started_at ? $session->started_at->toIso8601String() : null,
                'completed_at' => $session->completed_at ? $session->completed_at->toIso8601String() : null,
                'media_count' => $session->media()->count(),
                'created_at' => $session->created_at->toIso8601String()
            ]
        ]);
    }
}
