@extends('dashboard.layouts.master')
@section('subheader')
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{__('dashboard.coupons')}}</h5>
                <!--end::Page Title-->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{route('dashboard.coupons.create')}}"
                           class="text-muted">{{__('dashboard.create')}}</a>
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
                        <form action="{{route('dashboard.coupons.store')}}" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{__('dashboard.code')}}
                                                <span class="text-danger">*</span></label>
                                            <input type="text" name="code" value="{{old('code')}}"
                                                   class="form-control {{$errors->has('code')? 'is-invalid':''}}"
                                                   placeholder="{{__('dashboard.enter').' '.__('dashboard.code')}}"/>
                                            <span
                                                class="form-text text-danger">{{$errors->has('code')? $errors->first("code"):''}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{__('dashboard.discount_code')}}
                                                <span class="text-danger">*</span></label>
                                            <input type="text" name="discount" value="{{old('discount')}}"
                                                   class="form-control {{$errors->has('discount')? 'is-invalid':''}}"
                                                   placeholder="{{__('dashboard.enter').' '.__('dashboard.discount_code')}}"/>
                                            <span
                                                class="form-text text-danger">{{$errors->has('discount')? $errors->first("discount"):''}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{__('dashboard.type')}} <span class="text-danger">*</span></label>
                                            <select name="type" class="form-control {{$errors->has('type')? 'is-invalid':''}}">
                                                <option value="" disabled selected>{{__('dashboard.select_type')}}</option>
                                                <option value="fixed" {{ old('type') == 'fixed' ? 'selected' : '' }}>{{__('dashboard.fixed')}}</option>
                                                <option value="percentage" {{ old('type') == 'percentage' ? 'selected' : '' }}>{{__('dashboard.percentage')}}</option>
                                            </select>
                                            <span class="form-text text-danger">{{$errors->has('type')? $errors->first("type"):''}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{__('dashboard.expiry_date')}} <span class="text-danger">*</span></label>
                                            <input type="date" name="expiry_date" value="{{old('expiry_date')}}"
                                                   class="form-control {{$errors->has('expiry_date')? 'is-invalid':''}}"
                                                   placeholder="{{__('dashboard.enter').' '.__('dashboard.expiry_date')}}"/>
                                            <span class="form-text text-danger">{{$errors->has('expiry_date')? $errors->first("expiry_date"):''}}</span>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="card-footer">
                                {!! csrf_field() !!}
                                <button type="submit" class="btn btn-primary mr-2">{{__('dashboard.submit')}}</button>
                                <button type="reset" class="btn btn-secondary">{{__('dashboard.cancel')}}</button>
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
@endsection
