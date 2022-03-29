<?php namespace Octobro\Location\Updates;

use Db;
use October\Rain\Database\Updates\Seeder;
use RainLab\Location\Models\Country;
use RainLab\Location\Models\State;
use Octobro\Location\Models\District;
use League\Csv\Reader;

class SeedDistricts extends Seeder
{
    public function run()
    {
        $this->seedDistricts();
    }

    protected function seedDistricts()
    {
        District::truncate();

        $file = Reader::createFromPath('plugins/octobro/location/files/district.csv');
        $seeds = $file->getRecords();

        foreach ($seeds as $key => $seed) {
            if($seed[0] != 'code') {
                $state = State::where('code', $seed[1])->first();
                $country = $state?$state->country:null;
                if ($state) {
                    District::create([
                        'country_id'    =>  $country?$country->id:null,
                        'state_id'      =>  $state?$state->id:null,
                        'code'          =>  $seed[0],
                        'name'          =>  $seed[2],
                    ]);
                }
            }
        }
    }
}