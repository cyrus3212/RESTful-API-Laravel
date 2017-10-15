<?php

namespace App;

use App\Transformers\CategoryTransformer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// Model
use App\Product;

class Category extends Model
{
	use SoftDeletes;
	
	protected $dates = ['deleted_at'];

	public $transformer = CategoryTransformer::class;

    protected $fillable = [
        'name',
        'description'
    ];

    protected $hidden = [
        'pivot'
    ];

    public function products () 
    {
        return $this->belongsToMany(Product::class);
    }
}
