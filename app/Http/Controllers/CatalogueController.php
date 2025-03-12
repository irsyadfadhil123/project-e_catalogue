<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CatalogService;
use App\Services\GeminiService;
use Illuminate\Support\Facades\Http;

class CatalogueController extends Controller
{
    protected $catalogService;
    protected $geminiService;

    public function __construct(CatalogService $catalogService, GeminiService $geminiService)
    {
        $this->catalogService = $catalogService;
        $this->geminiService = $geminiService;
    }

    public function index()
    {
        $products = $this->catalogService->getProducts();

        return view('catalogue', compact('products'));
    }

    public function details($id, $category)
    {
        $details = $this->catalogService->getProductById($id);
        $category = $this->geminiService->postGenerate($category);

        if (!$details) {
            abort(404, 'Product not found');
        } else if (!$category) {
            abort(404, 'Generate Error');
        }

        return view('detail', compact('details', 'category'));
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
            $data = $response->json();

            return redirect()->back()->with([
                'success' => 'Product added successfully!',
                'response' => $data
            ]);
        } else {
            return redirect()->back()->with('failure', 'Something went wrong!');
        }
    }
}
