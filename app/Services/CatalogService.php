<?php
namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CatalogService
{
    public function getProducts()
    {
        $response = Http::withToken(env('CATALOG_API_KEY'))->get(env('CATALOG_API_ENDPOINT') . '/api/products');

        return $response->successful() ? $response->json() : [];
    }

    public function getProductById($id)
    {
        $response = Http::withToken(env('CATALOG_API_KEY'))->get(env('CATALOG_API_ENDPOINT') . "/api/products/{$id}");

        return $response->successful() ? $response->json() : [];
    }

    public function postProduct(array $data)
    {
        return Http::withToken(env('CATALOG_API_KEY'))->post(env('CATALOG_API_ENDPOINT') . "/api/products", $data);
    }

    public function updateProduct($id, array $data)
    {
        return Http::withToken(env('CATALOG_API_KEY'))->put(env('CATALOG_API_ENDPOINT') . "/api/products/{$id}", $data);
    }

    public function deleteProduct($id)
    {
        return Http::withToken(env('CATALOG_API_KEY'))->delete(env('CATALOG_API_ENDPOINT') . "/api/products/{$id}");
    }
}
