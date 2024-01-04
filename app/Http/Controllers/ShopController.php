<?php

namespace App\Http\Controllers;

use App\Models\Shops;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Traits\ApiResponse;

class ShopController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $userId = Auth::id();

        $shop = Shops::where('user_id', $userId)->first();

        return $this->success_response(data: $shop);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/uploads', $imageName);
            $imageUrl = asset('storage/uploads/' . $imageName);
        } else {
            $imageName = null;
        }

        $shop = Shops::create([
            'name' => $request->input('name'),
            'image' => $imageName,
            'address' => $request->input('address'),
            'user_id' => Auth::id(),
        ]);
        $shop['image_url'] = $imageUrl;
        return $this->success_response(data: $shop);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    function rules(Request $request)
    {
        return Validator::make(
            $request->all(),
            [
                'name' =>    ['required'],
                'address' => ['required', 'regex:/^[ء-ي\s\p{P}]+$/u'],
                'image' => 'image',
            ]


        );
    }
}
