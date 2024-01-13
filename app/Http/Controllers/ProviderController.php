<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Traits\ApiResponse;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProviderController extends Controller
{
    use ApiResponse,SoftDeletes;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $provigers= Auth::user()->providers;
       
        return $this->success_response(data: $provigers);
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
        
        $provider=Auth::user()->providers()->create($request->all());
        
        return $this->success_response(data: $provider,message:"AddSuccessful");
    }

    /**
     * Display the specified resource.
     */
    public function show(Provider $provider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Provider $provider)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $provider= Provider::find($id);
        $provider->delete();
        return $this->success_response(data: $provider,message:"DeleteSuccessful");

    }

    function rules(Request $request)
    {
       
        
        return Validator::make(
            $request->all(),
            [
                'name' =>    ['required',Rule::unique('providers','name')->where(function ($query) {
                    return $query->where('user_id', Auth::id());
                })],
                'address' => ['required', 'regex:/^[ء-ي\s\p{P}]+$/u'],
                'phone' =>  'required|unique:providers,phone|numeric|digits:9',
               
            ]

        );
    }
}
