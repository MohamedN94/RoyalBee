@extends('dashboard.layouts.master')
@section('styles')
@endsection
@section('subheader')
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{ __('dashboard.dashboard') }}</h5>
                <!--end::Page Title-->
            </div>
            <!--end::Info-->
        </div>
    </div>
@endsection
@section('content')
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="row">
                @if(isset($Users))
                <div class="col-lg-3 mb-5">
                    <div class="card mini-stat"><a>
                            <div class="card-body mini-stat-img">
                                <div class="mini-stat-icon">
                                    <i class="la la-user bg-soft-primary text-primary float-right"
                                        style="font-size: 5rem;"></i>
                                </div>
                                <h6 class="text-uppercase mb-3 mt-0"> {{ __('dashboard.users') }}</h6>
                                <h4 class="mb-3"> {{ $Users }}</h4>
                            </div>
                        </a>

                    </div>
                </div>
                @endif
                {{-- @if(isset($country))
                <div class="col-lg-3 mb-5">
                    <div class="card mini-stat"><a>
                            <div class="card-body mini-stat-img">
                                <div class="mini-stat-icon">
                                    <i class="la la-flag-o bg-soft-primary text-primary float-right"
                                        style="font-size: 5rem;"></i>
                                </div>
                                <h6 class="text-uppercase mb-3 mt-0">{{ __('dashboard.Country') }} </h6>
                                <h4 class="mb-3">{{ $country }}</h4>
                            </div>
                        </a>

                    </div>
                </div>
                @endif
                @if(isset($candidates))
                <div class="col-lg-3 mb-5">
                    <div class="card mini-stat"><a>
                            <div class="card-body mini-stat-img">
                                <div class="mini-stat-icon">
                                    <i class="la la-group bg-soft-primary text-primary float-right"
                                        style="font-size: 5rem;"></i>
                                </div>
                                <h6 class="text-uppercase mb-3 mt-0"> {{ __('dashboard.Voter') }}</h6>
                                <h4 class="mb-3">{{ $candidates }}</h4>
                            </div>
                        </a>

                    </div>
                </div>
                @endif
                @if(isset($delegates))
                <div class="col-lg-3 mb-5">
                    <div class="card mini-stat"><a>
                            <div class="card-body mini-stat-img">
                                <div class="mini-stat-icon">
                                    <i class="la la-group bg-soft-primary text-primary float-right"
                                        style="font-size: 5rem;"></i>
                                </div>
                                <h6 class="text-uppercase mb-3 mt-0">{{ __('dashboard.Delegate') }}</h6>
                                <h4 class="mb-3">{{ $delegates }}</h4>
                            </div>
                        </a>

                    </div>
                </div>
                @endif
                @if(isset($voters))
                <div class="col-lg-3 mb-5">
                    <div class="card mini-stat"><a>
                            <div class="card-body mini-stat-img">
                                <div class="mini-stat-icon">
                                    <i class="la la-group bg-soft-primary text-primary float-right"
                                        style="font-size: 5rem;"></i>
                                </div>
                                <h6 class="text-uppercase mb-3 mt-0">{{ __('dashboard.Member') }}</h6>
                                <h4 class="mb-3">{{ $voters }}</h4>
                            </div>
                        </a>

                    </div>
                </div>
                @endif
                @if(isset($collections))
                <div class="col-lg-3 mb-5">
                    <div class="card mini-stat"><a>
                            <div class="card-body mini-stat-img">
                                <div class="mini-stat-icon">
                                    <i class="la la-user-times bg-soft-primary text-primary float-right"
                                        style="font-size: 5rem;"></i>
                                </div>
                                <h6 class="text-uppercase mb-3 mt-0">{{ __('dashboard.collection') }}</h6>
                                <h4 class="mb-3">{{ $collections }}</h4>
                            </div>
                        </a>

                    </div>
                </div>
                @endif
                @if(isset($male))
                <div class="col-lg-3 mb-5">
                    <div class="card mini-stat"><a>
                            <div class="card-body mini-stat-img">
                                <div class="mini-stat-icon">
                                    <i class="la la-user-times bg-soft-primary text-primary float-right"
                                        style="font-size: 5rem;"></i>
                                </div>
                                <h6 class="text-uppercase mb-3 mt-0">{{ __('dashboard.maleCount') }}</h6>
                                <h4 class="mb-3">{{ $male }}</h4>
                            </div>
                        </a>

                    </div>
                </div>
                @endif
                @if(isset($female))
                <div class="col-lg-3 mb-5">
                    <div class="card mini-stat"><a>
                            <div class="card-body mini-stat-img">
                                <div class="mini-stat-icon">
                                    <i class="la la-user-times bg-soft-primary text-primary float-right"
                                        style="font-size: 5rem;"></i>
                                </div>
                                <h6 class="text-uppercase mb-3 mt-0">{{ __('dashboard.femaleCount') }}</h6>
                                <h4 class="mb-3">{{ $female }}</h4>
                            </div>
                        </a>

                    </div>
                </div>
                @endif
                @if(isset($voted))
                <div class="col-lg-3 mb-5">
                    <div class="card mini-stat"><a>
                            <div class="card-body mini-stat-img">
                                <div class="mini-stat-icon">
                                    <i class="la la-user-times bg-soft-primary text-primary float-right"
                                        style="font-size: 5rem;"></i>
                                </div>
                                <h6 class="text-uppercase mb-3 mt-0">{{ __('dashboard.VoterNum') }}</h6>
                                <h4 class="mb-3">{{ $voted }}</h4>
                            </div>
                        </a>

                    </div>
                </div>
                @endif
                @if(isset($notVoted))
                <div class="col-lg-3 mb-5">
                    <div class="card mini-stat"><a>
                            <div class="card-body mini-stat-img">
                                <div class="mini-stat-icon">
                                    <i class="la la-user-times bg-soft-primary text-primary float-right"
                                        style="font-size: 5rem;"></i>
                                </div>
                                <h6 class="text-uppercase mb-3 mt-0">{{ __('dashboard.NotVoterNum') }}</h6>
                                <h4 class="mb-3">{{ $notVoted }}</h4>
                            </div>
                        </a>

                    </div>
                </div>
                @endif --}}
            </div>
        </div>
        <!--end::Container-->
    </div>
@endsection
