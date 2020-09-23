<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $appends = ['url', 'product_image'];

    public function getProductImageAttribute()
    {
        return \Storage::url($this->image);
    }

	public function product()
	{
		return $this->belongsTo(Product::class);
	}
	function getUrlAttribute()
	{
		if(substr($this->image, 0, 4) === "http")
		{
			return $this->image;
		}
		return \Storage::url($this->image);
	}
}
