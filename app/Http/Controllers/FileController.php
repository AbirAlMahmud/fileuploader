<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\File;
use Illuminate\Support\Str;

class FileController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:10240', // 10GB maximum
        ]);

        $file = $request->file('file');
        $uniqueId = Str::uuid()->toString(); // Generate unique ID
        $path = $file->storeAs('uploads', $uniqueId . '.' . $file->getClientOriginalExtension());

        $uploadedFile = new File();
        $uploadedFile->unique_id = $uniqueId;
        $uploadedFile->name = $file->getClientOriginalName();
        $uploadedFile->path = $path;
        $uploadedFile->save();

        return Redirect::route('home');
    }
}
