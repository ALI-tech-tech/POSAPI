<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Traits\ApiResponse;

class CustomerController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers= Auth::user()->customers;
       
        return $this->success_response(data: $customers);
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
        
        $customers=Auth::user()->customers()->create($request->all());
        
        return $this->success_response(data: $customers);
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }

    function rules(Request $request)
    {
       
        
        return Validator::make(
            $request->all(),
            [
                'name' =>    ['required',Rule::unique('customers','name')->where(function ($query) {
                    return $query->where('user_id', Auth::id());
                })],
                'address' => ['required', 'regex:/^[ء-ي\s\p{P}]+$/u'],
                'phone' =>  'required|unique:customers,phone|numeric|digits:9',
               
            ]

        );
    }
}
