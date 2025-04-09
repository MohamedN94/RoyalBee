@extends('dashboard.layouts.master')
@section('subheader')
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{__('dashboard.Information')}}</h5>
                <!--end::Page Title-->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{route('dashboard.Information.edit',['Information'=>$Information->id])}}"
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
                        <form action="{{route('dashboard.Information.update',['Information'=>$Information->id])}}" method="POST"
                              enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">

                                    {{-- -------------------------------- --}}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{ __('dashboard.phone') }}
                                                <span class="text-danger">*</span></label>
                                            <input type="text" name="phone" value="{{$Information->phone??old('phone')}}"
                                                class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                                                placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.name') }}" />
                                            <span
                                                class="form-text text-danger">{{ $errors->has('about_ar') ? $errors->first('about_ar') : '' }}</span>
                                        </div>
                                        <div class="form-group">
                                            <label>{{ __('dashboard.about_ar') }}
                                                <span class="text-danger">*</span></label>
                                            <input type="text" name="about_ar" value="{{$Information->about_ar??old('about_ar')}}"
                                                class="form-control {{ $errors->has('about_ar') ? 'is-invalid' : '' }}"
                                                placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.name') }}" />
                                            <span
                                                class="form-text text-danger">{{ $errors->has('about_ar') ? $errors->first('about_ar') : '' }}</span>
                                        </div>
                                        <div class="form-group">
                                            <label>{{ __('dashboard.about_en') }}
                                                <span class="text-danger">*</span></label>
                                            <input type="text" name="about_en" value="{{$Information->about_en??old('about_en')}}"
                                                class="form-control {{ $errors->has('about_en') ? 'is-invalid' : '' }}"
                                                placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.name') }}" />
                                            <span
                                                class="form-text text-danger">{{ $errors->has('about_en') ? $errors->first('about_en') : '' }}</span>
                                        </div>
                                        <div class="form-group">
                                            <label>{{ __('dashboard.address_ar') }}
                                                <span class="text-danger">*</span></label>
                                            <input type="text" name="address_ar" value="{{ $Information->address_ar??old('address_ar') }}"
                                                class="form-control {{ $errors->has('address_ar') ? 'is-invalid' : '' }}"
                                                placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.name') }}" />
                                            <span
                                                class="form-text text-danger">{{ $errors->has('address_ar') ? $errors->first('address_ar') : '' }}</span>
                                        </div>
                                        <div class="form-group">
                                            <label>{{ __('dashboard.address_en') }}
                                                <span class="text-danger">*</span></label>
                                            <input type="text" name="address_en" value="{{ $Information->address_en??old('address_en') }}"
                                                class="form-control {{ $errors->has('address_en') ? 'is-invalid' : '' }}"
                                                placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.name') }}" />
                                            <span
                                                class="form-text text-danger">{{ $errors->has('address_en') ? $errors->first('address_en') : '' }}</span>
                                        </div>
                                        <div class="form-group">
                                            <label>{{ __('dashboard.email') }}
                                                <span class="text-danger">*</span></label>
                                            <input type="email" name="email" value="{{ $Information->email??old('email') }}"
                                                class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                                placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.name') }}" />
                                            <span
                                                class="form-text text-danger">{{ $errors->has('email') ? $errors->first('email') : '' }}</span>
                                        </div>
                                        <div class="form-group">
                                            <label>{{ __('dashboard.supportNumber') }}
                                                <span class="text-danger">*</span></label>
                                            <input type="tel" name="support_number" value="{{ $Information->support_number??old('support_number') }}"
                                                class="form-control {{ $errors->has('support_number') ? 'is-invalid' : '' }}"
                                                placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.supportNumber') }}" />
                                            <span
                                                class="form-text text-danger">{{ $errors->has('support_number') ? $errors->first('support_number') : '' }}</span>
                                        </div>

                                        <div class="form-group">
                                            <label>{{ __('dashboard.facebook') }}
                                                <span class="text-danger">*</span></label>
                                            <input type="tel" name="facebook" value="{{ $Information->facebook??old('facebook') }}"
                                                class="form-control {{ $errors->has('facebook') ? 'is-invalid' : '' }}"
                                                placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.facebook') }}" />
                                            <span
                                                class="form-text text-danger">{{ $errors->has('facebook') ? $errors->first('facebook') : '' }}</span>
                                        </div>
                                        <div class="form-group">
                                            <label>{{ __('dashboard.twitter') }}
                                                <span class="text-danger">*</span></label>
                                            <input type="tel" name="twitter" value="{{ $Information->twitter??old('twitter') }}"
                                                class="form-control {{ $errors->has('twitter') ? 'is-invalid' : '' }}"
                                                placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.twitter') }}" />
                                            <span
                                                class="form-text text-danger">{{ $errors->has('twitter') ? $errors->first('twitter') : '' }}</span>
                                        </div>
                                        <div class="form-group">
                                            <label>{{ __('dashboard.linkedIn') }}
                                                <span class="text-danger">*</span></label>
                                            <input type="tel" name="linkedIn" value="{{ $Information->linkedIn??old('linkedIn') }}"
                                                class="form-control {{ $errors->has('linkedIn') ? 'is-invalid' : '' }}"
                                                placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.linkedIn') }}" />
                                            <span
                                                class="form-text text-danger">{{ $errors->has('linkedIn') ? $errors->first('linkedIn') : '' }}</span>
                                        </div>

                                        <div class="form-group">
                                            <label>{{ __('dashboard.instagram') }}
                                                <span class="text-danger">*</span></label>
                                            <input type="tel" name="instagram" value="{{ $Information->instagram??old('instagram') }}"
                                                class="form-control {{ $errors->has('instagram') ? 'is-invalid' : '' }}"
                                                placeholder="{{ __('dashboard.enter') . ' ' . __('dashboard.instagram') }}" />
                                            <span
                                                class="form-text text-danger">{{ $errors->has('instagram') ? $errors->first('instagram') : '' }}</span>
                                        </div>

                                    </div>

                                    <div class="col-sm-6 col-12 form-group m-form__group">
                                        <label class="col-form-label" for="logo">{{ __('dashboard.header_image') }}</label>
                                        <input type="file" class="form-control m-input" name="logo" id="images" />
                                    </div>
                                    <div class="col-sm-3 col-12 form-group m-form__group">
                                        <img style="width: 100%" src="{{ asset($Information->header_image) }}" />
                                    </div>

                                    <div class="col-sm-6 col-12 form-group m-form__group">
                                        <label class="col-form-label" for="logo2">{{ __('dashboard.footer_image') }}</label>
                                        <input type="file" class="form-control m-input" name="logo2" id="images" />
                                    </div>
                                    <div class="col-sm-3 col-12 form-group m-form__group">
                                        <img style="width: 100%" src="{{ asset($Information->footer_image) }}" />
                                    </div>
                                    <div class="col-sm-6 col-12 form-group m-form__group">
                                        <label class="col-form-label" for="video">{{ __('dashboard.video') }}</label>
                                        <input type="file" class="form-control m-input" name="video" id="video" />
                                    </div>
                                    <div class="col-sm-3 col-12 form-group m-form__group">
                                        <img style="width: 100%" src="{{ asset($Information->video) }}" />
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
