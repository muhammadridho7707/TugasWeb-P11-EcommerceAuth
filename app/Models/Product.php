<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'name', 'slug', 'sku', 'description', 'price', 'stock', 'is_active',
    ];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    // ---- Scopes ----
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeInStock(Builder $query): Builder
    {
        return $query->where('stock', '>', 0);
    }

    // ---- Accessor ----
    protected function formattedPrice(): Attribute
    {
        return Attribute::get(fn () => 'Rp ' . number_format($this->price, 0, ',', '.'));
    }

    // ---- Relationships ----
    public function category(): BelongsTo   { return $this->belongsTo(Category::class); }
    public function orderItems(): HasMany   { return $this->hasMany(OrderItem::class); }
    public function reviews(): HasMany      { return $this->hasMany(Review::class); }
}