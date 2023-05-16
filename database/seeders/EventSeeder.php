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
            'event'=>'Tarea 1',
            'start_date'=>'2023-05-16 08:00',
            'end_date'=>'2023-05-18 11:00',
        ],
        [
            'event'=>'Tarea 2',
            'start_date'=>'2023-06-18 08:00',
            'end_date'=>'2023-07-21 11:00',
        ],
        [
            'event'=>'Tarea 3',
            'start_date'=>'2023-05-22 09:00',
            'end_date'=>'2023-05-23 12:00',
        ],
        [
            'event'=>'Tarea 4',
            'start_date'=>'2023-05-17 11:00',
            'end_date'=>'2023-05-23 13:00',
        ] 
    ];
        foreach($events as $event){
            Event::create($event);
        }
    }
}
