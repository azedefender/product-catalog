<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Inertia\Inertia;

class ProductPageController extends Controller
{
    public function index()
    {
        return Inertia::render('Home');
    }

    public function show(Product $product)
    {
        return Inertia::render('ProductShow', [
            'product' => $product->load('category')->only('id', 'name', 'description', 'price', 'category'),
        ]);
    }
}