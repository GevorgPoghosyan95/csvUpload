<?php

namespace App;

use App\Jobs\UploadCsv;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\ToCollection;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class CsvImport implements ToCollection
{
    public $name;
    function __construct($name = null)
    {
        $this->name = $name;
        ini_set('max_execution_time', 300000);
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $client = new Client();
            try {
                $res = $client->request('GET', $row[0])->getStatusCode();
                if($res == 200){
                    UploadCsv::dispatch($row[0],$this->name);
                }
            } catch (GuzzleException $exception) {
                continue;
            }

        }
        return 'success';
    }
}
