@extends('dashboard.layouts.master')
@section('subheader')
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{__('dashboard.categories')}}</h5>
                <!--end::Page Title-->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{route('dashboard.Categories.create')}}"
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
                        <form action="{{route('dashboard.Categories.store')}}" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{__('dashboard.name_en')}}
                                                <span class="text-danger">*</span></label>
                                            <input type="text" name="name_en" value="{{old('name_en')}}"
                                                   class="form-control {{$errors->has('name_en')? 'is-invalid':''}}"
                                                   placeholder="{{__('dashboard.enter').' '.__('dashboard.name_en')}}"/>
                                            <span
                                                class="form-text text-danger">{{$errors->has('name_en')? $errors->first("name_en"):''}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{__('dashboard.name_ar')}}
                                                <span class="text-danger">*</span></label>
                                            <input type="text" name="name_ar" value="{{old('name_ar')}}"
                                                   class="form-control {{$errors->has('name_ar')? 'is-invalid':''}}"
                                                   placeholder="{{__('dashboard.enter').' '.__('dashboard.name_ar')}}"/>
                                            <span
                                                class="form-text text-danger">{{$errors->has('name_ar')? $errors->first("name_ar"):''}}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{__('dashboard.description_en')}}
                                                <span class="text-danger">*</span></label>
                                            <textarea type="text" name="description_en" cols="30" rows="10"
                                                      class="form-control ckeditor lang-en {{$errors->has('description_en')? 'is-invalid':''}}"
                                                      placeholder="{{__('dashboard.enter').' '.__('dashboard.description_en')}}">
                                                {{old('description_en')}}
                                            </textarea>

                                            <span
                                                class="form-text text-danger">{{$errors->has('description_en')? $errors->first("description_en"):''}}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{__('dashboard.description_ar')}}
                                                <span class="text-danger">*</span></label>
                                            <textarea type="text" name="description_ar" cols="30" rows="10"
                                                      class="form-control ckeditor  {{$errors->has('description_ar')? 'is-invalid':''}}"
                                                      placeholder="{{__('dashboard.enter').' '.__('dashboard.description_ar')}}">
                                                {{old('description_ar')}}
                                            </textarea>

                                            <span
                                                class="form-text text-danger">{{$errors->has('description_ar')? $errors->first("description_ar"):''}}</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-12 form-group m-form__group">
                                        <label class="col-form-label" for="images">{{ __('dashboard.image') }}</label>
                                        <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control m-input {{ $errors->has('image') ? 'is-invalid' : '' }}" name="image" id="images"  />
                                        <span
                                            class="form-text text-danger">{{ $errors->has('image') ? $errors->first('image') : '' }}</span>
                                    </div>

                                    <div class="col-sm-6 col-12 form-group m-form__group">
                                        <label class="col-form-label" for="images">{{ __('dashboard.banner_image') }}</label>
                                        <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control m-input {{ $errors->has('banner_image') ? 'is-invalid' : '' }}" name="banner_image" id="banner_images"  />
                                        <span
                                            class="form-text text-danger">{{ $errors->has('banner_image') ? $errors->first('banner_image') : '' }}</span>
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
