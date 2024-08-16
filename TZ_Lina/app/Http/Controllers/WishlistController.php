<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class WishlistController extends Controller
{
    public function create(Request $request) {

        $validated = $request->validate([
            'place_id' => 'required',
            'user_id' => ['required', Rule::unique('wishlists')->where(function ($query) use ($request) {
                return $query->where('place_id', $request->place_id);
            }), function ($attribute, $value) {
                $count = Wishlist::where('user_id', $value)->distinct('place_id')->count();
                if($count >= 3) {
                    return response()->json(['message' => 'User already has 3 wishlists with different place_ids']);
                }
            }]
        ]);

        if($validated) {
            $wishlist = new Wishlist();
            $wishlist->place_id = $request->input('place_id');
            $wishlist->user_id = $request->input('user_id');

            if($wishlist->save()) {
                return response()->json(['message' => 'Wishlist created successfully']);
            } else {
                return response()->json(['message' => 'Something went wrong when saving the record']);
            }
        } else {
            return response()->json(['message' => 'Validation failed, please try again']);
        }
    }

    public function index($id) {

        $wishlist = Wishlist::where('user_id', $id)->get();
        return response()->json($wishlist);

    }
}
