@extends('dashboard.layouts.master')
@section('subheader')
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{__('dashboard.users')}}</h5>
                <!--end::Page Title-->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{route('dashboard.users.edit',['user'=>$user->id])}}"
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
                        <form action="{{route('dashboard.users.update',['user'=>$user->id])}}" method="POST"
                              enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{__('dashboard.name')}}
                                                <span class="text-danger">*</span></label>
                                            <input type="text" name="name" value="{{$user->name??old('name')}}"
                                                   class="form-control {{$errors->has('name')? 'is-invalid':''}}"
                                                   placeholder="{{__('dashboard.enter').' '.__('dashboard.name')}}"/>
                                            <span
                                                class="form-text text-danger">{{$errors->has('name')? $errors->first("name"):''}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{__('dashboard.email')}}
                                                <span class="text-danger">*</span></label>
                                            <input type="email" name="email" value="{{$user->email??old('email')}}"
                                                   class="form-control {{$errors->has('email')? 'is-invalid':''}}"
                                                   placeholder="{{__('dashboard.enter').' '.__('dashboard.email')}}"/>
                                            <span
                                                class="form-text text-danger">{{$errors->has('email')? $errors->first("email"):''}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{__('dashboard.role')}}

                                                <span class="text-danger">*</span></label>
                                            <select name="role_id"
                                                    class="form-control {{$errors->has('role_id')? 'is-invalid':''}}">
                                                <option value="">{{__('dashboard.select')}}</option>
                                                @if($roles->count())
                                                    @foreach($roles as $role)
                                                        <option value="{{$role->id}}"
                                                        @if($user->roles->count())
                                                            {{$user->roles->first()->id==$role->id?'selected':''}}
                                                            @endif>
                                                            @if(App::getLocale()=='ar')
                                                                {{$role->name_ar??'-'}}
                                                            @else
                                                                {{$role->name??'-'}}
                                                            @endif</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <span
                                                class="form-text text-danger">{{$errors->has('role_id')? $errors->first("role_id"):''}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{__('dashboard.password')}}
                                            </label>
                                            <input type="password" name="password"
                                                   class="form-control {{$errors->has('password')? 'is-invalid':''}}"
                                                   placeholder="{{__('dashboard.enter').' '.__('dashboard.password')}}"/>
                                            <span
                                                class="form-text text-danger">{{$errors->has('password')? $errors->first("password"):''}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{__('dashboard.password_confirmation')}}</label>
                                            <input type="password" name="password_confirmation"
                                                   class="form-control {{$errors->has('password_confirmation')? 'is-invalid':''}}"
                                                   placeholder="{{__('dashboard.enter').' '.__('dashboard.password_confirmation')}}"/>
                                            <span
                                                class="form-text text-danger">{{$errors->has('password_confirmation')? $errors->first("password_confirmation"):''}}</span>
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
