<?php

namespace App\Http\Controllers\Admin\StatisticalController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


class StatisticalController extends Controller
{
    public function index()
    {

        $importTotals = DB::table('import_products')
            ->select(
                'import_products.product_id',
                DB::raw('SUM(price) as total_price_import'), // Tổng giá nhập
                DB::raw('COUNT(*) as total_records_import'), // Tổng số lượng bản ghi có cùng product_id
                DB::raw('SUM(quanity) as quanity_import'),
            )
            ->groupBy('import_products.product_id')
            ->get();

        $exportTotals = DB::table('export_products')
            ->select(
                'export_products.product_id',
                DB::raw('SUM(price) as total_price_export'), // Tổng giá xuất
                DB::raw('COUNT(*) as total_records_export'), // Tổng số lượng bản ghi có cùng product_id
                DB::raw('SUM(quanity) as quanity_export'),
            )
            ->groupBy('export_products.product_id')
            ->get();

        // Lấy thông tin sản phẩm từ bảng products
        $productDetails = DB::table('products')
            ->select(
                'products.id',
                'products.unit',
                'products.code',
                'products.name as product_name',
                // Thêm các trường thông tin sản phẩm khác ở đây
            )
            ->whereIn('products.id', $importTotals->pluck('product_id'))
            ->get();

        // Kết hợp kết quả của import và export
        $results = $importTotals->map(function ($importTotal) use ($exportTotals, $productDetails) {
            $exportTotal = $exportTotals->where('product_id', $importTotal->product_id)->first();
            $productDetail = $productDetails->where('id', $importTotal->product_id)->first();

            // Tính trung bình giá nhập
            $averagePriceImport = $importTotal->total_price_import / $importTotal->total_records_import;

            // Tính trung bình giá xuất
            $averagePriceExport = $exportTotal ? ($exportTotal->total_price_export / $exportTotal->total_records_export) : 0;

            return [
                'product_name' => $productDetail ? $productDetail->product_name : null,
                'total_import' => $importTotal ? $importTotal->total_records_import : 0,
                'quanity_import' => $importTotal ? $importTotal->quanity_import : 0,
                'total_export' => $exportTotal ? $exportTotal->total_records_export : 0,
                'quanity_export' => $exportTotal ? $exportTotal->quanity_export : 0,
                'unit' => $productDetails ? $productDetail->unit : null,
                'code' => $productDetails ? $productDetail->code : null,
                'average_price_import' => $averagePriceImport,
                'average_price_export' => $averagePriceExport,
            ];
        });

        return view('pages.statistical.list', ['results' => $results]);
    }

    public function search(Request $request)
    {
       
        $currentDate = Carbon::now();
        $data = $request->all();
        
        $dateFrom = isset($data) && !empty($data['dateFrom']) ? date('Y-m-d', strtotime($data['dateFrom'])) : '2000-01-01';
        $dateTo = !empty($data['dateTo']) ? date('Y-m-d', strtotime($data['dateTo'])) : $currentDate->toDateString();

        $importTotals = DB::table('import_products')
            ->select(
                'import_products.product_id',
                DB::raw('SUM(price*quanity) as total_price_import'), // Tổng giá nhập
                DB::raw('COUNT(*) as total_records_import'), // Tổng số lượng bản ghi có cùng product_id
                DB::raw('SUM(quanity) as quanity_import'),
            )
            ->whereBetween('date', [$dateFrom, $dateTo])
            ->groupBy('import_products.product_id')
            ->get();

        $exportTotals = DB::table('export_products')
            ->select(
                'export_products.product_id',
                DB::raw('SUM(price*quanity) as total_price_export'), // Tổng giá xuất
                DB::raw('COUNT(*) as total_records_export'), // Tổng số lượng bản ghi có cùng product_id
                DB::raw('SUM(quanity) as quanity_export'),
            )
            ->whereBetween('date', [$dateFrom, $dateTo])
            ->groupBy('export_products.product_id')
            ->get();

        // Lấy thông tin sản phẩm từ bảng products
        $productDetails = DB::table('products')
            ->select(
                'products.id',
                'products.unit',
                'products.code',
                'products.name as product_name',
                // Thêm các trường thông tin sản phẩm khác ở đây
            )
            ->whereIn('products.id', $importTotals->pluck('product_id'))
            ->get();

        // Kết hợp kết quả của import và export
        $results = $importTotals->map(function ($importTotal) use ($exportTotals, $productDetails) {
            $exportTotal = $exportTotals->where('product_id', $importTotal->product_id)->first();
            $productDetail = $productDetails->where('id', $importTotal->product_id)->first();

            // Tính trung bình giá nhập
            $averagePriceImport = $importTotal->total_price_import / $importTotal->quanity_import;

            // Tính trung bình giá xuất
            $averagePriceExport = $exportTotal ? ($exportTotal->total_price_export / $exportTotal->quanity_export) : 0;

            return [
                'product_name' => $productDetail ? $productDetail->product_name : null,
                'total_import' => $importTotal ? $importTotal->total_records_import : 0,
                'quanity_import' => $importTotal ? $importTotal->quanity_import : 0,
                'total_export' => $exportTotal ? $exportTotal->total_records_export : 0,
                'quanity_export' => $exportTotal ? $exportTotal->quanity_export : 0,
                'unit' => $productDetails ? $productDetail->unit : null,
                'code' => $productDetails ? $productDetail->code : null,
                'average_price_import' => $averagePriceImport,
                'average_price_export' => $averagePriceExport
            ];
        });


        // dd(($results));


        return view('pages.statistical.list', ['results' => $results]);
    }
}
