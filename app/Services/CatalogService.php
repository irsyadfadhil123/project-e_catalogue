<?php
namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CatalogService
{
    public function getProducts()
    {
        $response = Http::get('https://dummyjson.com/products?limit=16');

        return $response->successful() ? $response->json() : [];
    }

    public function getProductById($id)
    {
        $response = Http::get("https://dummyjson.com/products/{$id}");

        return $response->successful() ? $response->json() : [];
    }

    public function postProduct(array $data)
    {
        return Http::post('https://dummyjson.com/products/add', $data);
    }

    public function updateProduct($id, array $data)
    {
        return Http::put("https://dummyjson.com/products/{$id}", $data);
    }

    public function deleteProduct($id)
    {
        return Http::delete("https://dummyjson.com/products/{$id}");
    }
}
