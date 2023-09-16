@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('title', 'Cập nhật sản phẩm')
<link rel="stylesheet" href="{{ asset('assets/css/uploadImage.css') }}">
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Cập nhật sản phẩm'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4" style="padding-left: 20px">
                <div class="mt-4 mb-2">
                    <h5>Cập nhật sản phẩm</h5>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive">
                        <form action="{{ route('admin.product.update', $product->id) }}" method="post" class="form-add"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group col-lg-12 mb-4">
                                <label for="">Mã sản phẩm</label>
                                <input autocomplete="off" width="80%" required type="text" name="code"
                                    value="{{ $product->code }}" class="form-control bg-white border-left-0 border-md">
                                @if ($errors->has('code'))
                                    <i class="error">{{ $errors->first('code') }}</i>
                                @endif
                            </div>
                            <div class="form-group col-lg-12 mb-4">
                                <label for="">Tên sản phẩm</label>
                                <input autocomplete="off" width="80%" required type="text" name="name"
                                    value="{{ $product->name }}" class="form-control bg-white border-left-0 border-md">
                                @if ($errors->has('name'))
                                    <i class="error">{{ $errors->first('name') }}</i>
                                @endif
                            </div>
                            <div class="form-group col-lg-12 mb-4">
                                <label for="">Đơn vị tính</label>
                                <input autocomplete="off" width="80%" required type="text" name="unit"
                                    value="{{ $product->unit }}" class="form-control bg-white border-left-0 border-md">
                                @if ($errors->has('unit'))
                                    <i class="error">{{ $errors->first('unit') }}</i>
                                @endif
                            </div>
                            <div class="form-group col-lg-12 mx-auto mb-0">
                                <button class="btn btn-success" type="submit">Lưu lại</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
