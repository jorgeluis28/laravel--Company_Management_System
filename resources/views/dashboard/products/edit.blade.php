@extends('dashboard.layouts.layout')
@php
    $lang_current = Config::get('app.locale');
@endphp
@section('title')
    {{ __('products/productEdit.titleEdit') }}
@endsection
<base href="{{ url('/') }}">
@section('style')
    <link href="{{ asset('assets/dashboard/plugins/summernote/summernote-bs4.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Dropzone css -->
    <link href="{{ asset('assets/dashboard/plugins/dropzone/dist/dropzone.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/dashboard/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Responsive Datatable css -->
    <link href="{{ asset('assets/dashboard/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <!-- Select2 css -->
    <link href="{{ asset('assets/dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Tagsinput css -->
    <link href="{{ asset('assets/dashboard/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('assets/dashboard/plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('assets/dashboard/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css"/>
    <style>
        .mydropzone {
            min-height: 100px;
            border: 2px dashed;
            cursor: pointer;
        }
        .mydropzone .dz-message{
            position: absolute;
            margin: auto;
            padding-top: 10px;
            width: 100%;
            text-align: center;
            color: #8A98AC;
        }
        .mydropzone .dz-preview.dz-image-preview {
            display: inline-block;
            position: relative;
            margin: 10px;
            border-radius: 10px;
            text-align: center;
        }
        .mydropzone .dz-preview.dz-image-preview .dz-image img {
            border-radius: 10px;
            width: 120px;
            height: 120px;
        }
        .mydropzone .dz-preview.dz-image-preview:hover .dz-image {
            opacity: 0.2;
        }
        .mydropzone .dz-preview.dz-image-preview:hover .dz-remove {
            display: block;
            background-color: red;
        }
        .mydropzone a.dz-remove {
            display: none;
            position: absolute;
            top: 50px;
            left: 50px;
            background-color: pink;
            width: 24px;
            height: 24px;
            font-size: 22px;
            border-radius: 50%;
            color: white;
        }
        .dz-message.hidden {
            display: none;
        }
    </style>
