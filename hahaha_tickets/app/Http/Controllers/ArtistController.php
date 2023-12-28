<?php

namespace App\Http\Controllers;
use App\Models\Artist;
use Illuminate\Http\Request;
use App\Models\Event;
class ArtistController extends Controller
{
    public function showArtists(){
        $artists = Artist::all();
        return view('artist',['artists' => $artists]);
    }
    public function new_artist(Request $request)
    {
        $new_artist = new Artist;
        $new_artist->name = $request->name;
        $new_artist->email = $request->email;
        $new_artist->phone_number = $request->phone_number;
        $new_artist->salary= $request->salary;
        $new_artist->save();
        return redirect("artist");
    }
    public function add_artist(){
        return view("new_artist");
    }
    public function delete($id){
        $artist = Artist::find($id);
        $artist->delete();
        return redirect("/");
    }
    public function edit($id) {
        $artist = Artist::findOrFail($id);
        return view('edit_artist', compact('artist'));
    }
    public function update(Request $request, $id) {
        $Artist = Artist::findOrFail($id);
        $Artist->name = $request->name;
        $Artist->phone_number = $request->phone_number;
        $Artist->email = $request->email;
        $Artist->salary = $request->salary;
        $Artist->save();
        return redirect("artist");
    }
}
