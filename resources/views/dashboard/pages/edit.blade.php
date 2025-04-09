@extends('dashboard.layouts.master')
@section('subheader')
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{ __('dashboard.category') }}</h5>
                <!--end::Page Title-->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{route('dashboard.pages.edit',['page'=>$page->id])}}"
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
                    <div class="card card-custom gutter-b">
                        <!--begin::Form-->
                        <form action="{{ route('dashboard.pages.update', $page->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('dashboard.category') }} <span
                                                    class="text-danger">*</span></label>
                                            <select name="page_type_id"
                                                    class="form-control {{ $errors->has('page_type_id') ? 'is-invalid' : '' }}"
                                                    placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.category') }}">
                                                <option selected
                                                        disabled>{{ __('dashboard.choose-page-type') }}</option>
                                                @foreach($pageTypes as $pageType)
                                                    @php
                                                        $locale = app()->getLocale();
                                                        $localizedName = 'name_' . $locale;
                                                    @endphp
                                                    <option
                                                        value="{{ $pageType->id }}" {{ old('page_type_id', $page->page_type_id ?? '') == $pageType->id ? 'selected' : '' }}>
                                                        {{ $pageType->$localizedName }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('page_type_id'))
                                                <span
                                                    class="form-text text-danger">{{ $errors->first('page_type_id') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{__('dashboard.name_en')}} <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="name_en"
                                                   value="{{ old('name_en', $page->name_en) }}"
                                                   class="form-control {{ $errors->has('name_en') ? 'is-invalid' : '' }}"
                                                   placeholder="{{__('dashboard.enter').' '.__('dashboard.name_en')}}"/>
                                            <span class="form-text text-danger">{{ $errors->first('name_en') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{__('dashboard.name_ar')}} <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="name_ar"
                                                   value="{{ old('name_ar', $page->name_ar) }}"
                                                   class="form-control {{ $errors->has('name_ar') ? 'is-invalid' : '' }}"
                                                   placeholder="{{__('dashboard.enter').' '.__('dashboard.name_ar')}}"/>
                                            <span class="form-text text-danger">{{ $errors->first('name_ar') }}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{__('dashboard.url')}} <span class="text-danger">*</span></label>
                                            <input type="text" name="url" value="{{ old('url', $page->url) }}"
                                                   class="form-control {{ $errors->has('url') ? 'is-invalid' : '' }}"
                                                   placeholder="{{__('dashboard.enter').' '.__('dashboard.url')}}"/>
                                            <span class="form-text text-danger">{{ $errors->first('url') }}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{__('dashboard.description_en')}} <span class="text-danger">*</span></label>
                                            <textarea name="description_en" cols="30" rows="10"
                                                      class="form-control ckeditor lang-en {{ $errors->has('description_en') ? 'is-invalid' : '' }}"
                                                      placeholder="{{__('dashboard.enter').' '.__('dashboard.description_en')}}">{{ old('description_en', $page->description_en) }}</textarea>
                                            <span
                                                class="form-text text-danger">{{ $errors->first('description_en') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{__('dashboard.description_ar')}} <span class="text-danger">*</span></label>
                                            <textarea name="description_ar" cols="30" rows="10"
                                                      class="form-control ckeditor {{ $errors->has('description_ar') ? 'is-invalid' : '' }}"
                                                      placeholder="{{__('dashboard.enter').' '.__('dashboard.description_ar')}}">{{ old('description_ar', $page->description_ar) }}</textarea>
                                            <span
                                                class="form-text text-danger">{{ $errors->first('description_ar') }}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{__('dashboard.order')}}
                                                <span class="text-danger">*</span></label>
                                            <input type="number" name="order" value="{{old('order',$page->order)}}"
                                                   class="form-control {{$errors->has('order')? 'is-invalid':''}}"
                                                   placeholder="{{__('dashboard.enter').' '.__('dashboard.order')}}"/>
                                            <span
                                                class="form-text text-danger">{{$errors->has('order')? $errors->first("order"):''}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary mr-2">{{__('dashboard.update')}}</button>
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
