<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $events=[
        [
            'event'=>'cita#1',
            'start_date'=>'2023-05-18 08:00',
            'end_date'=>'2023-05-18 11:00',
        ],
        [
            'event'=>'cita#2',
            'start_date'=>'2023-06-18 08:00',
            'end_date'=>'2023-07-18 11:00',
        ],
        [
            'event'=>'cita#3',
            'start_date'=>'2023-05-18 09:00',
            'end_date'=>'2023-05-18 12:00',
        ],
    ];
        foreach($events as $event){
            Event::create($event);
        }
    }
}
