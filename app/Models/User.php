<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'contact_number',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function categories(){
        return $this->hasMany(Category::class);
    }
    public function providers(){
        return $this->hasMany(Provider::class);
    }
    public function customers(){
        return $this->hasMany(Customer::class);
    }
    public function products()
    {
        return $this->hasManyThrough( Products::class,Category::class, 'id', 'category_id');     
    }
    public function purchases()
    {
    
        //----------------------------------------------------
        // $userCategories = $this->categories()->pluck('id');

        // $products = Products::whereIn('category_id', $userCategories)->with('purchases')->get();

        // $purchases = collect();

        // foreach ($products as $product) {
        //     $purchases = $purchases->merge($product->purchases);
        // }

        // return $purchases;
        //----------------------------------------------------
        $userCategories = $this->categories()->pluck('id');

        $products = Products::whereIn('category_id', $userCategories)->pluck('id');

        return Purchase::whereIn('product_id', $products)->with('product')->get();
   
    }
  
    public function shop(){
        return $this->hasOne(Shops::class,"user_id",'id');
    }
    
    public function employees(){
        return $this->hasMany(User::class,'parent_id','id');
    }

    public function invoices(){
        return $this->hasMany(Invoice::class);
    }
}
