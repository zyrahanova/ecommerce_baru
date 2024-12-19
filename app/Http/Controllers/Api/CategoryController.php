<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * GET /api/categories [READ]
     */
    public function index()
    {
        $categories = Category::all();
        $data = [
            "message" => "Data kategori berhasil diambil",
            "data" => $categories
        ];
        return response()->json($data, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     * POST /api/categories [CREATE]
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                "name" => ["required"],
                "slug" => ["required"]
            ], [
                "name.required" => "Nama kategori harus diisi",
                "slug.required" => "Slug kategori harus diisi"
            ]);

            Category::insert([
                "name" => $request->name,
                "slug" => $request->slug
            ]);

            return response()->json([
                "message" => "Data kategori berhasil ditambahkan",
            ], Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => "Data kategori gagal ditambahkan",
                "error" => $th->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }

        /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $category = Category::find($id);
        $data = [
            "message" => "Data kategori berhasil diambil",
            "data" => $category
        ];
        return response()->json($data, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     * PUT /api/categories/{id} [UPDATE]
     */
    public function update(Request $request, int $id)
    {
        try {
            $request->validate([
                "name" => ["required"],
                "slug" => ["required"]
            ], [
                "name.required" => "Nama kategori harus diisi",
                "slug.required" => "Slug kategori harus diisi"
            ]);

            Category::where("id", $id)->update([
                "name" => $request->name,
                "slug" => $request->slug
            ]);

            return response()->json([
                "message" => "Data kategori berhasil diubah",
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => "Data kategori gagal diubah",
                "error" => $th->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /api/categories/{id} [DELETE]
     */
    public function destroy(int $id)
    {
        try {
            $category = Category::where("id", $id)->first();
            if (!$category) {
                return response()->json([
                    "message" => "Data kategori tidak ditemukan",
                ], Response::HTTP_NOT_FOUND);
            }
            $category->delete();
            return response()->json([
                "message" => "Data kategori berhasil dihapus",
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => "Data kategori gagal dihapus",
                "error" => $th->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
