<?php

namespace App\Http\Controllers\Admin\ExportProduct;

use App\Http\Controllers\Controller;
use App\Models\ExportProduct;
use App\Models\Product;
use App\Services\ExportProductService;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ExportProductController extends Controller
{
    /**
     * @var ExportProductService
     */
    protected $exportProductService;
    protected $productService;

    public function __construct(ExportProductService $exportProductService, ProductService $productService)
    {
        $this->exportProductService = $exportProductService;
        $this->productService = $productService;
    }

    public function index()
    {
        $exports = $this->exportProductService->getAll();
        return view('pages.export-product.list', ['exports' => $exports]);
    }

    public function create()
    {
        $products = Product::all();
        return view('pages.export-product.create', ['products' => $products]);
    }


    public function store(Request $request)
    {
        $data = $request->only(
            'date',
            'document',
            'quanity',
            'price',
            'buyer_name',
            'note',
            'product_id'
        );
        $data['price'] =  str_replace([' ', '.', '₫'], '', $data['price']);
        $data['date'] = date('Y-m-d', strtotime($data['date']));
        $this->exportProductService->create($data);
        return redirect()->route('admin.export-product.list')->with('msg', 'Thêm thành công');
    }

    public function edit($id)
    {
        $products = Product::all();
        $export = $this->exportProductService->find($id);
        return view('pages.export-product.edit')->with(['export' => $export, 'products' => $products]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->only(
            'date',
            'document',
            'quanity',
            'price',
            'buyer_name',
            'note',
            'product_id'
        );
        $data['date'] = date('Y-m-d', strtotime($data['date']));
        $product = $this->exportProductService->find($id);
        $data['price'] =  str_replace([' ', '.', '₫'], '', $data['price']);

        $this->exportProductService->update($product, $data);
        return redirect()->route('admin.export-product.list')->with('msg', 'Cập nhật thành công');
    }

    public function delete($id)
    {
        $this->exportProductService->delete($id);
        return redirect()->route('admin.export-product.list')->with('msg', 'Xóa thành công');
    }


    public function search(Request $request)
    {
        $infos = $request->input('infos');

        $exports = ExportProduct::join('products', 'export_products.product_id', '=', 'products.id')
            ->where(function ($query) use ($infos) {
                $query->where('products.name', 'like', '%' . $infos . '%')
                    ->orWhere('products.code', 'like', '%' . $infos . '%');
            })
            ->orWhere('export_products.buyer_name', 'like', '%' . $infos . '%')
            ->paginate(10);

        return view('pages.export-product.list', ['exports' => $exports]);
    }
}
