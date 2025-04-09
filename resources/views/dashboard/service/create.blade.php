@extends('dashboard.layouts.master')
@section('subheader')
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{ __('dashboard.service') }}</h5>
                <!--end::Page Title-->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard.Services.create') }}"
                            class="text-muted">{{ __('dashboard.create') }}</a>
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
                        <form action="{{ route('dashboard.Services.store') }}" method="POST"
                            enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{ __('dashboard.title_ar') }}
                                                <span class="text-danger">*</span></label>
                                            <input type="text" name="title_ar" value="{{ old('title_ar') }}"
                                                class="form-control {{ $errors->has('title_ar') ? 'is-invalid' : '' }}"
                                                placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.name') }}" />
                                            <span
                                                class="form-text text-danger">{{ $errors->has('title_ar') ? $errors->first('title_ar') : '' }}</span>
                                        </div>
                                        <div class="form-group">
                                            <label>{{ __('dashboard.title_en') }}
                                                <span class="text-danger">*</span></label>
                                            <input type="text" name="title_en" value="{{ old('title_en') }}"
                                                class="form-control {{ $errors->has('title_en') ? 'is-invalid' : '' }}"
                                                placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.name') }}" />
                                            <span
                                                class="form-text text-danger">{{ $errors->has('title_en') ? $errors->first('title_en') : '' }}</span>
                                        </div>
                                        <div class="form-group">
                                            <label>{{ __('dashboard.short_description_ar') }}
                                                <span class="text-danger">*</span></label>
                                            <input type="text" name="short_description_ar" value="{{ old('short_description_ar') }}"
                                                class="form-control {{ $errors->has('short_description_ar') ? 'is-invalid' : '' }}"
                                                placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.name') }}" />
                                            <span
                                                class="form-text text-danger">{{ $errors->has('short_description_ar') ? $errors->first('short_description_ar') : '' }}</span>
                                        </div>
                                        <div class="form-group">
                                            <label>{{ __('dashboard.short_description_en') }}
                                                <span class="text-danger">*</span></label>
                                            <input type="text" name="short_description_en" value="{{ old('short_description_en') }}"
                                                class="form-control {{ $errors->has('short_description_en') ? 'is-invalid' : '' }}"
                                                placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.name') }}" />
                                            <span
                                                class="form-text text-danger">{{ $errors->has('short_description_en') ? $errors->first('short_description_en') : '' }}</span>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>{{ __('dashboard.description_ar') }}
                                                    <span class="text-danger">*</span></label>
                                                    <textarea id="description" name="description_ar" id="" cols="30" rows="10"
                                                        class="form-control  {{ $errors->has('description_ar') ? 'is-invalid' : '' }}"
                                                        placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.description_ar') }}"></textarea>
                                                <span
                                                    class="form-text text-danger">{{ $errors->has('description_ar') ? $errors->first('description_ar') : '' }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>{{ __('dashboard.description_en') }}
                                                    <span class="text-danger">*</span></label>
                                                    <textarea id="description2" name="description_en" id="" cols="30" rows="10"
                                                        class="form-control  {{ $errors->has('description_en') ? 'is-invalid' : '' }}"
                                                        placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.description_en') }}"></textarea>
                                                <span
                                                    class="form-text text-danger">{{ $errors->has('description_en') ? $errors->first('description_en') : '' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{ __('dashboard.categories') }}
                                                <span class="text-danger">*</span></label>
                                            <select name="category_id" id="categoryDropdown"
                                                class="form-control {{ $errors->has('category_id') ? 'is-invalid' : '' }}">
                                                {{-- <option value="">{{ __('dashboard.main') }}</option> --}}
                                                @forelse ($categories as $value)
                                                    <option value="{{ $value->id }}"
                                                        {{ old('category_id') == $value->id ? 'selected' : '' }}>
                                                        {{ App::getLocale() == 'ar' ? $value->name_ar : $value->name_en }}
                                                    </option>
                                                @empty
                                                @endforelse
                                            </select>
                                            <span
                                                class="form-text text-danger">{{ $errors->has('category_id') ? $errors->first('category_id') : '' }}</span>
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
                                        <label class="col-form-label" for="icon">{{ __('dashboard.icon') }}</label>
                                        <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control m-input {{ $errors->has('icon') ? 'is-invalid' : '' }}" name="icon" id="icon"  />
                                        <span
                                        class="form-text text-danger">{{ $errors->has('icon') ? $errors->first('icon') : '' }}</span>
                                    </div>
                                    <div class="col-md-12 form-group m-form__group">

                                        <div class="form-group">
                                            <label>{{ __('dashboard.meta_title') }}
                                                <span class="text-danger">*</span></label>
                                            <input type="text" name="meta_title" value="{{ old('meta_title') }}"
                                                class="form-control {{ $errors->has('meta_title') ? 'is-invalid' : '' }}"
                                                placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.meta_title') }}" />
                                            <span
                                                class="form-text text-danger">{{ $errors->has('meta_title') ? $errors->first('meta_title') : '' }}</span>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>{{ __('dashboard.meta_description') }}
                                                    <span class="text-danger">*</span></label>
                                                    <textarea id="description" name="meta_description" id="" cols="30" rows="10"
                                                        class="form-control  {{ $errors->has('meta_description') ? 'is-invalid' : '' }}"
                                                        placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.meta_description') }}"></textarea>
                                                <span
                                                    class="form-text text-danger">{{ $errors->has('meta_description') ? $errors->first('meta_description') : '' }}</span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>{{ __('dashboard.meta_canonical') }}
                                                <span class="text-danger">*</span></label>
                                            <input type="text" name="meta_canonical" value="{{ old('meta_canonical') }}"
                                                class="form-control {{ $errors->has('meta_canonical') ? 'is-invalid' : '' }}"
                                                placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.meta_canonical') }}" />
                                            <span
                                                class="form-text text-danger">{{ $errors->has('meta_canonical') ? $errors->first('meta_canonical') : '' }}</span>
                                        </div>

                                        <div class="form-group">
                                            <label>{{ __('dashboard.meta_opengraph') }}
                                                <span class="text-danger">*</span></label>
                                            <input type="text" name="meta_opengraph" value="{{ old('meta_opengraph') }}"
                                                class="form-control {{ $errors->has('meta_opengraph') ? 'is-invalid' : '' }}"
                                                placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.meta_opengraph') }}" />
                                            <span
                                                class="form-text text-danger">{{ $errors->has('meta_opengraph') ? $errors->first('meta_opengraph') : '' }}</span>
                                        </div>

                                        <div class="form-group">
                                            <label>{{ __('dashboard.meta_property') }}
                                                <span class="text-danger">*</span></label>
                                            <input type="text" name="meta_property" value="{{ old('meta_property') }}"
                                                class="form-control {{ $errors->has('meta_property') ? 'is-invalid' : '' }}"
                                                placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.meta_property') }}" />
                                            <span
                                                class="form-text text-danger">{{ $errors->has('meta_property') ? $errors->first('meta_property') : '' }}</span>
                                        </div>

                                        <div class="form-group">
                                            <label>{{ __('dashboard.meta_twitter') }}
                                                <span class="text-danger">*</span></label>
                                            <input type="text" name="meta_twitter" value="{{ old('meta_twitter') }}"
                                                class="form-control {{ $errors->has('meta_twitter') ? 'is-invalid' : '' }}"
                                                placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.meta_twitter') }}" />
                                            <span
                                                class="form-text text-danger">{{ $errors->has('meta_twitter') ? $errors->first('meta_twitter') : '' }}</span>
                                        </div>

                                        <div class="form__group">
                                            <label class="col-form-label" for="icon">{{ __('dashboard.meta_jsonLd') }}</label>
                                            <span class="text-danger">*</span></label>
                                            <input type="file" class="form-control m-input {{ $errors->has('meta_jsonLd') ? 'is-invalid' : '' }}" name="meta_jsonLd" id="meta_jsonLd"  />
                                            <span
                                            class="form-text text-danger">{{ $errors->has('meta_jsonLd') ? $errors->first('meta_jsonLd') : '' }}</span>
                                        </div>

                                        <div class="form-group">
                                            <label>{{ __('dashboard.meta_Keyword') }}
                                                <span class="text-danger">*</span></label>
                                            <input type="text" name="meta_Keyword" value="{{ old('meta_Keyword') }}"
                                                class="form-control {{ $errors->has('meta_Keyword') ? 'is-invalid' : '' }}"
                                                placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.meta_Keyword') }}" />
                                            <span
                                                class="form-text text-danger">{{ $errors->has('meta_Keyword') ? $errors->first('meta_Keyword') : '' }}</span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                {!! csrf_field() !!}
                                <button type="submit" class="btn btn-primary mr-2">{{ __('dashboard.submit') }}</button>
                                <button type="reset" class="btn btn-secondary">{{ __('dashboard.cancel') }}</button>
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
    <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        ClassicEditor
            .create(document.querySelector('#description2'))
            .catch(error => {
                console.error(error);
            });
    </script>

@endsection
