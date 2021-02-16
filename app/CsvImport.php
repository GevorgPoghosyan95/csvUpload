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

    /**
     * @param Collection $rows
     * @return string
     * Iterate every csv row and save in database use RABBITMQ queue
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $client = new Client();
            try {
                //check domains status code if status is 200 save else continue;
                $res = $client->request('GET', $row[0])->getStatusCode();
                if($res == 200){
                    //use UploadCsv job
                    UploadCsv::dispatch($row[0],$this->name);
                }
            } catch (GuzzleException $exception) {
                continue;
            }

        }
        return 'success';
    }
}
