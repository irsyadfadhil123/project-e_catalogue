<?php
namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CatalogService
{
    public function getProducts()
    {
        $response = Http::get(env('CATALOG_API_ENDPOINT') . '/product');

        return $response->successful() ? $response->json() : [];
    }

    public function getProductById($id)
    {
        $response = Http::get(env('CATALOG_API_ENDPOINT') . "/product/$id");

        return $response->successful() ? $response->json() : [];
    }

    public function postProduct(array $data)
    {
        return Http::post(env('CATALOG_API_ENDPOINT') . "/product", $data);
    }

    public function updateProduct($id, array $data)
    {
        return Http::put(env('CATALOG_API_ENDPOINT') . "/product/$id", $data);
    }

    public function deleteProduct($id)
    {
        return Http::delete(env('CATALOG_API_ENDPOINT') . "/product/$id");
    }
}
