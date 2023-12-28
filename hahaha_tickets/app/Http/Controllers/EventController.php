<?php

namespace App\Http\Controllers;
use App\Models\Artist;
use Illuminate\Http\Request;
use App\Models\Event;
class EventController extends Controller
{
   
    public function save_event(Request $request)
    {
        $new_event = new Event;
        $new_event->title = $request->title;
        $new_event->desc = $request->desc;
        $new_event->price = $request->price;
        $new_event->data= $request->data;
        $new_event->location= $request->location;
        $new_event->artist_id=$request->artist_id;
        $new_event->save();
        return redirect("/");
    }
    public function show_event()
    {
        $events = Event::all();
        $artists=Artist::all();
        return view("welcome", ['events' => $events ,'artists'=>$artists]);
    }
    public function delete($id){
        $event = Event::find($id);
        $event->delete();
        return redirect("/");
    }
    public function edit($id) {
        $event = Event::findOrFail($id);
        $artists = Artist::all();
        return view('edit_event', compact('event'), ['artists' => $artists]);
    }
    public function createEventForm()
    {
    $artists = Artist::all(); // Fetch all artists
    return view('new_event', ['artists' => $artists]);
    }
    public function update(Request $request, $id) {
        $event = Event::findOrFail($id);
        $event->title = $request->title;
        $event->desc = $request->desc;
        $event->price = $request->price;
        $event->data = $request->data;
        $event->location = $request->location;
        $event->artist_id=$request->artist_id;
        $event->save();
        return redirect("/");
    }
}
