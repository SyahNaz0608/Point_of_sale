<?php

namespace App\Http\Controllers;

use File;
use Image;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            // 'code'        => 'string|max:10|unique:products',
            'name'        => 'required|string|max:100',
            'description' => 'nullable|string|max:100',
            'stock'       => 'required|integer',
            'price'       => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'photo'       => 'nullable|image|mimes:jpg,png,jpeg',
        ]);

        try {
            //default $photo = null
            $photo = null;
            //jika terdapat file (Foto / Gambar) yang dikirim
            if ($request->hasFile('photo')) {
                //maka menjalankan method saveFile()
                $photo = $this->saveFile($request->name, $request->file('photo'));
            }

            //Simpan data ke dalam table products
            $product = Product::create([
                // 'code'        => $request->code,
                'name'        => $request->name,
                'description' => $request->description,
                'stock'       => $request->stock,
                'price'       => $request->price,
                'category_id' => $request->category_id,
                'photo'       => $photo
            ]);

            //jika berhasil direct ke products.index
            return redirect(route('products.index'))->with(['success' => '<strong>' . $product->name . '</strong> Ditambahkan']);
        } catch (\Exception $e) {
            //jika gagal, kembali ke halaman sebelumnya kemudian tampilkan error
            return redirect()->back()
                ->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::orderBy('name', 'ASC')->get();
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            // 'code'        => 'required|string|max:10|exists:products,code',
            'name'        => 'required|string|max:100',
            'description' => 'nullable|string|max:100',
            'stock'       => 'required|integer',
            'price'       => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'photo'       => 'nullable|image|mimes:jpg,png,jpeg'
        ]);

        try {
            //query select berdasarkan id
            $product = Product::findOrFail($id);
            $photo   = $product->photo;

            //cek jika ada file yang dikirim dari form
            if ($request->hasFile('photo')) {
                //cek, jika photo tidak kosong maka file yang ada di folder uploads/product akan dihapus
                !empty($photo) ? File::delete(public_path('uploads/product/' . $photo)):null;
                //uploading file dengan menggunakan method saveFile() yg telah dibuat sebelumnya
                $photo = $this->saveFile($request->name, $request->file('photo'));
            }

            //perbaharui data di database
            $product->update([
                'name'        => $request->name,
                'description' => $request->description,
                'stock'       => $request->stock,
                'price'       => $request->price,
                'category_id' => $request->category_id,
                'photo'       => $photo
            ]);

            return redirect(route('products.index'))
                ->with(['success' => '<strong>' . $product->name . '</strong> Diperbaharui']);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $products = Product::findOrFail($id);
        //mengecek, jika field photo tidak null / kosong
        if (!empty($products->photo)) {
            //file akan dihapus dari folder uploads/products
            File::delete(public_path('uploads/product/' . $products->photo));
        }
        //hapus data dari table
        $products->delete();
        return redirect()->back()->with(['success' => '<strong>' . $products->name . '</strong> Telah Dihapus!']);
    }

    // helper function untuk menyimpan file foto
    private function saveFile($name, $photo)
    {
        $images = Str::slug($name) . time() . '.' . $photo->getClientOriginalExtension();
        //set path untuk menyimpan gambar
        $path = public_path('uploads/product');

        //cek jika uploads/product bukan direktori / folder
        if (!File::isDirectory($path)) {
            //maka folder tersebut dibuat
            File::makeDirectory($path, 0777, true, true);
        }
        //simpan gambar yang diuplaod ke folrder uploads/products
        Image::make($photo)->save($path . '/' . $images);
        //mengembalikan nama file yang ditampung divariable $images
        return $images;
    }
}
