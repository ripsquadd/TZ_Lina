<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public function index() {
        $places = Place::all();
        foreach ($places as $place) {
            dump($place->name);
        }
    }

    public function create(Request $request) {

        $validated = $request->validate([
            'name' => 'required|unique:places|max:255',
            'longitude' => 'required',
            'latitude' => 'required',
        ]);

        if($validated) {
            $place = new Place();
            $place->name = $request->input('name');
            $place->longitude = $request->input('longitude');
            $place->latitude = $request->input('latitude');

            if($place->save()) {
                return response()->json(['message' => 'Place created successfully']);
            } else {
                return response()->json(['message' => 'Something went wrong when saving the record']);
            }
        } else {
            return response()->json(['message' => 'Validation failed, please try again']);
        }
    }
}
