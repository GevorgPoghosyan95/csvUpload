<?php

namespace App\Http\Controllers;

use App\CsvImport;
use App\Doc;
use App\Jobs\UploadCsv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;

class UploadFileController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * Store csv file
     */
    public function store(Request $request)
    {
        $file = $request['file'];
        $name = $file->getClientOriginalName();
        Storage::disk('upload_files')->put($name, File::get($file));
        $path = storage_path('app/public/upload_files/' . $name);
        $rows = Excel::toCollection(new CsvImport(), $path)[0];
        $import = new CsvImport($name);
        $import->collection($rows);
        return response()->json(['status'=>'success']);

    }

    /**
     * @return false|string
     * Show all saved files
     */
    public function files(){
        $paths = Storage::files('public/upload_files/');
        $files = [];
        foreach ($paths as $path) {
            $storagePath = storage_path('app/public/upload_files/' . basename($path));
            $rows = Excel::toCollection(new CsvImport(), $storagePath)[0];
            $dbRowsCount = Doc::where('file',basename($path))->count();
            $files[] = ['name'=>basename($path),'rows'=>count($rows),'inserted'=>$dbRowsCount];
        }
        $files ? $result = json_encode($files) : $result = json_encode([[]]);
        return $result;
    }


}
