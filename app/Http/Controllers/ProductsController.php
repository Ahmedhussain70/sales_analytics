<?php

namespace App\Http\Controllers;

use App\Infrastructure\Eloquent\EloquentProductRepository;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    protected $productRepository;

    public function __construct(EloquentProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        $products = $this->productRepository->getAll();
        return response()->json(['products' => $products]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'category' => 'required|string',
            'price' => 'required|numeric',
        ]);

        $productId = $this->productRepository->create($validated);
        return response()->json(['message' => 'Product created successfully', 'product_id' => $productId], 201);
    }

    public function show($id)
    {
        $product = $this->productRepository->find($id);
        if ($product) {
            return response()->json($product);
        }

        return response()->json(['message' => 'Product not found'], 404);
    }

    public function delete($id)
    {
        $deleted = $this->productRepository->delete($id);

        if ($deleted) {
            return response()->json(['message' => 'Product deleted']);
        }

        return response()->json(['message' => 'Product not found'], 404);
    }
}
