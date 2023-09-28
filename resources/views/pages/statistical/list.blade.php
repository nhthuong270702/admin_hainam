@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

<script src="{{ asset('js/orders/jquery.min.js') }}"></script>
<script src="{{ asset('js/orders/selectize.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/orders/selectize.bootstrap3.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/orders/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/uploadImage.css') }}">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tổng hợp nhập xuất tồn'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 header-table">
                    <h5>Tổng hợp nhập xuất tồn</h5>
                </div>
                @if (session('msg'))
                    <div class="notification">
                        <p class="msg-noti">{{ session('msg') }}</p>
                    </div>
                @endif
                <div class="card-header pb-0 search">

                    <form action="{{ route('admin.statistical.search') }}" method="GET" role="search">
                        <div class="search-container" style="display: flex; flex-wrap: wrap; gap: 20px">
                            <div class="search-item">
                                <p>Từ ngày</p>
                                {{-- <input required style="width: 200px;" type="date" name="dateFrom"
                                    value={{ request()->get('dateFrom') }}> --}}
                                    <input style="cursor: pointer"  autocomplete="off" required type="text"
                                        placeholder="Nhập ngày nhập hàng" name="dateFrom"
                                        class="form-control bg-white border-md dateInput" id="dateInput1" value={{ request()->get('dateFrom') }}>
                            </div>
                            <div class="search-item">
                                <p>Đến ngày</p>
                                {{-- <input required style="width: 200px;" type="date" name="dateTo"
                                    value={{ request()->get('dateTo') }}> --}}
                                <input style="cursor: pointer" autocomplete="off" required type="text"
                                    placeholder="Nhập ngày nhập hàng" name="dateTo"
                                    class="form-control bg-white border-md dateInput" id="dateInput2" value={{ request()->get('dateTo') }} >
                            </div>
                            <div class="search-btn" style="margin-top: 43px">
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
                                    <th colspan="6" style="text-align: center"
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 border">
                                        Tổng
                                    </th>
                                    @php
                                        $totalCaptan = 0;
                                    @endphp

                                    @foreach ($results as $result)
                                        @php
                                            $totalCaptan += $result['quanity_export'] * $result['average_price_import'];
                                        @endphp
                                    @endforeach
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                        {{ number_format($totalCaptan, 0, ',', '.') }}đ</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center border">
                                        @php
                                            $revenue = 0;
                                        @endphp

                                        @foreach ($results as $result)
                                            @php
                                                $revenue += $result['quanity_export'] * $result['average_price_export'];
                                            @endphp
                                        @endforeach
                                        {{ number_format($revenue, 0, ',', '.') }}đ
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center border">
                                        @php
                                            $profit = 0;
                                        @endphp

                                        @foreach ($results as $result)
                                            @php
                                                $profit += $result['quanity_export'] * $result['average_price_export'] - $result['quanity_export'] * $result['average_price_import'];
                                            @endphp
                                        @endforeach
                                        {{ number_format($profit, 0, ',', '.') }}đ

                                    </th>
                                </tr>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Mã hàng
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 border">
                                        Tên quy cách
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 border">
                                        ĐVT
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 border">
                                        Nhập trong kỳ
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 border">
                                        Xuất trong kỳ
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 border">
                                        Tồn cuối kỳ
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 border border">
                                        Giá vốn
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 border">
                                        Doanh thu
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 border">
                                        Lãi lỗ
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 border">
                                        Ghi chú
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($results as $result)
                                    <tr>
                                        <td class="border">
                                            {{ $result['code'] }}
                                        </td>
                                        <td class="border">
                                            {{ $result['product_name'] }}
                                        </td>
                                        <td class="border">
                                            {{ $result['unit'] }}
                                        </td>
                                        <td class="border">
                                            {{ $result['quanity_import'] }}
                                        </td>
                                        <td class="border">
                                            {{ $result['quanity_export'] }}
                                        </td>
                                        <td class="border">
                                            {{ $result['quanity_import'] - $result['quanity_export'] }}
                                        </td>
                                        <td class="border">
                                            {{ number_format($result['quanity_export'] * $result['average_price_import'], 0, ',', '.') }}đ
                                        </td>
                                        <td class="border">
                                            {{ number_format($result['quanity_export'] * $result['average_price_export'], 0, ',', '.') }}đ
                                        </td>
                                        <td class="border">
                                            {{ number_format($result['quanity_export'] * $result['average_price_export'] - $result['quanity_export'] * $result['average_price_import'], 0, ',', '.') }}đ

                                        </td>
                                        <td class="border">
                                            <p class="text-sm font-weight-bold mb-0">
                                                <input disabled style="border: none; width: 100px; background-color: white"
                                                    class="price" type="text" value="">
                                            </p>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <input hidden id="data" value="{{ $results }}">
                        <div class="mt-4 mb-4" style=" display: flex; justify-content: center;">
                            {{-- {!! $exports->links() !!} --}}
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
            $("#dateInput1").datepicker({
                dateFormat: "dd-mm-yy", // Định dạng ngày "dd/mm/yyyy"
                showOtherMonths: true,
                selectOtherMonths: true,
            });
        });
        $(function() {
            $("#dateInput2").datepicker({
                dateFormat: "dd-mm-yy", // Định dạng ngày "dd/mm/yyyy"
                showOtherMonths: true,
                selectOtherMonths: true,
            });
        });
    </script>
@endsection
