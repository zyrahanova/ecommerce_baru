<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return response()->json([
            "message" => "Data kategori berhasil diambil",
            "data" => $products
        ], Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                "name" => ["required"],
                "description" => ["required"],
                "price" => ["required"],
                "image" => ["required"]
            ], [
                "name.required" => "Nama produk harus diisi",
                "description.required" => "Deskripsi produk harus diisi",
                "price.required" => "Harga produk harus diisi",
                "image.required" => "Foto produk harus diisi"
            ]);

            Product::insert([
                "name" => $request->name,
                "description" => $request->description,
                "price" => $request->price,
                "image" => $request->image
            ]);

            return response()->json([
                "message" => "Data produk berhasil ditambahkan",
            ], Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => "Data produk gagal ditambahkan",
                "error" => $th->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        return response()->json([
            "message" => "Data kategori berhasil diambil",
            "data" => $product
        ], Response::HTTP_OK);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
