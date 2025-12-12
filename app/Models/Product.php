<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'original_price',
        'stock',
        'image',
        'category_id',
        'is_trending',
        'image_url'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'integer',
        'original_price' => 'integer',
        'stock' => 'integer',
        'is_trending' => 'boolean',
    ];

    /**
     * Get the category that owns the product
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the product image URL with fallback
     */
    public function getImageUrl()
    {
        // Prioritas 1: Jika ada image (local file), gunakan itu
        if (!empty($this->image)) {
            $imagePath = $this->image;
            
            // Handle 'storage/products/filename.jpg' format (newer uploads)
            if (strpos($imagePath, 'storage/') === 0) {
                return asset($imagePath);
            }
            
            // Handle 'products/filename.jpg' format (legacy uploads)
            if (strpos($imagePath, 'images/') === false) {
                $imagePath = 'images/' . $imagePath;
            }
            
            return asset($imagePath);
        }

        // Prioritas 2: Jika ada image_url (external URL), gunakan itu
        if (!empty($this->image_url)) {
            return $this->image_url;
        }

        // Prioritas 3: Return placeholder jika tidak ada gambar
        return asset('images/placeholder.png');
    }

    /**
     * Check if product has valid image
     */
    public function hasImage()
    {
        if (!empty($this->image_url)) {
            return true;
        }

        if (!empty($this->image)) {
            return true;
        }

        return false;
    }
}
