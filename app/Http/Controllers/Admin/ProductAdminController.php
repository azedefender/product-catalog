<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class ProductAdminController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index()
    {
        return Inertia::render('Admin/Products/Index');
    }

    public function create()
    {
        return Inertia::render('Admin/Products/Create');
    }

    public function edit($id)
    {
        return Inertia::render('Admin/Products/Edit', [
            'productId' => (int) $id,
        ]);
    }
}