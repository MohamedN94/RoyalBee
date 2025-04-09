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
                        <a href="{{route('dashboard.Categories.edit',['Category'=>$Category->id])}}"
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

                        <form action="{{ route('dashboard.Categories.update', ['Category' => $Category->id]) }}"
                              method="POST"
                              enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{ __('dashboard.name_en') }}
                                                <span class="text-danger">*</span></label>
                                            <input type="text" name="name_en"
                                                   value="{{ $Category->name_en ?? old('name_en') }}"
                                                   class="form-control {{ $errors->has('name_en') ? 'is-invalid' : '' }}"
                                                   placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.name_en') }}"/>
                                            <span
                                                class="form-text text-danger">{{ $errors->has('name_en') ? $errors->first('name_en') : '' }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{ __('dashboard.name_ar') }}
                                                <span class="text-danger">*</span></label>
                                            <input type="text" name="name_ar"
                                                   value="{{ $Category->name_ar ?? old('name_ar') }}"
                                                   class="form-control {{ $errors->has('name_ar') ? 'is-invalid' : '' }}"
                                                   placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.name_ar') }}"/>
                                            <span
                                                class="form-text text-danger">{{ $errors->has('name_ar') ? $errors->first('name_ar') : '' }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{__('dashboard.description_en')}} <span class="text-danger">*</span></label>
                                            <textarea name="description_en" cols="30" rows="10"
                                                      class="form-control ckeditor lang-en {{ $errors->has('description_en') ? 'is-invalid' : '' }}"
                                                      placeholder="{{__('dashboard.enter').' '.__('dashboard.description_en')}}">{{ old('description_en', $Category->description_en) }}</textarea>
                                            <span class="form-text text-danger">{{ $errors->first('description_en') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{__('dashboard.description_ar')}} <span class="text-danger">*</span></label>
                                            <textarea name="description_ar" cols="30" rows="10"
                                                      class="form-control ckeditor {{ $errors->has('description_ar') ? 'is-invalid' : '' }}"
                                                      placeholder="{{__('dashboard.enter').' '.__('dashboard.description_ar')}}">{{ old('description_ar', $Category->description_ar) }}</textarea>
                                            <span class="form-text text-danger">{{ $errors->first('description_ar') }}</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-12 form-group m-form__group">
                                        <label class="col-form-label" for="images">{{ __('dashboard.image') }}</label>
                                        <input type="file" class="form-control m-input" name="image" id="images"/>
                                    </div>
                                    <div class="col-sm-3 col-12 form-group m-form__group">
                                        <img style="width: 100%" src="{{ asset($Category->image) }}"/>
                                    </div>

                                    <div class="col-sm-6 col-12 form-group m-form__group">
                                        <label class="col-form-label" for="images">{{ __('dashboard.banner_image') }}</label>
                                        <input type="file" class="form-control m-input" name="banner_image" id="banner_image"/>
                                    </div>
                                    <div class="col-sm-3 col-12 form-group m-form__group">
                                        <img style="width: 100%" src="{{ asset($Category->banner_image) }}"/>
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
