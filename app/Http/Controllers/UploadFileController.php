<?php

namespace App\Http\Controllers;

use App\CsvImport;
use App\Jobs\UploadCsv;
use Illuminate\Http\Request;
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
        UploadCsv::dispatch($name);
        return 'ok';

    }
}
