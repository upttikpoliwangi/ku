<?php

namespace Modules\Ppid\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class Menu extends Model
{
    protected $table = 'menu_items';

    protected $fillable = [
        'title',
        'type',
        'route_name',
        'url',
        'parent_id',
        'order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer'
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Menu::class, 'parent_id')
            ->orderBy('order');
    }

    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', true);
    }

    public function scopeRootItems(Builder $query): void
    {
        $query->whereNull('parent_id');
    }

    public function scopeOrdered(Builder $query): void
    {
        $query->orderBy('order');
    }

    public function getActualUrlAttribute(): string
    {
        return match ($this->type) {
            'route' => route($this->route_name),
            'external' => $this->url,
            'static' => url($this->url),
            default => '#'
        };
    }

    public function getHasChildrenAttribute(): bool
    {
        return $this->children()->exists();
    }

    public static function getHierarchical(): Collection
    {
        return self::with('children')
            ->rootItems()
            ->ordered()
            ->get();
    }
}