@endsection
@section('rightbar-content')

    <!-- Start Breadcrumbbar -->
    <form id="product_form" method="post" enctype="multipart/form-data">
        <div class="breadcrumbbar">

            @csrf
            <input type="hidden" name="prod_id" value="{{ $product->id }}">
            <div class="row align-items-center">
                <div class="col-md-8 col-lg-8">
                    @if(app()->getLocale() != "en")
                        <h4 class="page-title">{{ __('products/productEdit.titleEdit') }} ({{ $product->name_ar }})</h4>
                    @else
                        <h4 class="page-title">{{ __('products/productEdit.titleEdit') }} ({{ $product->name }})</h4>
                    @endif
                    <div class="breadcrumb-list">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/home')}}">{{ __('side.dashboard') }}</a></li>
                            <li class="breadcrumb-item">{{ __('side.products') }}</li>
                            <li class="breadcrumb-item"><a href="{{route('products.index')}}">{{ __('side.productList') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('products/productEdit.titleEdit') }} @if(app()->getLocale() != "en") ({{ $product->name_ar }}) @else ({{ $product->name }}) @endif </li>
                        </ol>
                    </div>
                </div>
                <div class="col-md-4 col-lg-4">
                    <div class="widgetbar">
                        <a class = "btn btn-primary-rgba" href="{{route('products.index')}}">{{ __('products/productAdd.back') }}</a>

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
                <!-- Start col -->
                <div class="col-lg-8 col-xl-9">
                    <div class="card m-b-30">
                        <div class="card-header">
                            <h5 class="card-title">{{ __('products/productEdit.productDetail') }}</h5>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-pills nav-justified mb-3"
                                @if($lang_current == 'ar') style="padding-right: 0 !important;" @endif role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" value="{{ $product->name_ar }}" style="font-family: 'Tajawal', sans-serif;" id="pills-arabic-product-information-tab-justified" data-toggle="pill" href="#pills-arabic-product-information-justified" role="tab" aria-controls="pills-profile" aria-selected="false">تفاصيل المنتج باللغة العربية</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-english-product-information-tab-justified" data-toggle="pill" href="#pills-english-product-information-justified" role="tab" aria-controls="pills-home" aria-selected="true">Product Details in English</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-images-tab-justified" data-toggle="pill" href="#pills-images-justified" role="tab" aria-controls="pills-home" aria-selected="true">Images</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body tab-content" style="text-align: left !important; direction: ltr;">
                            <div class="form-group row tab-pane fade show" style="text-align: right;" id="pills-images-justified" role="tabpanel" aria-labelledby="pills-images-tab-justified">
                                <div "file_dropzone">
                                    <div class="mydropzone needsclick" id="mydropzone" action="{{url('products/update')}}">
                                      <div class="dz-message needsclick {{ sizeof($images) ? 'hidden' : '' }}">Drop files here or click to upload.</div>
                                      @if(sizeof($images))
                                          @foreach ($images as $image)
                                            <div id="{{ $image }}" class="dz-preview dz-image-preview">
                                                <div class="dz-image"><img data-dz-thumbnail="" accept="image/x-png,image/jpg,image/jpeg" alt="7.jpg" src="{{ url('uploads/product_images') }}/{{ $image }}"></div>
                                                <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress=""></span></div>
                                                <div class="dz-error-message"><span data-dz-errormessage=""></span></div>
                                                <a class="dz-remove for-saved-image" href="javascript:undefined;" data-dz-remove=""><i class="fa fa-close"></i></a>
                                            </div>
                                          @endforeach
                                      @endif
                                    </div>
                                </div>
                                <div id="preview-template" style="display: none;">
                                    <div class="dz-preview dz-file-preview">
                                        <div class="dz-image"><img data-dz-thumbnail=""></div>
                                        <!--<div class="dz-details">
                                            <div class="dz-filename"><SPAN data-dz-name=""></span></div>
                                            <div class="dz-size"><span data-dz-size=""></span></div>
                                        </div>-->
                                        <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress=""></span></div>
                                        <div class="dz-error-message"><span data-dz-errormessage=""></span></div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group row tab-pane fade show" id="pills-english-product-information-justified" role="tabpanel" aria-labelledby="pills-english-product-information-tab-justified">
                                <label for="name_en" class="col-sm-12 col-form-label">Product Name</label>
                                <div class="col-sm-12">
                                    <input type="text" style="text-align: left !important;" name="name_en" value="{{ $product->name }}" class="form-control font-20" id="name_en" required>
                                    <div class="error error_name_en"></div>
                                </div>
                                <label class="col-sm-12 col-form-label" for="description_en">Product Description</label>
                                <div class="col-sm-12">
                                    {{-- <div class="summernote" name="description_en"></div> --}}
                                    <textarea class="summernote input-block-level" id="description_en" name="description_en">{{ $product->description_en }}</textarea>
                                    <div class="error error_description_en"></div>
                                </div>
                            </div>


                            <div class="form-group row tab-pane fade show active" style="text-align: right;" id="pills-arabic-product-information-justified" role="tabpanel" aria-labelledby="pills-arabic-product-information-tab-justified">
                                <label style="font-family: 'Tajawal', sans-serif;" for="name_ar"
                                       class="col-sm-12 col-form-label">أسم المنتج</label>
                                <div class="col-sm-12">
                                    <input style="text-align: right; font-family: 'Tajawal', sans-serif;" type="text" name="name_ar" class="form-control font-20" id="name_ar" value="{{ $product->name_ar }}" required>
                                    <div class="error error_name_ar"></div>
                                </div>
                                <label for="description_ar" style="font-family: 'Tajawal', sans-serif;" class="col-sm-12 col-form-label">وصف المنتج</label>
                                <div style="font-family: 'Tajawal', sans-serif;" class="col-sm-12">
                                    <textarea class="summernote input-block-level" id="description_ar" name="description_ar">{{ $product->description_ar }}</textarea>
                                    <div class="error error_description_ar"></div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-xl-4">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <div class="nav flex-column nav-pills" id="v-pills-product-tab" role="tablist" aria-orientation="vertical">
                                        <a class="nav-link mb-2 active" id="v-pills-general-tab" data-toggle="pill" href="#v-pills-general" role="tab" aria-controls="v-pills-general" aria-selected="true"><i class="feather icon-feather mr-2"></i>{{ __('products/productEdit.general') }}</a>
                                        <a class="nav-link mb-2" id="v-pills-stock-tab" data-toggle="pill" href="#v-pills-stock" role="tab" aria-controls="v-pills-stock" aria-selected="false"><i class="feather icon-box mr-2"></i>{{ __('products/productEdit.stock') }}</a>
                                        <a class="nav-link mb-2" id="v-pills-shipping-tab" data-toggle="pill" href="#v-pills-shipping" role="tab" aria-controls="v-pills-shipping" aria-selected="false"><i class="feather icon-truck mr-2"></i>{{ __('products/productEdit.shipping') }}</a>
                                        <!--<a class="nav-link mb-2" id="v-pills-advanced-tab" data-toggle="pill" href="#v-pills-advanced" role="tab" aria-controls="v-pills-advanced" aria-selected="false"><i class="feather icon-settings mr-2"></i>Advanced</a>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-xl-8">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <div class="tab-content" id="v-pills-product-tabContent">
                                        <div class="tab-pane fade show active" id="v-pills-general" role="tabpanel"
                                             aria-labelledby="v-pills-general-tab">
                                            <div class="form-group row">
                                                <label for="purchase_price" class="col-sm-4 col-form-label">Purchase Price</label>
                                                <div class="col-sm-8">
                                                    <input type="text" id="purchase_price" name="purchase_price" class="form-control" value="{{ $product->purchase_price }}" placeholder="100" required>
                                                    <div class="error error_purchase_price"></div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="price" class="col-sm-4 col-form-label font">{{ __('products/productEdit.price') }}</label>
                                                <div class="col-sm-8">
                                                    <input type="text" id="price" name="price" value="{{ $product->price }}" class="form-control" placeholder="100" required>
                                                    <div class="error error_price"></div>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-0">
                                                <label for="salePrice" class="col-sm-4 col-form-label font">{{ __('products/productEdit.salePrice') }}</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="sale_price" value="{{ $product->sale_price }}" class="form-control" placeholder="50" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="v-pills-stock" role="tabpanel" aria-labelledby="v-pills-stock-tab">
                                            <div class="form-group row">
                                                <label for="sku" class="col-sm-4 col-form-label font">{{ __('products/productEdit.sku') }}</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="sku" value="{{ $product->sku }}" class="form-control" id="sku" placeholder="SKU001">
                                                </div>
                                            </div>
                                            <!--TODO-->
                                            <div class="form-group row">
                                                <label for="stockStatus" class="col-sm-4 col-form-label font">{{ __('products/productEdit.stockStatus') }}</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control" name="stock_status" id="stockStatus">
                                                        <option value="1">In Stock</option>
                                                        <option value="0">Out of Stock</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-0">
                                                <label for="stockQuantity" class="col-sm-4 col-form-label font">{{ __('products/productEdit.quantity') }}</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="stock_quantity" class="form-control" id="stockQuantity" placeholder="100" value="{{ $product->stock_quantity }}">
                                                    <div class="error error_stock_quantity"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="v-pills-shipping" role="tabpanel" aria-labelledby="v-pills-shipping-tab">
                                            <div class="form-group row">
                                                <label for="weight" class="col-sm-4 col-form-label font">{{ __('products/productEdit.weight') }}</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="weight" class="form-control" id="weight" placeholder="0">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row mb-0">
                                                <label for="shippingClass" class="col-sm-4 col-form-label font">{{ __('products/productEdit.shoppingClasses') }}</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control" name="shipping" id="shippingClass">
                                                        <option value="free">Free Shipping</option>
                                                        <option value="no">No Shipping</option>
                                                        <option value="fixed">Fixed Shipping</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!--TODO: Purchase note-->
                                        <!--<div class="tab-pane fade" id="v-pills-advanced" role="tabpanel" aria-labelledby="v-pills-advanced-tab">-->
                                        <!--    <div class="form-group row mb-0">-->
                                        <!--        <label for="purchaseNote" class="col-sm-3 col-form-label">Purchase note</label>-->
                                        <!--        <div class="col-sm-9">-->
                                        <!--            <textarea class="form-control" name="purchaseNote" id="purchaseNote" rows="3" placeholder="Purchase note"></textarea>-->
                                        <!--        </div>-->
                                        <!--    </div>-->
                                        <!--</div>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End col -->
                <!-- Start col -->
            <div class="col-lg-4 col-xl-3">
                    <div class="card m-b-30">
                        <div class="card-header">
                            <h5 class="card-title">{{ __('products/productEdit.categories') }}</h5>
                        </div>
                        <div class="card-body" style="max-height: 245px; overflow: auto;">
                            @php
                                $productCat = [0 => 0];
                                if(!is_null($product->categories)){
                                    $productCat = explode('|', $product->categories);
                                }
                            @endphp

                            @if(isset($categories))
                                @if(count($categories) > 0)
                                    @foreach($categories as $cat)
                                        @php
                                            $cat_search = array_search($cat->id,$productCat,true);
                                        @endphp
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="categories[]" class="custom-control-input" @if($cat_search !== false) checked @endif value="{{ $cat->id }}" id="{{ $cat->id }}">
                                            <label class="custom-control-label" for="{{ $cat->id }}">@if(app()->getLocale() == "en") {{ $cat->name }} @else  {{ $cat->name_ar }} @endif</label>
                                        </div>
                                    @endforeach
                                @endif
                            @endif
                        </div>
                    </div>

                    <!--<div class="card m-b-30">-->
                    <!--     <div class="card-header">-->
                    <!--         <h5 class="card-title">{{ __('products/productEdit.color') }}</h5>-->
                    <!--     </div>-->
                    <!--     <div class="card-body pt-3">-->
                    <!--         <div class="custom-checkbox-button">-->
                    <!--             <div class="form-check-inline checkbox-primary">-->
                    <!--               <input type="checkbox" id="customCheckboxInline5" name="customCheckboxInline2" checked>-->
                    <!--               <label for="customCheckboxInline5"></label>-->
                    <!--             </div>-->
                    <!--             <div class="form-check-inline checkbox-secondary">-->
                    <!--               <input type="checkbox" id="customCheckboxInline6" name="customCheckboxInline2">-->
                    <!--               <label for="customCheckboxInline6"></label>-->
                    <!--             </div>-->
                    <!--             <div class="form-check-inline checkbox-success">-->
                    <!--               <input type="checkbox" id="customCheckboxInline7" name="customCheckboxInline2">-->
                    <!--               <label for="customCheckboxInline7"></label>-->
                    <!--             </div>-->
                    <!--             <div class="form-check-inline checkbox-danger">-->
                    <!--               <input type="checkbox" id="customCheckboxInline8" name="customCheckboxInline2">-->
                    <!--               <label for="customCheckboxInline8"></label>-->
                    <!--             </div>-->
                    <!--             <div class="form-check-inline checkbox-warning">-->
                    <!--               <input type="checkbox" id="customCheckboxInline9" name="customCheckboxInline2">-->
                    <!--               <label for="customCheckboxInline9"></label>-->
                    <!--             </div>-->
                    <!--             <div class="form-check-inline checkbox-info">-->
                    <!--               <input type="checkbox" id="customCheckboxInline10" name="customCheckboxInline2">-->
                    <!--               <label for="customCheckboxInline10"></label>-->
                    <!--             </div>-->
                    <!--             <div class="form-check-inline checkbox-light">-->
                    <!--               <input type="checkbox" id="customCheckboxInline11" name="customCheckboxInline2">-->
                    <!--               <label for="customCheckboxInline11"></label>-->
                    <!--             </div>-->
                    <!--             <div class="form-check-inline checkbox-dark">-->
                    <!--               <input type="checkbox" id="customCheckboxInline12" name="customCheckboxInline2">-->
                    <!--               <label for="customCheckboxInline12"></label>-->
                    <!--             </div>-->
                    <!--         </div>-->
                    <!--     </div>-->
                    <!-- </div> -->


                    <!--/=======================================\-->
                    <!--|======  Meat Application Starts  ======|-->
                    <!--\=======================================/-->
                    @php
                        $plug = get_plugin_if_active(2);
                    @endphp
                    @if($plug->status == 1)
                        <div class="card m-b-30">
                            <div class="card-header">
                                <h5 class="card-title btn btn-primary d-block" data-toggle="modal" data-target="#edit_sizes">{{ __('products/productAdd.size') }}</h5>                            
                            </div>
                        </div>

                        <div class="card m-b-30">
                            <div class="card-header">
                                <h5 class="card-title">{{ __('products/productEdit.cuttingMethod') }}</h5>
                            </div>
                            <div class="card-body pt-3">

                                <select class="select2-multi-select form-control" name="cutting_method[]" multiple="multiple" required>
                                    @foreach($cutting as $item)
                                        <option value="{{ $item->id }}" @foreach($product->cuttings as $cutting) @if($cutting->id == $item->id) selected @endif @endforeach >
                                            {{ (app()->getLocale() == "ar") ? $item->name_ar : $item->name_en }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="card m-b-30">
                            <div class="card-header">
                                <h5 class="card-title">{{ __('products/productEdit.packagingMethod') }}</h5>
                            </div>
                            <div class="card-body pt-3">

                                <select class="select2-multi-select form-control" name="packaging_method[]" multiple="multiple" required>
                                    @foreach($packing as $item)
                                        <option value="{{ $item->id }}" @foreach($product->packings as $packing) @if($packing->id == $item->id) selected @endif @endforeach >
                                            {{ (app()->getLocale() == "ar") ? $item->name_ar : $item->name_en }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif
                    <div class="card m-b-30">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-9">
                                    <h5 class="card-title">
                                        {{__('products.digital_product')}}
                                    </h5>
                                </div>
                                <div class="col-3">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" name="digital_product" id="digital_product" @if($product->digital_product) checked @endif>
                                        <label class="custom-control-label" for="digital_product"></label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary mt-3 get-codes btn-digital-codes" @if($product->digital_product) style="display: block" @endif data-toggle="modal" type="button" data-target="#add_codes" data-product="{{ $product->name }}" data-id="{{ $product->id }}">
                                        {{__('products.add_digital_codes_on_here')}}
                                    </button>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/====================================\-->
                    <!--|======  Meat Application END  ======|-->
                    <!--\====================================/-->



                    <!--<div class="card m-b-30">-->
                    <!--    <div class="card-header">-->
                    <!--        <h5 class="card-title">Tags</h5>-->
                    <!--    </div>-->
                    <!--    <div class="card-body">-->
                    <!--        <div class="product-tags">-->
                    <!--            <span class="badge badge-secondary-inverse">New</span>-->
                    <!--            <span class="badge badge-secondary-inverse">Latest</span>-->
                    <!--            <span class="badge badge-secondary-inverse">Trending</span>-->
                    <!--            <span class="badge badge-secondary-inverse">Popular</span>-->
                    <!--            <span class="badge badge-secondary-inverse">Sale</span>-->
                    <!--        </div>                                -->
                    <!--    </div>-->
                    <!--    <div class="card-footer">-->
                    <!--        <div class="add-product-tags">-->
                    <!--                <div class="input-group">-->
                    <!--                  <div class="input-group-append">-->
                    <!--                    <button class="input-group-text" type="submit" id="button-addonTags">Add</button>-->
                    <!--                  </div>-->
                    <!--                </div>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->

                </div>
            <div class="col-md-4 col-lg-4">
                <div class="widgetbar">
                    <button class="btn btn-primary save" type="button">{{ __('products/productsList.save') }}</button>
                </div>
            </div>
                <!-- End col -->
            </div>
            <!-- End row -->

        </div>
        @include('dashboard.products.modules.SizeEditModule')
    </form>
    <!-- End Contentbar -->
    @include('dashboard.products.modules.CodeEditModule')
    
@endsection

@include('dashboard.products.scripts.edit')