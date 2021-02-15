<?php

namespace App\Http\Controllers;

use App\CsvImport;
use Illuminate\Http\Request;
use App\Doc;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;

class UploadFileController extends Controller
{
    public function index()
    {
        return view('progress-bar-file-upload');
    }

    public function store(Request $request)
    {
        $file = $request['file'];
        $name = $file->getClientOriginalName();
        Storage::disk('upload_files')->put($name, File::get($file));
        $path = storage_path('app/public/upload_files/' . $name);
        $rows = Excel::toCollection(new CsvImport(), $path)[0];
        $import = new CsvImport();
        $result = $import->collection($rows);
        return $result;

    }
}
