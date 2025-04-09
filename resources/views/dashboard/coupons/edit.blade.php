@extends('dashboard.layouts.master')
@section('subheader')
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{ __('dashboard.coupon') }}</h5>
                <!--end::Page Title-->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{route('dashboard.coupons.edit',['coupon'=>$Coupon->id])}}"
                           class="text-muted">{{ __('dashboard.edit') }}</a>
                    </li>
                </ul>
            </div>
            <!--end::Info-->
        </div>
    </div>
@endsection
@section('content')
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!--begin::Card-->
                    <div class="card card-custom gutter-b ">
                        <!--begin::Form-->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('dashboard.coupons.update', ['coupon' => $Coupon->id]) }}"
                              method="POST"
                              enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{ __('dashboard.code') }}
                                                <span class="text-danger">*</span></label>
                                            <input type="text" name="code"
                                                   value="{{ $Coupon->code ?? old('code') }}"
                                                   class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}"
                                                   placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.code') }}"/>
                                            <span
                                                class="form-text text-danger">{{ $errors->has('code') ? $errors->first('code') : '' }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{ __('dashboard.discount_code') }}
                                                <span class="text-danger">*</span></label>
                                            <input type="text" name="discount"
                                                   value="{{ $Coupon->discount ?? old('discount') }}"
                                                   class="form-control {{ $errors->has('discount') ? 'is-invalid' : '' }}"
                                                   placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.discount_code') }}"/>
                                            <span
                                                class="form-text text-danger">{{ $errors->has('discount') ? $errors->first('discount') : '' }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{ __('dashboard.type') }}
                                                <span class="text-danger">*</span></label>
                                            <select name="type"
                                                    class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}">
                                                <option value="" disabled selected>{{ __('dashboard.enter') . ' ' . __('dashboard.type') }}</option>
                                                <option value="fixed" {{ (isset($Coupon->type) && $Coupon->type == 'fixed') || old('type') == 'fixed' ? 'selected' : '' }}>
                                                    {{ __('dashboard.fixed') }}
                                                </option>
                                                <option value="percentage" {{ (isset($Coupon->type) && $Coupon->type == 'percentage') || old('type') == 'percentage' ? 'selected' : '' }}>
                                                    {{ __('dashboard.percentage') }}
                                                </option>
                                            </select>
                                            <span class="form-text text-danger">{{ $errors->has('type') ? $errors->first('type') : '' }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{ __('dashboard.expiry_date') }}
                                                <span class="text-danger">*</span></label>
                                            <input type="date" name="expiry_date"
                                                   value="{{ $Coupon->expiry_date ?? old('expiry_date') }}"
                                                   class="form-control {{ $errors->has('expiry_date') ? 'is-invalid' : '' }}"
                                                   placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.expiry_date') }}"/>
                                            <span class="form-text text-danger">{{ $errors->has('expiry_date') ? $errors->first('expiry_date') : '' }}</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="card-footer">
                                {{ method_field('PUT') }}
                                {!! csrf_field() !!}
                                <button type="submit" class="btn btn-primary mr-2">{{ __('dashboard.submit') }}</button>
                                <a href="{{route('dashboard.Categories.index')}}" class="btn btn-secondary">{{ __('dashboard.cancel') }}</a>
                            </div>
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Card-->
                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var categoryDropdown = document.getElementById('categoryDropdown');
            var orderInputContainer = document.getElementById('orderInputContainer');

            checkInitialValue();

            categoryDropdown.addEventListener('change', function () {
                checkInitialValue();
            });

            function checkInitialValue() {
                var selectedValue = categoryDropdown.value;

                if (selectedValue === '') {
                    orderInputContainer.style.display = 'block'; // Show the input field
                } else {
                    orderInputContainer.style.display = 'none'; // Hide the input field
                }
            }
        });
    </script>

@endsection
