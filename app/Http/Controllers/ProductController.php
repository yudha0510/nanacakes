<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('images')
            ->latest()
            ->get();

        return view('admin.product', compact('products'));
    }

    public function create()
    {
        return view('admin.tambah-produk');
    }

    public function store(Request $request)
    {
        $product = Product::create([
            'name'        => $request->name,
            'category'    => $request->category,
            'price'       => $request->price,
            'description' => $request->description,
            'image'       => null,
        ]);

        if ($request->hasFile('images')) {

            $firstImage = true;

            foreach ($request->file('images') as $image) {

                $imagePath = $image->store('products', 'public');

                ProductImage::create([
                    'product_id' => $product->id,
                    'image'      => $imagePath,
                ]);

                if ($firstImage) {
                    $product->update(['image' => $imagePath]);
                    $firstImage = false;
                }
            }
        }

        return redirect()
            ->route('product.index')
            ->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit($id)
    {
        $product = Product::with('images')->findOrFail($id);

        return view('admin.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Hapus foto lama yang ditandai user
        if ($request->deleted_images) {

            $ids = explode(',', $request->deleted_images);

            foreach ($ids as $imageId) {

                $image = ProductImage::find($imageId);

                if ($image) {
                    $image->delete();
                }
            }
        }

        // Update data produk
        $product->update([
            'name'        => $request->name,
            'category'    => $request->category,
            'price'       => $request->price,
            'description' => $request->description,
        ]);

        // Tambah foto baru jika ada
        if ($request->hasFile('images')) {

            foreach ($request->file('images') as $image) {

                $imagePath = $image->store('products', 'public');

                ProductImage::create([
                    'product_id' => $product->id,
                    'image'      => $imagePath,
                ]);
            }
        }

        // Update cover image ke foto pertama yang masih ada
        $coverImage = ProductImage::where('product_id', $product->id)->first();

        if ($coverImage) {
            $product->update(['image' => $coverImage->image]);
        }

        return redirect()
            ->route('product.index')
            ->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy($id)
    {
        $product = Product::with('images')->findOrFail($id);

        foreach ($product->images as $image) {

            $image->delete();
        }

        $product->delete();

        return redirect()
            ->route('product.index')
            ->with('success', 'Produk berhasil dihapus');
    }
    
    public function menu()
    {
        $products = Product::with('images')
            ->latest()
            ->get();

        $categories = Product::select('category')
            ->distinct()
            ->pluck('category');

        return view('user.menu', compact(
            'products',
            'categories'
        ));
    }

    public function deleteImage($id)
    {
        $image = ProductImage::findOrFail($id);

        $image->delete();

        return back()->with('success', 'Foto berhasil dihapus');
    }
}