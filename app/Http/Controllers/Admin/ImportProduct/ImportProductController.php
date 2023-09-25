<?php

namespace App\Http\Controllers\Admin\ImportProduct;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\ProductService;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Services\ImportProductService;
use Illuminate\Http\Request;

class ImportProductController extends Controller
{
    /**
     * @var ImportProductService
     */
    protected $importProductService;
    protected $productService;

    public function __construct(ImportProductService $importProductService, ProductService $productService)
    {
        $this->importProductService = $importProductService;
        $this->productService = $productService;
    }

    public function index()
    {
        $imports = $this->importProductService->getAll();
        return view('pages.import-product.list', ['imports' => $imports]);
    }

    public function create()
    {
        $products = $this->productService->getAll();
        return view('pages.import-product.create', ['products' => $products]);
    }


    public function store(Request $request)
    {
        $data = $request->only(
            'date',
            'document',
            'quanity',
            'price',
            'supplier',
            'note',
            'product_id'
        );
        $data['price'] =  str_replace([' ', '.', '₫'], '', $data['price']);
        $this->importProductService->create($data);
        return redirect()->route('admin.import-product.list')->with('msg', 'Thêm thành công');
    }

    public function edit($id)
    {
        $products = $this->productService->getAll();
        $import = $this->importProductService->find($id);
        return view('pages.import-product.edit')->with(['import' => $import, 'products' => $products]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->only(
            'date',
            'document',
            'quanity',
            'price',
            'supplier',
            'note',
            'product_id'
        );

        $product = $this->importProductService->find($id);
        $data['price'] =  str_replace([' ', '.', '₫'], '', $data['price']);

        $this->importProductService->update($product, $data);
        return redirect()->route('admin.import-product.list')->with('msg', 'Cập nhật thành công');
    }

    public function delete($id)
    {
        $this->importProductService->delete($id);
        return redirect()->route('admin.import-product.list')->with('msg', 'Xóa thành công');
    }


    public function search(Request $request)
    {
        $infos = $request->only('infos');
        $imports = Product::where('name', 'like', '%' . $infos['infos'] . '%')
            ->orWhere('code', 'like', '%' . $infos['infos'] . '%')
            ->paginate(10);

        return view('pages.import-product.list', ['imports' => $imports]);
    }
}