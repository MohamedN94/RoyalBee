@extends('dashboard.layouts.master')
@section('subheader')
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{__('dashboard.sliders')}}</h5>
                <!--end::Page Title-->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{route('dashboard.sliders.create')}}"
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
                        <form action="{{route('dashboard.sliders.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{__('dashboard.title_en')}}
                                                <span class="text-danger">*</span></label>
                                            <input type="text" name="title_en" value="{{old('title_en')}}"
                                                   class="form-control {{$errors->has('title_en')? 'is-invalid':''}}"
                                                   placeholder="{{__('dashboard.enter').' '.__('dashboard.title_en')}}"/>
                                            <span
                                                class="form-text text-danger">{{$errors->has('title_en')? $errors->first("title_en"):''}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{__('dashboard.title_ar')}}
                                                <span class="text-danger">*</span></label>
                                            <input type="text" name="title_ar" value="{{old('title_ar')}}"
                                                   class="form-control {{$errors->has('title_ar')? 'is-invalid':''}}"
                                                   placeholder="{{__('dashboard.enter').' '.__('dashboard.title_ar')}}"/>
                                            <span
                                                class="form-text text-danger">{{$errors->has('title_ar')? $errors->first("title_ar"):''}}</span>
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
                                        <label class="col-form-label" for="image">{{ __('dashboard.image') }}</label>
                                        <span class="text-danger">*</span>
                                        <input
                                            type="file"
                                            class="form-control m-input @error('image') is-invalid @enderror"
                                            name="image"
                                            id="image"
                                        />
                                        @error('image')
                                            <span class="form-text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6 col-12 form-group m-form__group">
                                        <label class="col-form-label" for="image_ar">{{ __('dashboard.image_ar') }}</label>
                                        <span class="text-danger">*</span>
                                        <input
                                            type="file"
                                            class="form-control m-input @error('image_ar') is-invalid @enderror"
                                            name="image_ar"
                                            id="image_ar"
                                        />
                                        @error('image_ar')
                                            <span class="form-text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6 col-12 form-group m-form__group">
                                        <label class="col-form-label" for="mobile_image">{{ __('dashboard.mobile_image') }}</label>
                                        <span class="text-danger">*</span>
                                        <input
                                            type="file"
                                            class="form-control m-input @error('mobile_image') is-invalid @enderror"
                                            name="mobile_image"
                                            id="mobile_image"
                                        />
                                        @error('mobile_image')
                                            <span class="form-text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6 col-12 form-group m-form__group">
                                        <label class="col-form-label" for="mobile_image_ar">{{ __('dashboard.mobile_image_ar') }}</label>
                                        <span class="text-danger">*</span>
                                        <input
                                            type="file"
                                            class="form-control m-input @error('mobile_image_ar') is-invalid @enderror"
                                            name="mobile_image_ar"
                                            id="mobile_image_ar"
                                        />
                                        @error('mobile_image_ar')
                                            <span class="form-text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group row col-md-6">
                                        <label class="col-form-label col-3 text-lg-right text-left">{{ __('dashboard.status') }}</label>
                                        <div class="col-3">
                                            <span class="switch">
                                            <label>
                                            <input type="checkbox" checked="checked" name="status">
                                            <span></span>
                                            </label>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('dashboard.link') }} <span class="text-danger">*</span></label>
                                            <input type="text" name="link" value="{{ old('link') }}" class="form-control {{ $errors->has('link') ? 'is-invalid' : '' }}" placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.link') }}"/>
                                            <span class="form-text text-danger">{{ $errors->has('link') ? $errors->first('link') : '' }}</span>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="card-footer">
                                {!! csrf_field() !!}
                                <button type="submit" class="btn btn-primary mr-2">{{__('dashboard.submit')}}</button>
                                <a href="{{route('dashboard.sliders.index')}}" type="reset" class="btn btn-secondary">{{__('dashboard.cancel')}}</a>
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
