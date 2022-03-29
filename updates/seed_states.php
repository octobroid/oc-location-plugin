<?php namespace Octobro\Location\Updates;

use Db;
use October\Rain\Database\Updates\Seeder;
use RainLab\Location\Models\Country;
use RainLab\Location\Models\State;
use League\Csv\Reader;

class SeedStates extends Seeder
{
    public function run()
    {
        $this->seedStates();
    }

    protected function seedStates()
    {
        $country = Country::whereCode('ID')->first();

        if ($country->states()->count() > 0) {
            return;
        }
        
        Country::query()->update([
            'is_enabled' => false,
            'is_pinned'  => false,
        ]);
        
        $country->is_enabled = true;
        $country->is_pinned  = true;
        $country->save();

        $countryId = $country->id;

        $file = Reader::createFromPath('files/states.csv');
        $seeds = $file->getRecords();

        foreach ($seeds as $key => $seed) {
            if($seed[0] != 'code') {
                State::updateOrCreate([
                    'code'          =>  $seed[0],
                ],
                [
                    'country_id'    =>  $countryId,
                    'name'          =>  $seed[1],
                ]);
            }
        }
    }
}