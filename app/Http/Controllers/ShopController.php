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

        $shop = Shops::where('user_id',  Auth::id())->first();
        if ($shop == null) {
            return $this->failed_response(data: null, message: "Not_found");
        }
        $imageUrl = asset('storage/uploads/' . $shop['image']);
        $shop['image'] = $imageUrl;
        return $this->success_response(data: $shop);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $this->rules($request);
        if ($validate->fails()) {
            return $this->failed_response(data: $validate->errors());
        }
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
        return $this->success_response(data: $shop, message: "AddSuccessful");
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
        $validate = $this->rules($request);
        if ($validate->fails()) {
            return $this->failed_response(data: $validate->errors());
        }
        $shop = Shops::findOrFail($id);
        if ($shop == null) {
            return $this->failed_response(data: null, message: "Not_found");
        }
        if ($shop->image) {
            Storage::delete('public/uploads' . $shop->image);
        }

        $shop->name = $request->input('name');
        $shop->address = $request->input('address');


        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $shop->image = $imageName;
        }


        $shop->save();


        return $this->success_response(data: $shop, message: "AddSuccessful");
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

                'name'    => 'required|string|max:255',
                'address' => 'required|string',
                

            ]


        );
    }
}
