<?php

namespace App\Http\Controllers\Cervexa;

use App\Http\Controllers\Controller;
use App\Models\Cervexa\Media;
use App\Models\Cervexa\Session;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function upload(Request $request, $sessionId)
    {
        $session = Session::find($sessionId);

        if (!$session) {
            return response()->json(['message' => 'Session not found'], 404);
        }

        if (!$request->hasFile('file')) {
            return response()->json(['message' => 'No file uploaded'], 400);
        }

        $file = $request->file('file');
        $type = $request->input('type', 'snapshot'); // snapshot or video
        
        // Store in public/cervexa_media directory
        $path = $file->store('cervexa_media', 'public');

        $media = Media::create([
            'session_id' => $session->id,
            'type' => $type,
            'original_name' => $file->getClientOriginalName(),
            'public_url' => url('storage/' . $path),
            'file_size' => $file->getSize(),
            'mime_type' => $file->getClientMimeType()
        ]);

        return response()->json([
            'message' => 'Media uploaded successfully',
            'data' => [
                'id' => $media->id,
                'type' => $media->type,
                'original_name' => $media->original_name,
                'public_url' => $media->public_url,
                'file_size' => $media->file_size,
                'mime_type' => $media->mime_type,
                'created_at' => $media->created_at->toIso8601String()
            ]
        ], 201);
    }

    public function destroy($mediaId)
    {
        $media = Media::find($mediaId);

        if (!$media) {
            return response()->json(['message' => 'Media not found'], 404);
        }

        // Optional: Delete physical file here if needed
        $media->delete();

        return response()->json(['message' => 'Media deleted successfully']);
    }
}
