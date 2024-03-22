<?php

namespace App\Http\Controllers;

use App\Models\File;
use Inertia\Inertia;
use App\Models\FileUpload;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class FileUploadController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:1024000000', // 10GB maximum
        ]);

        // Generate a unique ID
        $uniqueId = Str::uuid()->toString();

        // Store the file
        $file = $request->file('file');
        $path = $file->storeAs('uploads', $uniqueId.'.'.$file->getClientOriginalExtension());

        // Save file information to the database
        $uploadedFile = new FileUpload();
        $uploadedFile->unique_id = $uniqueId;
        $uploadedFile->original_name = $file->getClientOriginalName();
        $uploadedFile->file_path = $path;
        $uploadedFile->save();

        return response()->json(['message' => 'File uploaded successfully', 'unique_id' => $uniqueId]);
    }

    public function fileUploader()
    {
        return Inertia::render('FileUploadForm');
    }
}
