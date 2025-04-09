@extends('dashboard.layouts.master')
@section('subheader')
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{ __('dashboard.sliders') }}</h5>
                <!--end::Page Title-->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard.sliders.edit', $slider->id) }}"
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

                        <form action="{{ route('dashboard.sliders.update', $slider->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{ __('dashboard.title_en') }} <span class="text-danger">*</span></label>
                                            <input type="text" name="title_en"
                                                value="{{ old('title_en', $slider->title_en) }}"
                                                class="form-control {{ $errors->has('title_en') ? 'is-invalid' : '' }}"
                                                placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.title_en') }}" />
                                            <span
                                                class="form-text text-danger">{{ $errors->has('title_en') ? $errors->first('title_en') : '' }}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{ __('dashboard.title_ar') }} <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="title_ar"
                                                value="{{ old('title_ar', $slider->title_ar) }}"
                                                class="form-control {{ $errors->has('title_ar') ? 'is-invalid' : '' }}"
                                                placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.title_ar') }}" />
                                            <span
                                                class="form-text text-danger">{{ $errors->has('title_ar') ? $errors->first('title_ar') : '' }}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{ __('dashboard.description_en') }} <span
                                                    class="text-danger">*</span></label>
                                            <textarea name="description_en" cols="30" rows="10"
                                                class="form-control ckeditor lang-en {{ $errors->has('description_en') ? 'is-invalid' : '' }}"
                                                placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.description_en') }}">{{ old('description_en', $slider->description_en) }}</textarea>
                                            <span
                                                class="form-text text-danger">{{ $errors->has('description_en') ? $errors->first('description_en') : '' }}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{ __('dashboard.description_ar') }} <span
                                                    class="text-danger">*</span></label>
                                            <textarea name="description_ar" cols="30" rows="10"
                                                class="form-control ckeditor {{ $errors->has('description_ar') ? 'is-invalid' : '' }}"
                                                placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.description_ar') }}">{{ old('description_ar', $slider->description_ar) }}</textarea>
                                            <span
                                                class="form-text text-danger">{{ $errors->has('description_ar') ? $errors->first('description_ar') : '' }}</span>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="col-form-label" for="images">{{ __('dashboard.image') }}
                                                    <span class="text-danger">*</span></label>
                                                <input type="file"
                                                    class="form-control m-input {{ $errors->has('image') ? 'is-invalid' : '' }}"
                                                    name="image" id="images" />
                                                <span
                                                    class="form-text text-danger">{{ $errors->has('image') ? $errors->first('image') : '' }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <img src="{{ asset($slider->image) }}" class="loaded-image" alt="logo"
                                                style="display: {{ $slider->image ? 'inline-block' : 'none' }}; width: 100px; margin: 10px 100px;">
                                        </div>
                                    </div>

                                    <div class="row col-md-6">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-form-label" for="images_ar">{{ __('dashboard.image_ar') }}
                                                    <span class="text-danger">*</span></label>
                                                <input type="file"
                                                    class="form-control m-input {{ $errors->has('image_ar') ? 'is-invalid' : '' }}"
                                                    name="image_ar" id="images_ar" />
                                                <span
                                                    class="form-text text-danger">{{ $errors->has('image_ar') ? $errors->first('image_ar') : '' }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <img src="{{ asset($slider->image_ar) }}" class="loaded-image" alt="logo"
                                                style="display: {{ $slider->image_ar ? 'inline-block' : 'none' }}; width: 100px; margin: 10px 100px;">
                                        </div>
                                    </div>


                                    <div class="row col-md-6">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-form-label"
                                                    for="mobile_image">{{ __('dashboard.mobile_image') }}
                                                    <span class="text-danger">*</span></label>
                                                <input type="file"
                                                    class="form-control m-input {{ $errors->has('mobile_image') ? 'is-invalid' : '' }}"
                                                    name="mobile_image" id="mobile_image" />
                                                <span
                                                    class="form-text text-danger">{{ $errors->has('mobile_image') ? $errors->first('mobile_image') : '' }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <img src="{{ asset($slider->mobile_image) }}" class="loaded-image"
                                                alt="logo"
                                                style="display: {{ $slider->mobile_image ? 'inline-block' : 'none' }}; width: 100px; margin: 10px 100px;">
                                        </div>
                                    </div>

                                    <div class="row col-md-6">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-form-label"
                                                    for="mobile_image_ar">{{ __('dashboard.mobile_image_ar') }}
                                                    <span class="text-danger">*</span></label>
                                                <input type="file"
                                                    class="form-control m-input {{ $errors->has('mobile_image_ar') ? 'is-invalid' : '' }}"
                                                    name="mobile_image_ar" id="mobile_image_ar" />
                                                <span
                                                    class="form-text text-danger">{{ $errors->has('mobile_image_ar') ? $errors->first('mobile_image_ar') : '' }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <img src="{{ asset($slider->mobile_image_ar) }}" class="loaded-image"
                                                alt="logo"
                                                style="display: {{ $slider->mobile_image_ar ? 'inline-block' : 'none' }}; width: 100px; margin: 10px 100px;">
                                        </div>
                                    </div>

                                    <div class="form-group row col-md-6">
                                        <label class="col-form-label col-3 text-lg-right text-left">{{ __('dashboard.status') }}</label>
                                        <div class="col-3">
                                            <span class="switch">
                                            <label>
                                            <input type="checkbox" name="status" {{ old('status', $slider->status) ? 'checked' : '' }}>
                                            <span></span>
                                            </label>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('dashboard.link') }}
                                                <span class="text-danger">*</span></label>
                                            <input type="text" name="link" value="{{ old('link', $slider->link) }}"
                                                class="form-control {{ $errors->has('link') ? 'is-invalid' : '' }}"
                                                placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.link') }}" />
                                            <span
                                                class="form-text text-danger">{{ $errors->has('link') ? $errors->first('link') : '' }}</span>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary mr-2">{{ __('dashboard.update') }}</button>
                                <a href="{{ route('dashboard.sliders.index') }}"
                                    class="btn btn-secondary">{{ __('dashboard.cancel') }}</a>
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
        document.addEventListener('DOMContentLoaded', function() {
            var categoryDropdown = document.getElementById('categoryDropdown');
            var orderInputContainer = document.getElementById('orderInputContainer');

            checkInitialValue();

            categoryDropdown.addEventListener('change', function() {
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
