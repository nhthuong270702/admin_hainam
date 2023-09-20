@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Quản lý xuất hàng'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 header-table">
                    <h5>Quản lý xuất hàng</h5>
                    <a href="{{ route('admin.export-product.create') }}" class="add-action"><i class="ni ni-fat-add"></i></a>
                </div>
                @if (session('msg'))
                    <div class=notification">
                        <p class="msg-noti">{{ session('msg') }}</p>
                    </div>
                @endif
                <div class="card-header pb-0 search">

                    <form action="{{ route('admin.export-product.search') }}" method="GET" role="search">
                        <div class="search-container" style="display: flex">
                            <div class="search-form" style="width: 400px; margin-right: 30px">
                                <input autocomplete="off" style="width: 100%; height: fit-content;" type="text"
                                    placeholder="Tên, mã sản phẩm" name="infos" value="{{ request()->get('infos') }}">
                            </div>
                            <div class="search-btn" style="display: flex; gap: 10px">
                                <button style="margin: 0; border: none" type="submit">Tìm kiếm</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0 border">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Ngày xuất
                                    </th>
                                    {{-- <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 border">
                                        Chứng từ
                                    </th> --}}
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 border">
                                        Mã hàng
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 border">
                                        Tên sản phẩm
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 border">
                                        ĐVT
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 border">
                                        Số lượng
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 border">
                                        Giá xuất
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 border border">
                                        Thành tiền
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 border">
                                        Tên người mua
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 border">
                                        Ghi chú
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 border">
                                        Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($exports as $export)
                                    <tr>
                                        <td class="border">
                                            <div class="d-flex px-3 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $export->date }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        {{-- <td class="border">
                                            <p class="text-sm font-weight-bold mb-0">{{ $export->document }}</p>
                                        </td> --}}
                                        <td class="border">
                                            <p class="text-sm font-weight-bold mb-0">{{ $export->product->code }}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $export->product->name }}</p>
                                        </td>
                                        <td class="border">
                                            <p class="text-sm font-weight-bold mb-0">{{ $export->product->unit }}</p>
                                        </td>
                                        <td class="border">
                                            <p class="text-sm font-weight-bold mb-0">
                                                <input disabled style="border: none; width: 100px; background-color: white"
                                                    class="quantity" type="text" id="quanity_{{ $loop->index }}"
                                                    value="{{ $export->quanity }}">
                                            </p>
                                        </td>
                                        <td class="border">
                                            <p class="text-sm font-weight-bold mb-0">
                                                <input disabled style="border: none; width: 100px; background-color: white"
                                                    class="price" type="text" id="price_{{ $loop->index }}"
                                                    value="{{ number_format($export->price, 0, '', '.') }} đ">
                                            </p>
                                        </td>
                                        <td class="border">
                                            <p class="text-sm font-weight-bold mb-0">
                                                <input disabled style="border: none; width: 100px; background-color: white"
                                                    class="total" type="text" id="total_{{ $loop->index }}"
                                                    value="{{ number_format($export->quanity * $export->price, 0, ',', '.') }}đ">
                                            </p>
                                        </td>
                                        <td class="border">
                                            <p class="text-sm font-weight-bold mb-0">{{ $export->buyer_name }}</p>
                                        </td>
                                        <td class="border">
                                            <p class="text-sm font-weight-bold mb-0">{{ $export->note }}</p>
                                        </td>
                                        <td class="align-middle text-end">
                                            <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                                                <a class="btn btn-xs btn-primary mt-3" style="margin-right: 5px"
                                                    href="{{ route('admin.export-product.edit', $export->id) }}">Sửa</a>
                                                <a class="btn btn-xs btn-danger mt-3"
                                                    onclick="return confirm('Bạn có chắc muốn xoá không?');"
                                                    href="{{ route('admin.export-product.delete', $export->id) }}">Xóa</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4 mb-4" style=" display: flex; justify-content: center;">
                            {!! $exports->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            var quantityInputs = document.querySelectorAll(".quantity");
            var priceInputs = document.querySelectorAll(".price");
            var totalInputs = document.querySelectorAll(".total");


            for (var i = 0; i < quantityInputs.length; i++) {
                var quantity = parseFloat(quantityInputs[i].value) || 0;
                var price = parseFloat(priceInputs[i].value) || 0;

                var total = quantity * price;

                totalInputs[i].value = total;
            }

        });
    </script> --}}
@endsection
