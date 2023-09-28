<?php

namespace App\Http\Controllers\Admin\ImportProduct;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\ProductService;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\ImportProduct;
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
        $products = Product::all();
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
        $data['date'] = date('Y-m-d', strtotime($data['date']));
        $data['price'] =  str_replace([' ', '.', '₫'], '', $data['price']);
        $this->importProductService->create($data);
        return redirect()->route('admin.import-product.list')->with('msg', 'Thêm thành công');
    }

    public function edit($id)
    {
        $products = Product::all();
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
        $data['date'] = date('Y-m-d', strtotime($data['date']));
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
        $infos = $request->input('infos');

        $imports = ImportProduct::join('products', 'import_products.product_id', '=', 'products.id')
            ->where(function ($query) use ($infos) {
                $query->where('products.name', 'like', '%' . $infos . '%')
                    ->orWhere('products.code', 'like', '%' . $infos . '%');
            })
            ->orWhere('import_products.supplier', 'like', '%' . $infos . '%')
            ->paginate(10);

        return view('pages.import-product.list', ['imports' => $imports]);
    }
}
