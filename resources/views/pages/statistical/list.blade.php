@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

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

                    <form action="{{route('admin.statistical.search')}}" method="GET" role="search">
                        <div class="search-container" style="display: flex">
                            <div class="search-item">
                                <p>Từ ngày</p>
                                <input style="width: 100%;" type="date" name="dateFrom"
                                    value={{ request()->get('dateFrom') }}>
                            </div>
                            <div class="search-item">
                                <p>Đến ngày</p>
                                <input style="width: 100%;" type="date" name="dateTo"
                                    value={{ request()->get('dateTo') }}>
                            </div>
                            <div class="search-btn" style="margin-left: 30px;margin-top: 43px">
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
                                    <th colspan="7" style="text-align: center"
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

                                        {{ $totalCaptan }}</th>
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
                                        {{$revenue}}
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
                                        {{$profit}}
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center border">

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
                                        Tồn đầu
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

                                        </td>
                                        <td class="border">
                                            {{ $result['quanity_import'] }}
                                        </td>
                                        <td class="border">
                                            {{ $result['quanity_export'] }}
                                        </td>
                                        <td class="border">
                                            <p class="text-sm font-weight-bold mb-0"></p>
                                        </td>
                                        <td class="border">
                                            {{ $result['quanity_export'] * $result['average_price_import'] }}
                                        </td>
                                        <td class="border">
                                            {{ $result['quanity_export'] * $result['average_price_export'] }}
                                        </td>
                                        <td class="border">
                                            {{ $result['quanity_export'] * $result['average_price_export'] - $result['quanity_export'] * $result['average_price_import'] }}
                                        </td>
                                        <td class="border">
                                            <p class="text-sm font-weight-bold mb-0">
                                                <input disabled style="border: none; width: 100px; background-color: white"
                                                    class="price" type="text" id="price_{{}}"
                                                    value="">
                                            </p>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4 mb-4" style=" display: flex; justify-content: center;">
                            {{-- {!! $exports->links() !!} --}}
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
