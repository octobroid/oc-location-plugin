<?php namespace Octobro\Location\Updates;

use Db;
use October\Rain\Database\Updates\Seeder;
use RainLab\Location\Models\Country;
use Octobro\Location\Models\District;
use Octobro\Location\Models\Subdistrict;
use League\Csv\Reader;

class SeedSubdistricts extends Seeder
{
    public function run()
    {
        $this->seedDistricts();
    }

    protected function seedDistricts()
    {
        Subdistrict::truncate();

        $file = Reader::createFromPath('plugins/octobro/location/files/subdistrict.csv');
        $seeds = $file->getRecords();

        foreach ($seeds as $key => $seed) {
            if($seed[0] != 'code') {
                $district = District::where('code', $seed[1])->first();
                $state = $district?$district->state:null;
                $country = $state?$state->country:null;
                if ($district) {
                    Subdistrict::create([
                        'country_id'    =>  $country?$country->id:null,
                        'state_id'      =>  $state?$state->id:null,
                        'district_id'   =>  $district?$district->id:null,
                        'name'          =>  $seed[2],
                        'code'          =>  $seed[0],
                    ]);
                }
            }
        }
    }
}