<?php

namespace App\Http\Controllers;

use App\Services\CatalogService;
use App\Services\GeminiService;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    protected $catalogService;
    protected $geminiService;

    public function __construct(CatalogService $catalogService, GeminiService $geminiService)
    {
        $this->catalogService = $catalogService;
        $this->geminiService = $geminiService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = $this->catalogService->getProducts();

        return view('catalogue', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'price' => 'required|numeric',
            'category' => 'required|string',
            'description' => 'nullable|string',
            'brand' => 'nullable|string',
            'image' => 'nullable|string',
        ]);

        $response = $this->catalogService->postProduct($request->only(['title', 'price', 'category', 'description', 'brand', 'image']));

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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = request()->query('category');

        $details = $this->catalogService->getProductById($id);
        $promotion = $this->geminiService->postGenerate($category);

        if (!$details) {
            abort(404, 'Product not found');
        } else if (!$promotion) {
            abort(404, 'Generate Error');
        }

        return view('detail', compact('details', 'promotion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            'title' => 'required|string',
            'price' => 'required|numeric',
            'category' => 'required|string',
            'description' => 'nullable|string',
            'brand' => 'nullable|string',
            'image' => 'nullable|string',
        ]);

        $response = $this->catalogService->updateProduct($id, $validateData);

        if ($response->successful()) {
            $data = $response->json();

            return redirect()->back()->with([
                'success' => 'Product Edited successfully!',
                'response' => $data
            ]);
        } else {
            return redirect()->back()->with('failure', 'Something went wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response = $this->catalogService->deleteProduct($id);

        if ($response->successful()) {
            $data = $response->json();

            return redirect()->route('product.index')->with([
                'success' => 'Product Deleted successfully!',
                'response' => $data
            ]);
        } else {
            return redirect()->back()->with('failure', 'Something went wrong!');
        }
    }
}
