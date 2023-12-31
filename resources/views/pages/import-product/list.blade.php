@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Quản lý nhập hàng'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 header-table">
                    <h5>Quản lý nhập hàng</h5>
                    <a href="{{ route('admin.import-product.create') }}" class="add-action"><i class="ni ni-fat-add"></i></a>
                </div>
                @if (session('msg'))
                    <div class="text-center notification">
                        <p class="msg-noti">{{ session('msg') }}</p>
                    </div>
                @endif
                <div class="card-header pb-0 search">
                    <form action="{{ route('admin.import-product.search') }}" method="GET">
                        <div class="search-container" style="display: flex">
                            <div class="search-form" style="width: 400px; margin-right: 30px">
                                <input autocomplete="off" style="width: 100%; height: fit-content;" type="text"
                                    placeholder="Tên, mã sản phẩm, nhà cung ứng" name="infos"
                                    value="{{ request()->get('infos') }}">
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
                                <tr class="border">
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 border">
                                        Ngày nhập
                                    </th>
                                    {{-- <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 border ps-2">
                                        Chứng từ
                                    </th> --}}
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 border ps-2">
                                        Mã hàng
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 border ps-2">
                                        Tên sản phẩm
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 border ps-2">
                                        ĐVT
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 border ps-2">
                                        Số lượng
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 border ps-2">
                                        Giá nhập
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 border ps-2">
                                        Thành tiền
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 border ps-2">
                                        Nhà cung ứng
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 border ps-2">
                                        Ghi chú
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 border">
                                        Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($imports))
                                    @foreach ($imports as $import)
                                        <tr class="border">
                                            <td class="border">
                                                <div class="d-flex px-3 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">
                                                            {{ \Carbon\Carbon::parse($import->date)->format('d/m/Y') }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            {{-- <td class="border">
                                            <p class="text-sm font-weight-bold mb-0">{{ $import->document }}</p>
                                        </td> --}}
                                            <td class="border">
                                                <p class="text-sm font-weight-bold mb-0">{{ $import->product->code }}</p>
                                            </td>
                                            <td class="border">
                                                <p class="text-sm font-weight-bold mb-0">{{ $import->product->name }}</p>
                                            </td>
                                            <td class="border">
                                                <p class="text-sm font-weight-bold mb-0">{{ $import->product->unit }}</p>
                                            </td>
                                            <td class="border">
                                                <p class="text-sm font-weight-bold mb-0">
                                                    <input disabled
                                                        style="border: none; width: 100px; background-color: white"
                                                        type="text" value="{{ intval($import->quanity) }}">
                                                </p>
                                            </td>
                                            <td class="border">
                                                <p class="text-sm font-weight-bold mb-0">
                                                    <input disabled
                                                        style="border: none; width: 100px; background-color: white"
                                                        class="price" type="text"
                                                        value="{{ number_format(intval($import->price), 0, ',', '.') }}đ">
                                                </p>
                                            </td>
                                            <td class="border">
                                                <p class="text-sm font-weight-bold mb-0">
                                                    <input disabled
                                                        style="border: none; width: 100px; background-color: white"
                                                        class="total" type="text"
                                                        value="{{ number_format(intval($import->quanity) * intval($import->price), 0, ',', '.') }}đ">
                                                </p>
                                            </td>
                                            <td class="border">
                                                <p class="text-sm font-weight-bold mb-0">{{ $import->supplier }}</p>
                                            </td>
                                            <td class="border">
                                                <p class="text-sm font-weight-bold mb-0">{{ $import->note }}</p>
                                            </td>
                                            <td class="align-middle text-end">
                                                <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                                                    <a class="btn btn-xs btn-primary mt-3" style="margin-right: 5px"
                                                        href="{{ route('admin.import-product.edit', $import->id) }}">Sửa</a>
                                                    <a class="btn btn-xs btn-danger mt-3"
                                                        onclick="return confirm('Bạn có chắc muốn xoá không?');"
                                                        href="{{ route('admin.import-product.delete', $import->id) }}">Xóa</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                @endif
                            </tbody>
                        </table>
                        <div class="mt-4 mb-4" style=" display: flex; justify-content: center;">
                            {!! $imports->appends($_GET)->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
