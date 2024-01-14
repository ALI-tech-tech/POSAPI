<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\SoftDeletes;
class ProductController extends Controller
{
    use ApiResponse,SoftDeletes;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Auth::user()->categories()->with('products')->get();
        return $this->success_response(data: $products);
    }

    public function getproducts()
    {
        $user = Auth::user();
        $products=$user->products;
        return $this->success_response(data: $products);
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
        $user = Auth::user();

        $category = $user->categories()->findOrFail($request->category_id);


        // $category = Category::findOrFail($validatedData['category_id']);
        $product = $category->products()->create($request->all());


        return $this->success_response(data: $product,message:"AddSuccessful");
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
        $product= Products::find($id);
        $product->delete();
        return $this->success_response(data: $product,message:"DeleteSuccessful");

    }
    function rules(Request $request)
    {
        
        return Validator::make(
            $request->all(),
            [
                'name' =>  ['required', Rule::unique('products')->where(function ($query) use ($request) {
                    return $query->where('category_id', $request->category_id)->where('name', $request->name);
                })],
                "category_id"=>['regex:/^[0-9]+$/u','exists:categories,id', Rule::unique('categories','name')->where(function ($query) {
                    return $query->where('user_id', Auth::id());
                })],
                
                "provider_id"=>['required'],
                "buy"=>['regex:/^[0.0-9.0]+$/u'],
                "sell"=>['regex:/^[0.0-9.0]+$/u'],
                "description"=>['required'],
                "quantity"=>['regex:/^[0-9]+$/u']
            ]

        );
    }
}
