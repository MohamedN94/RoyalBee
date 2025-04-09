@extends('dashboard.layouts.master')
@section('subheader')
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{__('dashboard.roles')}}</h5>
                <!--end::Page Title-->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{route('dashboard.roles.create')}}" class="text-muted">{{__('dashboard.create')}}</a>
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
                        <form action="{{route('dashboard.roles.store')}}" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label>{{__('dashboard.name_en')}}: <span style="color: red">*</span></label>
                                        <input type="text"
                                               name="name"
                                               value="{{ old("name") }}"
                                               class="form-control {{ $errors->has("name") ? 'is-invalid' : '' }}"
                                               placeholder="{{__('dashboard.enter').' '.__('dashboard.name_en')}}">
                                        <span class="form-text text-danger {{ $errors->has("name") ? 'error' : '' }}">
                                        {{ $errors->has("name") ? $errors->first("name") : '' }}
                                </span>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>{{__('dashboard.name_ar')}}: <span style="color: red">*</span></label>
                                        <input type="text"
                                               name="name_ar"
                                               value="{{ old("name_ar") }}"
                                               class="form-control {{ $errors->has("name_ar") ? 'is-invalid' : '' }}"
                                               placeholder="{{__('dashboard.enter').' '.__('dashboard.name_ar')}}">
                                        <span class="form-text text-danger {{ $errors->has("name_ar") ? 'error' : '' }}">
                                        {{ $errors->has("name_ar") ? $errors->first("name_ar") : '' }}
                                </span>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>{{__('dashboard.label')}} :</label>
                                        <input type="text"
                                               name="label"
                                               value="{{ old("label") }}"
                                               class="form-control {{ $errors->has("label") ? 'is-invalid' : '' }}"
                                               placeholder="{{__('dashboard.enter').' '.__('dashboard.label')}}">
                                        <span class="form-text text-danger  {{ $errors->has("label") ? 'error' : '' }}">
                                        {{ $errors->has("label") ? $errors->first("label") : ''}}
                                </span>
                                    </div>
                                    @foreach($permissions as $model => $permission)
                                        @if(str_contains($model , 'language') !== true)
                                            <div class=" col-lg-3">
                                                <label class="col-form-label">
                                                    {{ __('dashboard.'.ucfirst($model)) }}
                                                </label>
                                                <select
                                                    class="form-control kt_select2_selector kt-select2 {{ $errors->has("permissions") ? 'is-invalid' : '' }}"
                                                    id="kt_select2_{{ $model }}" name="permissions[]"
                                                    multiple="multiple">
                                                    @foreach($permission as $operation)
                                                        <option value="{{ $operation->id }}"
                                                            {{ in_array($operation->id,old('permissions') ?? [])
                                                                ? 'selected' : ''
                                                                }}>{{__('dashboard.'.explode(' ',$operation->label)[0]) ?? '' }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endif
                                    @endforeach
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
@section('scripts')
    <script>
        $('.kt_select2_selector').select2({
            placeholder: '{{__('dashboard.select')}}'
        });
    </script>
@endsection
