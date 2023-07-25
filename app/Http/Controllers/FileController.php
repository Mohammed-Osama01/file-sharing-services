<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class FileController extends Controller
{

    public function index(){
        $files = File::orderByDesc('created_at', 'DESC')->get();

        $success = session('success');

        return view('files.index', compact('files', 'success'));
    }
    public function create(){

        return view('files.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable|max:255',
        ]);


        $myFile = new File();
        $myFile->title = $request->post('title');
        $myFile->description = $request->post('description');

        if ($request->hasFile('cover_path')) {
            $file = $request->file('cover_path');
            $path = $file->store('/covers', 'public');

            $myFile->cover_path = $path;
        }
        $myFile->save();
        return redirect()->route('files.index')->with('success', 'File Uploaded');
    }
    public function destroy(string $id)
    {
        $file = File::findOrFail($id);

        if ($file->cover_path) {
            Storage::delete('/public/covers/' . basename($file->cover_path));
        }

        $file->delete();

        return redirect()->route('files.index')->with('success', 'File deleted successfully');
    }

    public function download($id)
    {
        $myFile = File::findOrFail($id);
        $file_path = 'storage/' . $myFile->cover_path;
        if ($file_path) {
            return Response::download($file_path);
        } else {
            exit('Requested file does not exist on our server!');
        }
    }
}
