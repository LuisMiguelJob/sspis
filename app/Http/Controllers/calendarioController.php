<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class calendarioController extends Controller
{
    //
    public function index(){
        $all_events = Event::all();
        $events = [];
        foreach($all_events as $event){
            $events[] = [
                'title' => $event->event,
                'start' => $event->start_date,
                'end' => $event->end_date,
            ];
        }

        return view('projects.calendar', compact('events'));
   
    }
}
