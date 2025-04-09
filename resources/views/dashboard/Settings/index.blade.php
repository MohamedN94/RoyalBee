@extends('dashboard.layouts.master')
@section('subheader')
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{__('dashboard.settings')}}</h5>
                <!--end::Page Title-->
            </div>
            <!--end::Info-->
        </div>
    </div>
@endsection
@section('content')
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            @if (session()->has('status'))
                @include('dashboard.includes.alerts', [
                    'message' => session()->get('message'),
                    'alert_class' => 'success',
                ])
            @endif
            <div class="row">
                <div class="col-md-12">
                    <!--begin::Card-->
                    <div class="card card-custom gutter-b ">
                        <!--begin::Form-->
                        <form action="{{route('dashboard.settings.update')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row">

                                    {{-- -------------------------------- --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('dashboard.app-name') }}
                                                <span class="text-danger">*</span></label>
                                            <input type="text" name="store_name"
                                                   value="{{setting('store_name') ?? old('store_name')}}"
                                                   class="form-control {{ $errors->has('store_name') ? 'is-invalid' : '' }}"
                                                   placeholder="{{ __('dashboard.enter-store_name') }}"/>
                                            <span
                                                class="form-text text-danger">{{ $errors->has('store_name') ? $errors->first('store_name') : '' }}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('dashboard.store-description') }}
                                                <span class="text-danger">*</span></label>
                                            <textarea name="store_description"
                                                      class="form-control ckeditor {{ $errors->has('store_description') ? 'is-invalid' : '' }}"
                                                      placeholder="{{ __('dashboard.enter-store_description') }}">
                                                   {{setting('store_description') ?? old('store_description')}}
                                            </textarea>
                                            <span
                                                class="form-text text-danger">{{ $errors->has('store_description') ? $errors->first('store_description') : '' }}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('dashboard.store-description_en') }}
                                                <span class="text-danger">*</span></label>
                                            <textarea name="store_description_en"
                                                      class="form-control ckeditor {{ $errors->has('store_description_en') ? 'is-invalid' : '' }}"
                                                      placeholder="{{ __('dashboard.enter-store_description_en') }}">
                                                   {{setting('store_description_en') ?? old('store_description_en')}}
                                            </textarea>
                                            <span
                                                class="form-text text-danger">{{ $errors->has('store_description_en') ? $errors->first('store_description_en') : '' }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12 form-group m-form__group">
                                        <label class="col-form-label" for="logo">{{ __('dashboard.image') }}</label>
                                        <input type="file" class="form-control m-input" name="logo" id="images" />
                                    </div>

                                    <div class="col-sm-3 col-12 form-group m-form__group">
                                        <img style="width: 100%" src="{{ asset(setting('logo')) }}" />
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('dashboard.instagram') }}
                                                <span class="text-danger">*</span></label>
                                            <input type="text" name="instagram"
                                                   value="{{setting('instagram') ?? old('instagram')}}"
                                                   class="form-control {{ $errors->has('instagram') ? 'is-invalid' : '' }}"
                                                   placeholder="{{ __('dashboard.enter-instagram') }}"/>
                                            <span
                                                class="form-text text-danger">{{ $errors->has('instagram') ? $errors->first('instagram') : '' }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('dashboard.whatsapp') }}
                                                <span class="text-danger">*</span></label>
                                            <input type="text" name="whatsapp"
                                                   value="{{setting('whatsapp') ?? old('whatsapp')}}"
                                                   class="form-control {{ $errors->has('whatsapp') ? 'is-invalid' : '' }}"
                                                   placeholder="{{ __('dashboard.enter-whatsapp')}}"/>
                                            <span
                                                class="form-text text-danger">{{ $errors->has('whatsapp') ? $errors->first('whatsapp') : '' }}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('dashboard.facebook') }}
                                                <span class="text-danger">*</span></label>
                                            <input type="text" name="facebook"
                                                   value="{{setting('facebook') ?? old('facebook')}}"
                                                   class="form-control {{ $errors->has('facebook') ? 'is-invalid' : '' }}"
                                                   placeholder="{{ __('dashboard.enter-facebook')  }}"/>
                                            <span
                                                class="form-text text-danger">{{ $errors->has('facebook') ? $errors->first('facebook') : '' }}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('dashboard.youtube') }}
                                                <span class="text-danger">*</span></label>
                                            <input type="text" name="youtube"
                                                   value="{{setting('youtube') ?? old('youtube')}}"
                                                   class="form-control {{ $errors->has('youtube') ? 'is-invalid' : '' }}"
                                                   placeholder="{{ __('dashboard.enter-youtube')  }}"/>
                                            <span
                                                class="form-text text-danger">{{ $errors->has('youtube') ? $errors->first('youtube') : '' }}</span>
                                        </div>
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
