<?php

namespace App\Infrastructure\Eloquent;

use App\Application\Interfaces\ProductRepositoryInterface;
use App\Infrastructure\External\OpenWeatherAPI;
use Illuminate\Support\Facades\DB;

class EloquentProductRepository implements ProductRepositoryInterface
{
    public function getAll()
    {
        return DB::table('products')->get();
    }

    public function create(array $data)
    {
        return DB::table('products')->insertGetId($data);
    }

    public function find($productId)
    {
        return DB::table('products')->where('id', $productId)->first();
    }

    public function delete($productId)
    {
        $product = $this->find($productId);

        if ($product) {
            return DB::table('products')->where('id', $productId)->delete();
        }

        return false;
    }

    public function findByCategory(string $category)
    {
        return DB::table('products')->where('category', $category)->get();
    }

    public function getRecommendationsWeather(string $city)
    {
        $recommendations = OpenWeatherAPI::getWeather($city);
        return $recommendations;
    }
}
