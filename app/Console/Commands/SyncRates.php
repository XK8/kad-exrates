<?php

namespace App\Console\Commands;

use App\Rate;
use Illuminate\Console\Command;

class SyncRates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rates:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync exchange rates from cbr.ru';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $cbrPath = env('CBR_URL', 'http://www.cbr.ru/scripts/XML_daily.asp');
        $xmlFile = file_get_contents($cbrPath);

        $xml = new \SimpleXMLElement($xmlFile);

        foreach ($xml->Valute as $valute) {
            dump($valute);

            $digitCode = $valute->NumCode->__toString();
            $name = $valute->Name->__toString();
            $rate = (float) str_replace(",",".", $valute->Value->__toString());

            $r = Rate::whereDigitCode($digitCode)->update(['name' => $name, 'rate' => $rate]);
        }

        dd('end');
    }
}
