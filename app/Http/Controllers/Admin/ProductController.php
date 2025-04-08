<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'name' => 'required|string|max:255',
            'price_nomal' => 'required|numeric',
            'price_sale' => 'nullable|numeric',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'image' => 'required|image|max:10240', // Giới hạn 10MB
            'images.*' => 'nullable|image|max:10240', // Nhiều ảnh
        ]);

        try {
            // Lưu ảnh đại diện
            $imageFile = $request->file('image');
            $imageName = time() . '-' . Str::random(10) . '.' . $imageFile->getClientOriginalExtension();
            $imagePath = $imageFile->storeAs('images', $imageName, 'public');
            $imageFilePath = storage_path('app/public/images/' . $imageName);

            // Lưu ảnh sản phẩm
            $productImageFilePaths = [];
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    $fileName = time() . '-' . Str::random(10) . '.' . $file->getClientOriginalExtension();
                    $filePath = $file->storeAs('images', $fileName, 'public');
                    $productImageFilePaths[] = storage_path('app/public/images/' . $fileName);
                }
            }

            // Lưu thông tin sản phẩm vào database
            $product = new \App\Models\Product();
            $product->name = $request->input('name');
            $product->price_nomal = $request->input('price_nomal');
            $product->price_sale = $request->input('price_sale');
            $product->description = $request->input('description');
            $product->content = $request->input('content');
            $product->image = '/storage/images/' . $imageName;
            $product->images = json_encode(array_map(function ($path) {
                return '/storage/images/' . basename($path);
            }, $productImageFilePaths));
            $product->save();

            // Trả về view "Thêm sản phẩm" với thông báo thành công
            return view('admin.product.add', [
                'title' => 'Thêm Sản Phẩm',
                'success' => 'Thêm sản phẩm thành công!'
            ]);
        } catch (\Exception $e) {
            Log::error('Lỗi khi lưu sản phẩm: ' . $e->getMessage());
            // Trả về view "Thêm sản phẩm" với thông báo lỗi
            return view('admin.product.add', [
                'title' => 'Thêm Sản Phẩm',
                'error' => 'Thêm sản phẩm thất bại!'
            ]);
        }
    }

    public function addProduct()
    {
        return view('admin.product.add', [
            'title' => 'Thêm Sản Phẩm'
        ]);
    }
    public function listProduct()
    {
        $products = \App\Models\Product::all();
        return view('admin.product.list', [
            'title' => 'Danh Sách Sản Phẩm',
            'products' => $products,
        ]);
    }
    public function edit($id)
    {
        $product = \App\Models\Product::findOrFail($id);
        return view('admin.product.edit', compact('product'), [
            'title' => 'Chỉnh Sửa thông tin sản phẩm'
        ]);
    }

    public function update(Request $request, $id)
    {
        $product = \App\Models\Product::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price_nomal' => 'required|numeric',
            'price_sale' => 'nullable|numeric',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }
            // Upload ảnh mới
            $imagePath = $request->file('image')->store('product', 'public');
            $validated['image'] = $imagePath;
        }

        $product->update($validated);
        
        return redirect()->route('admin.product.list')->with('success', 'Cập nhật sản phẩm thành công');
    }

    public function destroy($id)
    {
        $product = \App\Models\Product::findOrFail($id);
        
        // Xóa ảnh nếu tồn tại
        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }
        
        $product->delete();
        
        return redirect()->route('admin.product.list')->with('success', 'Xóa sản phẩm thành công');
    }
}
