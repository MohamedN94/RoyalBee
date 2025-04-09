@extends('dashboard.layouts.master')
@section('subheader')
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{ __('dashboard.contact') }}</h5>
                <!--end::Page Title-->
                {{-- <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard.Services.create') }}"
                            class="text-muted">{{ __('dashboard.create') }}</a>
                    </li>
                </ul> --}}
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
                        {{-- <form action="{{ route('dashboard.Services.store') }}" method="POST"
                            enctype="multipart/form-data"> --}}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{ __('dashboard.name') }}
                                                <span class="text-danger">*</span></label>
                                            <input type="text" name="name" value="{{ $contact->name }}"
                                                class="form-control" readonly/>
                                        </div>
                                        <div class="form-group">
                                            <label>{{ __('dashboard.email') }}
                                                <span class="text-danger">*</span></label>
                                            <input type="text" name="name" value="{{ $contact->email }}"
                                                class="form-control" readonly/>
                                        </div>
                                        <div class="form-group">
                                            <label>{{ __('dashboard.phone') }}
                                                <span class="text-danger">*</span></label>
                                            <input type="text" name="name" value="{{ $contact->phone_number }}"
                                                class="form-control" readonly/>
                                        </div>
                                        <div class="form-group">
                                            <label>{{ __('dashboard.title') }}
                                                <span class="text-danger">*</span></label>
                                            <input type="text" name="name" value="{{ $contact->msg_subject }}"
                                                class="form-control" readonly/>
                                        </div>
                                        <div class="form-group">
                                            <label>{{ __('dashboard.description') }}
                                                <span class="text-danger">*</span></label>
                                            <textarea name="meta_description"  class="form-control" name="" id="" cols="30" rows="10" readonly>{{ $contact->message }}</textarea>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            {{-- <div class="card-footer">
                                {!! csrf_field() !!}
                                <button type="submit" class="btn btn-primary mr-2">{{ __('dashboard.submit') }}</button>
                                <button type="reset" class="btn btn-secondary">{{ __('dashboard.cancel') }}</button>
                            </div> --}}
                        {{-- </form> --}}
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
