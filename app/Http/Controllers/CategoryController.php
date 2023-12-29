<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category= Auth::user()->categories;
        //$category=Category::all();
        return $this->success_response(data: $category);
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
        
        $category=Auth::user()->categories()->create($request->all());
        
        return $this->success_response(data: $category);
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
                'name' =>  ['required','regex:/^[ء-ي ]+$/u'],
            ]

        );
    }
}
