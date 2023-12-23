<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    protected $guarded = [];
    protected static array $filterable = ['bedrooms', 'bathrooms', 'garages', 'storeys'];

    public static function getAvailableFilters()
    {
        return Cache::remember('filters', 5, function () {
            $filters = [];

            foreach (self::$filterable as $filter) {
                $filters['checkbox'][$filter]['name'] = ucfirst($filter);
                $filters['checkbox'][$filter]['values'] = DB::table('products')->select($filter)->distinct()->orderBy($filter, 'ASC')->get()->pluck($filter)->toArray();
            }

            $filters['price']['name'] = ucfirst($filter);
            $filters['price']['values'] = DB::table('products')->select(DB::raw('MAX(price) as max_price, MIN(price) as min_price'))->first();
            return $filters;
        });
    }

    public static function getProducts($filter)
    {
        $query = DB::table('products');

        foreach (self::$filterable as $key) {
            if (isset($filter[$key]) && count($filter[$key])) {
                $query->whereIn($key, $filter[$key]);
            }
        }

        if (!empty($filter['price_min'])) {
            $query->where('price', '>=', $filter['price_min']);
        }

        if (!empty($filter['price_max'])) {
            $query->where('price', '<=', $filter['price_max']);
        }

        if (!empty($filter['name'])) {
            $query->where('name', 'like', "%" . $filter['name'] . "%");
        }

        return $query->get();
    }
}
