@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

<script src="{{ asset('js/orders/jquery.min.js') }}"></script>
<script src="{{ asset('js/orders/selectize.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/orders/selectize.bootstrap3.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/orders/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/uploadImage.css') }}">
@section('title', 'Thêm')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Quản lý nhập hàng'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4" style="padding-left: 20px">
                <div class="mt-4 mb-2">
                    <h5>Thêm mới</h5>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive">
                        <form action="{{ route('admin.import-product.store') }}" method="post" class="form-add"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group col-lg-12 mb-4">
                                <label class="resLabel" for="">Sản phẩm</label>
                                <div class="sub-form">
                                    <select class="form-control" id="exampleFormControlSelect1" name="product_id">
                                        <option value="">Chọn sản phẩm...</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }}
                                                ({{ $product->code }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <button style="margin-left: 0; margin-top: 10px" type="button"
                                    class="btn btn-xs btn-primary resBtn" data-toggle="modal" data-target="#exampleModal1">
                                    + Thêm sản phẩm
                                </button>
                            </div>
                            {{-- <div class="form-group col-lg-12 mb-4">
                                <div class="sub-form">
                                    <label for="" style="width: 105px;">Chứng chỉ</label>
                                    <input autocomplete="off" required type="text" placeholder="Nhập chứng chỉ"
                                        name="document" class="form-control bg-white border-md">
                                </div>
                            </div> --}}
                            <div class="form-group col-lg-12 mb-4">
                                <div class="sub-form">
                                    <label for="" style="width: 105px;">Số lượng</label>
                                    <input autocomplete="off" required type="number" placeholder="Nhập số lượng"
                                        name="quanity" class="form-control bg-white border-md">
                                </div>
                            </div>
                            <div class="form-group col-lg-12 mb-4">
                                <div class="sub-form">
                                    <label for="" style="width: 105px;">Giá nhập</label>
                                    <input autocomplete="off" required type="text" placeholder="Nhập giá nhập hàng"
                                        name="price" class="form-control bg-white border-md"
                                        oninput="formatCurrency(this)">
                                </div>
                            </div>
                            <div class="form-group col-lg-12 mb-4">
                                <div class="sub-form">
                                    <label for="" style="width: 105px;">Nhà cung cấp</label>
                                    <input autocomplete="off" required type="text" placeholder="Nhập nhà cung cấp"
                                        name="supplier" class="form-control bg-white border-md">
                                </div>
                            </div>
                            <div class="form-group col-lg-12 mb-4">
                                <div class="sub-form">
                                    <label for="" style="width: 105px;">Ngày nhập</label>
                                    <input autocomplete="off" required type="date" placeholder="Nhập ngày nhập hàng"
                                        name="date" class="form-control bg-white border-md">
                                </div>
                            </div>
                            <div class="form-group col-lg-12 mb-4">
                                <label for="" style="width: 100px">Ghi chú</label>
                                <textarea autocomplete="off" placeholder="Nhập ghi chú" name="note" class="form-control bg-white border-md"></textarea>
                            </div>
                            <div class="form-group col-lg-12 mx-auto mb-0">
                                <button class="btn btn-success" type="submit">Lưu lại</button>
                            </div>
                        </form>
                        <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top: -12px">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Thêm sản phẩm</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('admin.product.store-product') }}"
                                            enctype="multipart/form-data" method="post">
                                            @csrf
                                            <div>
                                                <input autocomplete="off" type="text" required name="code"
                                                    style="width: 100%" placeholder="Mã sản phẩm"
                                                    class="form-control bg-white mb-4">
                                                <input autocomplete="off" type="text" required name="name"
                                                    style="width: 100%" placeholder="Tên sản phẩm"
                                                    class="form-control bg-white mb-4">
                                                <input autocomplete="off" type="text" name="unit" required
                                                    placeholder="Đơn vị tính" style="width: 100%"
                                                    class="form-control bg-white mb-4">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-xs btn-secondary"
                                                        data-dismiss="modal">Thoát</button>
                                                    <button type="submit" class="btn btn-xs btn-primary">Lưu
                                                        lại</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="{{ asset('js/orders/jquery-3.2.1.slim.min.js') }}"></script>
    <script src="{{ asset('js/orders/popper.min.js') }}"></script>
    <script src="{{ asset('js/orders/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/orders/jquery.min.js') }}"></script>
    <script src="{{ asset('js/orders/selectize.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/orders/selectize.bootstrap3.min.css') }}">
    <script>
        function formatCurrency(input) {
            // Lấy giá trị người dùng đã nhập
            let value = input.value;

            // Loại bỏ tất cả các ký tự không phải số (ví dụ: dấu phẩy, dấu chấm)
            value = value.replace(/[^0-9]/g, '');

            // Định dạng giá trị dưới dạng tiền tệ (sử dụng toLocaleString)
            value = parseFloat(value).toLocaleString('vi-VN');


            // Gán giá trị đã định dạng lại vào trường input
            input.value = value;
        }
    </script>
@endsection
