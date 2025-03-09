<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CatalogService;
use Illuminate\Support\Facades\Http;

class CatalogueController extends Controller
{
    protected $catalogService;

    public function __construct(CatalogService $catalogService)
    {
        $this->catalogService = $catalogService;
    }

    public function index()
    {
        $products = $this->catalogService->getProducts();

        return view('catalogue', compact('products'));
    }

    public function post(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'brand' => 'nullable|string',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        $response = $this->catalogService->postProduct($request->only(['title', 'brand', 'price', 'description']));

        if ($response->successful()) {
            return redirect()->back()->with('success', 'Product added successfully!');
        } else {
            return redirect()->back()->with('failure', 'Something went wrong!');
        }
    }
}
