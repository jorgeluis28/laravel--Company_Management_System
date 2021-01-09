@section('title')
    {{ __('coupon.couponAdd') }}
@endsection
@extends('dashboard.layouts.layout')
@section('style')


    <link href="{{ asset('assets/dashboard//plugins/datepicker/datepicker.min.css') }}" rel="stylesheet" type="text/css">

@endsection
@section('rightbar-content')
    <!-- Start Breadcrumbbar -->
    <div class="breadcrumbbar">
        <div class="row align-items-center">
            <div class="col-md-8 col-lg-8">
                <h4 class="page-title">{{ __('coupon.couponAdd') }}</h4>
                <div class="breadcrumb-list">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/home')}}">{{ __('side.dashboard') }}</a></li>
                        <li class="breadcrumb-item">{{ __('side.marketing') }}</li>
                        <li class="breadcrumb-item active"><a
                                href="{{route('coupons.index')}}">{{ __('side.coupons') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('coupon.couponAdd') }}</li>
                    </ol>
                </div>
            </div>
            <div class="col-md-4 col-lg-4">
                <div class="widgetbar">
                    <a class="btn btn-primary-rgba"
                       href="{{ route('coupons.index') }}">{{ __('coupon.couponBack') }}</a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbbar -->
    <!-- Start Contentbar -->
    <div class="contentbar">
        <!-- Start row -->
        <div class="row">
            <!-- Start col -->
            <div class="col-lg-12">
                <form method="post" action="{{ route('coupons.add') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-3 mb-4">
                                    <div class="form-group mb-0">
                                        <label for="code">{{ __('coupon.couponPromoCode') }}</label>
                                        <input type="text" class="form-control" id="code" name="code"
                                               placeholder="{{ __('coupon.couponPromoCode') }}" required="">
                                    </div>
                                </div>

                                <div class="col-lg-3 mb-4">
                                    <div class="form-group mb-0">
                                        <label for="type">{{ __('coupon.couponType') }}</label>
                                        <select class="form-control" name="type" required="" id="type">
                                            <option disabled selected
                                                    value="">{{ __('coupon.couponTypeSelect') }}</option>
                                            <option value="Free">{{ __('coupon.couponFree') }}</option>
                                            <option value="Percentage">{{ __('coupon.couponPercentage') }}</option>
                                            <option value="Flat">{{ __('coupon.couponFlat') }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-3 mb-4">
                                    <div class="form-group mb-0">
                                        <label for="coupon_value">{{ __('coupon.couponValue') }}</label>
                                        <input type="number" class="form-control" id="coupon_value" name="coupon_value"
                                               placeholder="{{ __('coupon.couponValue') }}" required="">
                                    </div>
                                </div>
                                <div class="col-lg-3 mb-4">
                                    <div class="form-group mb-0">
                                        <label for="total_usage">{{ __('coupon.total_usage_per_client') }}</label>
                                        <input type="number" class="form-control" id="total_usage" name="total_usage"
                                               placeholder="{{ __('coupon.total_usage_per_client') }}" required="">
                                    </div>
                                </div>
                                <div class="col-lg-4 mb-4">
                                    <div class="form-group mb-0">
                                        <label for="status">{{ __('coupon.couponStatus') }}</label>
                                        <select class="form-control" name="status" id="status" required="">
                                            <option disabled selected
                                                    value="">{{ __('coupon.couponeStatusSelect') }}</option>
                                            <option value="0">{{ __('coupon.couponHold') }}</option>
                                            <option value="1">{{ __('coupon.couponeActive') }}</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-4 mb-4">
                                    <div class="form-group mb-0">
                                        <label>{{ __('coupon.couponStart') }}</label>
                                        <div class="input-group">
                                            <input type="text" id="default-date" class="form-control"
                                                   placeholder="yyyy/mm/dd" aria-describedby="basic-addon2"
                                                   name="start_date_coupon" autocomplete="off"/>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2"><i
                                                        class="feather icon-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 mb-4">
                                    <div class="form-group mb-0">
                                        <label>{{ __('coupon.couponEnd') }}</label>
                                        <div class="input-group">
                                            <input type="text" id="default-date12" class="form-control"
                                                   placeholder="yyyy/mm/dd" aria-describedby="basic-addon2"
                                                   name="end_date_coupon" autocomplete="off"/>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2"><i
                                                        class="feather icon-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-12 mt-4">
                                    <div class="form-group mb-0">
                                        <button type="submit"
                                                class="btn btn-primary pl-5 pr-5">{{ __('coupon.couponSave') }}</button>
                                    </div>
                                </div>
                </form>

            </div>


        </div>
    </div>
    </div>
    <!-- End col -->
    </div>
    <!-- End row -->
    </div>

    <!-- End Contentbar -->
@endsection
@section('script')


    <script src="{{ asset('assets/dashboard//plugins/datepicker/datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard//plugins/datepicker/i18n/datepicker.en.js') }}"></script>


    <script src="{{ asset('assets/dashboard//js/custom/custom-toasts.js') }}"></script>

    <script>
        $(document).ready(function () {

            $('#default-date').datepicker({
                language: 'en',
                dateFormat: 'yyyy/mm/dd',
            });
            $('#default-date12').datepicker({
                language: 'en',
                dateFormat: 'yyyy/mm/dd',
            });

            $('#default-datatable').DataTable();

        });
    </script>
@endsection 
