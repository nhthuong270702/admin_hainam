@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Quản lý sản phẩm'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 header-table">
                    <h5>Sản phẩm</h5>
                    <a href="{{ route('admin.product.create') }}" class="add-action"><i class="ni ni-fat-add"></i></a>
                </div>
                @if (session('msg'))
                    <div class="text-center notification">
                        <p class="msg-noti">{{ session('msg') }}</p>
                    </div>
                @endif
                <div class="card-header pb-0 search">

                    <form action="{{ route('admin.product.search') }}" method="GET" role="search">
                        <div class="search-container" style="display: flex">
                            <div class="search-form" style="width: 400px; margin-right: 30px">
                                <input autocomplete="off" style="width: 100%; height: fit-content;" type="text"
                                    placeholder="Tên, nhà sản xuất, giá, thời hạn bảo hành" name="infos"
                                    value="{{ request()->get('infos') }}">
                            </div>
                            <div class="search-btn" style="display: flex; gap: 10px">
                                <button style="margin: 0" type="submit">Tìm kiếm</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Mã sản
                                        phẩm</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Tên sản phẩm
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Đơn vị tính
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-3 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $product->code }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $product->name }}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $product->unit }}</p>
                                        </td>
                                        <td class="align-middle text-end">
                                            <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                                                <a class="btn btn-xs btn-primary mt-3" style="margin-right: 5px"
                                                    href="{{ route('admin.product.edit', $product->id) }}">Sửa</a>
                                                <a class="btn btn-xs btn-danger mt-3"
                                                    onclick="return confirm('Bạn có chắc muốn xoá không?');"
                                                    href="{{ route('admin.product.delete', $product->id) }}">Xóa</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4 mb-4" style=" display: flex; justify-content: center;">
                            {!! $products->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
