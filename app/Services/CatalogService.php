<?php
namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CatalogService
{
    public function getProducts()
    {
        $response = Http::get('https://dummyjson.com/products');

        return $response->successful() ? $response->json() : [];
    }

    public function getProductById($id)
    {
        $response = Http::get("https://dummyjson.com/products/$id");

        return $response->successful() ? $response->json() : [];
    }

    public function postProduct(array $data)
    {
        $response = Http::post('https://dummyjson.com/products/add', $data);

        return $response->json();
    }
}
