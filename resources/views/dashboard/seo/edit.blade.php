@extends('dashboard.layouts.master')
@section('subheader')
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{ __('dashboard.Seo') }}</h5>
                <!--end::Page Title-->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard.SEO.edit', ['SEO' => $SEO->id]) }}"
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
                        <form action="{{ route('dashboard.SEO.update', ['SEO'=>$SEO->id]) }}"
                            method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">

                                    {{-- -------------------------------- --}}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{ __('dashboard.pages') }}
                                                <span class="text-danger">*</span></label>
                                            <input type="text" name="page_title"
                                                value="{{ $SEO->page_title ?? old('page_title') }}"
                                                class="form-control {{ $errors->has('page_title') ? 'is-invalid' : '' }}"
                                                placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.name') }}" />
                                            <span
                                                class="form-text text-danger">{{ $errors->has('page_title') ? $errors->first('page_title') : '' }}</span>
                                        </div>

                                    </div>

                                    {{-- meta Data --}}
                                    <div class="col-md-12 form-group m-form__group">

                                        <div class="form-group">
                                            <label>{{ __('dashboard.meta_title') }}
                                                <span class="text-danger">*</span></label>
                                            <input type="text" name="meta_title"  value="{{ $SEO->meta_title??old('meta_title') }}"
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
                                                        placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.meta_description') }}">{{$SEO->meta_description}}</textarea>
                                                <span
                                                    class="form-text text-danger">{{ $errors->has('meta_description') ? $errors->first('meta_description') : '' }}</span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>{{ __('dashboard.meta_canonical') }}
                                                <span class="text-danger">*</span></label>
                                            <input type="text" name="meta_canonical"  value="{{ $SEO->meta_canonical??old('meta_canonical') }}"
                                                class="form-control {{ $errors->has('meta_canonical') ? 'is-invalid' : '' }}"
                                                placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.meta_canonical') }}" />
                                            <span
                                                class="form-text text-danger">{{ $errors->has('meta_canonical') ? $errors->first('meta_canonical') : '' }}</span>
                                        </div>

                                        <div class="form-group">
                                            <label>{{ __('dashboard.meta_opengraph') }}
                                                <span class="text-danger">*</span></label>
                                            <input type="text" name="meta_opengraph"  value="{{ $SEO->meta_opengraph??old('meta_opengraph') }}"
                                                class="form-control {{ $errors->has('meta_opengraph') ? 'is-invalid' : '' }}"
                                                placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.meta_opengraph') }}" />
                                            <span
                                                class="form-text text-danger">{{ $errors->has('meta_opengraph') ? $errors->first('meta_opengraph') : '' }}</span>
                                        </div>

                                        <div class="form-group">
                                            <label>{{ __('dashboard.meta_property') }}
                                                <span class="text-danger">*</span></label>
                                            <input type="text" name="meta_property"  value="{{ $SEO->meta_property??old('meta_property') }}"
                                                class="form-control {{ $errors->has('meta_property') ? 'is-invalid' : '' }}"
                                                placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.meta_property') }}" />
                                            <span
                                                class="form-text text-danger">{{ $errors->has('meta_property') ? $errors->first('meta_property') : '' }}</span>
                                        </div>

                                        <div class="form-group">
                                            <label>{{ __('dashboard.meta_twitter') }}
                                                <span class="text-danger">*</span></label>
                                            <input type="text" name="meta_twitter"  value="{{ $SEO->meta_twitter??old('meta_twitter') }}"
                                                class="form-control {{ $errors->has('meta_twitter') ? 'is-invalid' : '' }}"
                                                placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.meta_twitter') }}" />
                                            <span
                                                class="form-text text-danger">{{ $errors->has('meta_twitter') ? $errors->first('meta_twitter') : '' }}</span>
                                        </div>

                                        <div class="col-sm-6 col-12 form-group m-form__group">
                                            <label class="col-form-label" for="meta_jsonLd">{{ __('dashboard.meta_jsonLd') }}</label>
                                            <input type="file" class="form-control m-input" name="meta_jsonLd" id="icon" />
                                        </div>
                                        <div class="col-sm-3 col-12 form-group m-form__group">
                                            <img style="width: 100%" src="{{ asset($SEO->meta_jsonLd) }}" />
                                            <span
                                                class="form-text text-danger">{{ $errors->has('meta_jsonLd') ? $errors->first('meta_jsonLd') : '' }}</span>
                                        </div>

                                        <div class="form-group">
                                            <label>{{ __('dashboard.meta_Keyword') }}
                                                <span class="text-danger">*</span></label>
                                            <input type="text" name="meta_Keyword"  value="{{ $SEO->meta_Keyword??old('meta_Keyword') }}"
                                                class="form-control {{ $errors->has('meta_Keyword') ? 'is-invalid' : '' }}"
                                                placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.meta_Keyword') }}" />
                                            <span
                                                class="form-text text-danger">{{ $errors->has('meta_Keyword') ? $errors->first('meta_Keyword') : '' }}</span>
                                        </div>

                                    </div>

                                    {{-- <div class="col-sm-6 col-12 form-group m-form__group">
                                        <label class="col-form-label" for="icon">{{ __('dashboard.icon') }}</label>
                                        <input type="file" class="form-control m-input" name="icon" id="icon" />
                                    </div>
                                    <div class="col-sm-3 col-12 form-group m-form__group">
                                        <img style="width: 100%" src="{{ asset($Information->icon) }}" />
                                    </div> --}}
                                    {{-- -------------------------------- --}}
                                </div>
                            </div>
                            <div class="card-footer">
                                {{ method_field('PUT') }}
                                {!! csrf_field() !!}
                                <button type="submit" class="btn btn-primary mr-2">{{ __('dashboard.submit') }}</button>
                                <a href="{{route('dashboard.SEO.index')}}" class="btn btn-secondary">{{ __('dashboard.cancel') }}</a>
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
