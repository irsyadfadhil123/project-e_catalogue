<?php
namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CatalogService
{
    public function getProducts()
    {
        $response = Http::withToken(env('CATALOG_API_KEY'))->get('http://127.0.0.1:8000/api/products');

        return $response->successful() ? $response->json() : [];
    }

    public function getProductById($id)
    {
        $response = Http::withToken(env('CATALOG_API_KEY'))->get("http://127.0.0.1:8000/api/products/{$id}");

        return $response->successful() ? $response->json() : [];
    }

    public function postProduct(array $data)
    {
        return Http::withToken(env('CATALOG_API_KEY'))->post("http://127.0.0.1:8000/api/products", $data);
    }

    public function updateProduct($id, array $data)
    {
        return Http::withToken(env('CATALOG_API_KEY'))->put("http://127.0.0.1:8000/api/products/{$id}", $data);
    }

    public function deleteProduct($id)
    {
        return Http::withToken(env('CATALOG_API_KEY'))->delete("http://127.0.0.1:8000/api/products/{$id}");
    }
}
