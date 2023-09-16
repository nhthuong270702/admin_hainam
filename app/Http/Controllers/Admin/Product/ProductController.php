<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\ProductService;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @var ProductService
     */
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $products = $this->productService->getAll();
        return view('pages.product.list', ['products' => $products]);
    }

    public function create()
    {
        return view('pages.product.create');
    }


    public function store(CreateProductRequest $request)
    {
        $data = $request->only('code', 'name', 'unit');
        $this->productService->create($data);
        return redirect()->route('admin.product.list')->with('msg', 'Thêm sản phẩm thành công');
    }

    public function storeProduct(CreateProductRequest $request)
    {
        $data = $request->only('code', 'name', 'unit');
        $this->productService->create($data);
        return back();
    }

    public function edit($id)
    {
        $product = $this->productService->find($id);
        return view('pages.product.edit')->with(['product' => $product]);
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $data = $request->only('code', 'name', 'unit');
        $product = $this->productService->find($id);
        $this->productService->update($product, $data);
        return redirect()->route('admin.product.list')->with('msg', 'Cập nhật sản phẩm thành công');
    }

    public function delete($id)
    {
        $this->productService->delete($id);
        return redirect()->route('admin.product.list')->with('msg', 'Xóa sản phẩm thành công');
    }


    public function search(Request $request)
    {
        $infos = $request->only('infos');
        $products = Product::where('name', 'like', '%' . $infos['infos'] . '%')
            ->orWhere('code', 'like', '%' . $infos['infos'] . '%')
            ->paginate(10);

        return view('pages.product.list', ['products' => $products]);
    }
}
