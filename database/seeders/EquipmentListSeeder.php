<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EquipmentListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get all institute IDs to randomly assign to equipment
        $instituteIds = DB::table('institutes')->pluck('id')->toArray();
        
        // If no institutes exist, create a default one
        if (empty($instituteIds)) {
            DB::table('institutes')->insert([
                'name' => 'Default Institute',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            $instituteIds = [DB::getPdo()->lastInsertId()];
        }

        // Equipment data array
        $equipmentData = [
            [
                'equipment_name' => '5G Base Station',
                'model_no' => 'BS-5G-2023',
                'date' => '2023-01-15',
                'running_time' => '1560 hours',
                'institute_id' => $instituteIds[array_rand($instituteIds)],
            ],
            [
                'equipment_name' => 'Network Analyzer',
                'model_no' => 'NA-4500',
                'date' => '2023-02-10',
                'running_time' => '750 hours',
                'institute_id' => $instituteIds[array_rand($instituteIds)],
            ],
            [
                'equipment_name' => 'Signal Generator',
                'model_no' => 'SG-1000X',
                'date' => '2023-03-22',
                'running_time' => '900 hours',
                'institute_id' => $instituteIds[array_rand($instituteIds)],
            ],
            [
                'equipment_name' => 'Spectrum Analyzer',
                'model_no' => 'SA-2500',
                'date' => '2023-02-01',
                'running_time' => '1200 hours',
                'institute_id' => $instituteIds[array_rand($instituteIds)],
            ],
            [
                'equipment_name' => 'Oscilloscope',
                'model_no' => 'DSO-9000',
                'date' => '2022-12-15',
                'running_time' => '2000 hours',
                'institute_id' => $instituteIds[array_rand($instituteIds)],
            ],
            [
                'equipment_name' => 'RF Power Meter',
                'model_no' => 'PM-430',
                'date' => '2023-01-05',
                'running_time' => '450 hours',
                'institute_id' => $instituteIds[array_rand($instituteIds)],
            ],
            [
                'equipment_name' => 'Function Generator',
                'model_no' => 'FG-5000',
                'date' => '2022-11-20',
                'running_time' => '1800 hours',
                'institute_id' => $instituteIds[array_rand($instituteIds)],
            ],
            [
                'equipment_name' => 'Digital Multimeter',
                'model_no' => 'DMM-8060',
                'date' => '2023-04-05',
                'running_time' => '300 hours',
                'institute_id' => $instituteIds[array_rand($instituteIds)],
            ],
            [
                'equipment_name' => 'Network Simulator',
                'model_no' => 'NS-6G-2023',
                'date' => '2023-03-15',
                'running_time' => '500 hours',
                'institute_id' => $instituteIds[array_rand($instituteIds)],
            ],
            [
                'equipment_name' => 'Antenna Analyzer',
                'model_no' => 'AA-300',
                'date' => '2022-10-10',
                'running_time' => '2500 hours',
                'institute_id' => $instituteIds[array_rand($instituteIds)],
            ],
        ];

        // Insert data with timestamps
        foreach ($equipmentData as $equipment) {
            DB::table('equipment_lists')->insert(array_merge($equipment, [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]));
        }
    }
}