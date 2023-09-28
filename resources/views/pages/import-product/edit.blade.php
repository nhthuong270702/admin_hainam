@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('title', 'Cập nhật')
<script src="{{ asset('js/orders/jquery.min.js') }}"></script>
<script src="{{ asset('js/orders/selectize.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/orders/selectize.bootstrap3.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/orders/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/uploadImage.css') }}">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Quản lý nhập hàng'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4" style="padding-left: 20px">
                <div class="mt-4 mb-2">
                    <h5>Cập nhật</h5>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive">
                        <form action="{{ route('admin.import-product.update', $import->id) }}" method="post"
                            class="form-add" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group col-lg-12 mb-4">
                                <label class="resLabel" for="">Sản phẩm</label>
                                <div class="sub-form">
                                    <select required class="form-control selectCustomer" id="exampleFormControlSelect1" name="product_id">
                                        {{-- <option value="">Chọn sản phẩm...</option> --}}
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}"
                                                {{ $import->product_id == $product->id ? 'selected' : '' }}>
                                                {{ $product->name }}
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
                                        name="document" class="form-control bg-white border-md"
                                        value={{ $import->document }}>
                                </div>
                            </div> --}}
                            <div class="form-group col-lg-12 mb-4">
                                <div class="sub-form">
                                    <label for="" style="width: 105px;">Số lượng</label>
                                    <input autocomplete="off" required type="number" placeholder="Nhập số lượng"
                                        name="quanity" class="form-control bg-white border-md" value={{ $import->quanity }}>
                                </div>
                            </div>
                            <div class="form-group col-lg-12 mb-4">
                                <div class="sub-form">
                                    <label for="" style="width: 105px;">Giá nhập</label>
                                    <input autocomplete="off" required type="text" placeholder="Nhập giá nhập hàng"
                                        name="price" class="form-control bg-white border-md"
                                        value="{{ number_format(intval($import->price), 0, ',', '.') }}"
                                        oninput="formatCurrency(this)">
                                </div>
                            </div>
                            <div class="form-group col-lg-12 mb-4">
                                <div class="sub-form">
                                    <label for="" style="width: 105px;">Nhà cung cấp</label>
                                    <input autocomplete="off" required type="text" placeholder="Nhập nhà cung cấp"
                                        name="supplier" class="form-control bg-white border-md"
                                        value={{ $import->supplier }}>
                                </div>
                            </div>
                            <div class="form-group col-lg-12 mb-4">
                                <div class="sub-form">
                                    <label for="" style="width: 105px;">Ngày nhập</label>
                                    {{-- <input autocomplete="off" required type="date" placeholder="Nhập ngày nhập hàng"
                                        name="date" class="form-control bg-white border-md" value={{ $import->date }}> --}}
                                    <input style="cursor: pointer" autocomplete="off" required type="text"
                                        placeholder="Nhập ngày nhập hàng" name="date"
                                        class="form-control bg-white border-md dateInput" id="dateInput"
                                        value={{ \Carbon\Carbon::parse($import->date)->format('d-m-Y') }}>
                                </div>
                            </div>
                            <div class="form-group col-lg-12 mb-4">
                                <label for="" style="width: 100px">Ghi chú</label>
                                <textarea autocomplete="off" placeholder="Nhập ghi chú" name="note" class="form-control bg-white border-md">{{ $import->note }}</textarea>
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
                                        <form action="{{ route('admin.product.store') }}" enctype="multipart/form-data"
                                            method="post">
                                            @csrf
                                            <div>
                                                <input autocomplete="off" type="text" required name="company"
                                                    style="width: 100%" placeholder="Công ty"
                                                    class="form-control bg-white mb-4">
                                                <input autocomplete="off" type="text" required name="address"
                                                    style="width: 100%" placeholder="Địa chỉ"
                                                    class="form-control bg-white mb-4">
                                                <input autocomplete="off" type="text" name="name" required
                                                    placeholder="Người liên hệ" style="width: 100%"
                                                    class="form-control bg-white mb-4">
                                                <input autocomplete="off" type="text" required name="phone_number"
                                                    placeholder="Số điện thoại" style="width: 100%"
                                                    class="form-control bg-white mb-4">

                                                <input autocomplete="off" type="email" name="email"
                                                    style="width: 100%" placeholder="Email"
                                                    class="form-control bg-white mb-4">

                                                <input autocomplete="off" type="text" required name="position"
                                                    style="width: 100%" placeholder="Chức vụ"
                                                    class="form-control bg-white mb-4">
                                                <textarea autocomplete="off" name="note" style="width: 100%" placeholder="Ghi chú"
                                                    class="form-control bg-white mb-4"></textarea>
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
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function() {
            $("#dateInput").datepicker({
                dateFormat: "dd-mm-yy", // Định dạng ngày "dd/mm/yyyy"
                showOtherMonths: true,
                selectOtherMonths: true,
            });
        });
        $(function() {
            $('.selectCustomer').selectize({
                sortField: 'text'
            });

            var value = 0;
        });
        function formatCurrency(input) {
            // Lấy giá trị người dùng đã nhập
            let value = input.value;

            // Loại bỏ tất cả các ký tự không phải số (ví dụ: dấu phẩy, dấu chấm)
            value = value.replace(/[^0-9]/g, '');

            value = parseFloat(value).toLocaleString('vi-VN');

            // Gán giá trị đã định dạng lại vào trường input
            input.value = value;
        }
    </script>
@endsection
