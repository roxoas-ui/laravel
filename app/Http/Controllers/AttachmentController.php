<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAttachmentRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Response;

class AttachmentController extends Controller
{
    public function store(StoreAttachmentRequest $request)
    {
        $file = $request->file('file');
        $disk = config('filesystems.default', env('FILESYSTEM_DISK', 'local'));
        $path = $file->store('attachments', $disk);

        $attachment = Attachment::create([
            'attachable_type' => $request->input('attachable_type'),
            'attachable_id' => $request->input('attachable_id'),
            'filename' => $file->getClientOriginalName(),
            'path' => $path,
            'mime' => $file->getClientMimeType(),
            'size' => $file->getSize(),
            'uploaded_by' => $request->user()?->id,
        ]);

        return response()->json($attachment, 201);
    }

    public function download(\App\Models\Attachment $attachment)
    {
        $disk = config('filesystems.default', env('FILESYSTEM_DISK', 'local'));

        if ($disk === 's3') {
            // presigned temporary URL
            $url = Storage::disk('s3')->temporaryUrl($attachment->path, now()->addMinutes(30));
            return response()->json(['url' => $url]);
        }

        // For local/public: return a signed route that streams the file
        $signed = URL::temporarySignedRoute('attachments.signed', now()->addMinutes(15), ['attachment' => $attachment->id]);
        return response()->json(['url' => $signed]);
    }

    // route to serve signed local files
    public function signedDownload(\Illuminate\Http\Request $request, \App\Models\Attachment $attachment)
    {
        if (! $request->hasValidSignature()) {
            abort(403);
        }

        $disk = config('filesystems.default', env('FILESYSTEM_DISK', 'local'));

        if (! Storage::disk($disk)->exists($attachment->path)) {
            abort(404);
        }

        return Storage::disk($disk)->download($attachment->path, $attachment->filename);
    }
}
