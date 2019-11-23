<?php

use Illuminate\Database\Seeder;

class RatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $isoPath = 'https://www.currency-iso.org/dam/downloads/lists/list_one.xml';
        $xmlFile = file_get_contents($isoPath);
        $xml = new \SimpleXMLElement($xmlFile);

        $rates = [];

        foreach ($xml->CcyTbl->CcyNtry as $i) {
            $alphabeticCode = $i->Ccy->__toString();
            $digitCode = (int) $i->CcyNbr->__toString();
            $createdAt = date('Y-m-d  H:i:s');

            if (isset($rates[$alphabeticCode])) continue;
            if ($digitCode === 0) continue;

            $rates[$alphabeticCode] = [
                'name' => '',
                'english_name' => $i->CcyNm->__toString(),
                'alphabetic_code' => $alphabeticCode,
                'digit_code' => $digitCode,
                'rate' => 1,
                'created_at' => $createdAt,
            ];
        }

        DB::table('rates')->insert($rates);
    }
}
