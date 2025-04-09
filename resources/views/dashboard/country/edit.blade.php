@extends('dashboard.layouts.master')
@section('subheader')
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{__('dashboard.pages')}}</h5>
                <!--end::Page Title-->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{route('dashboard.countries.edit',['country'=>$country->id])}}"
                           class="text-muted">{{__('dashboard.edit')}}</a>
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
                        <form action="{{route('dashboard.countries.update',['country'=>$country->id])}}" method="POST"
                              enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{__('dashboard.name_ar')}}
                                                <span class="text-danger">*</span></label>
                                            <input type="text" name="name_ar" value="{{$country->name_ar??old('name_ar')}}"
                                                   class="form-control {{$errors->has('name_ar')? 'is-invalid':''}}"
                                                   placeholder="{{__('dashboard.enter').' '.__('dashboard.name_ar')}}"/>
                                            <span
                                                class="form-text text-danger">{{$errors->has('name_ar')? $errors->first("name_ar"):''}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{__('dashboard.name_en')}}
                                                <span class="text-danger">*</span></label>
                                            <input type="text" name="name_en" value="{{$country->name_en??old('name_en')}}"
                                                   class="form-control {{$errors->has('name_en')? 'is-invalid':''}}"
                                                   placeholder="{{__('dashboard.enter').' '.__('dashboard.name_en')}}"/>
                                            <span
                                                class="form-text text-danger">{{$errors->has('name_en')? $errors->first("name_en"):''}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{__('dashboard.code')}}
                                                <span class="text-danger">*</span></label>
                                            <input type="text" name="code" value="{{$country->code??old('code')}}"
                                                   class="form-control {{$errors->has('code')? 'is-invalid':''}}"
                                                   placeholder="{{__('dashboard.enter').' '.__('dashboard.code')}}"/>
                                            <span
                                                class="form-text text-danger">{{$errors->has('code')? $errors->first("code"):''}}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12 form-group m-form__group">
                                        <label class="col-form-label" for="images">{{ __('dashboard.image') }}</label>
                                        <input type="file" class="form-control m-input" name="image" id="images"/>
                                    </div>
                                    <div class="col-sm-3 col-12 form-group m-form__group">
                                        <img style="width: 100%" src="{{ asset($country->image) }}"/>
                                    </div>

                                    
                                </div>
                            </div>
                            <div class="card-footer">
                                {{method_field('PUT')}}
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
