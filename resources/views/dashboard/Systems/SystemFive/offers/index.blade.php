@section('title')
    {{__('Systems/SystemFive/offers.offers')}}
@endsection
@extends('dashboard.layouts.layout')
@section('style')

<link href="{{ asset('assets/dashboard/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/dashboard/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Responsive Datatable css -->
<link href="{{ asset('assets/dashboard/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

{{--<style>--}}
    {{--td { text-align: center; }--}}
{{--</style>--}}

<link href="{{ asset('assets/dashboard/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />


@endsection
@section('rightbar-content')
<!-- Start Breadcrumbbar -->
<div class="breadcrumbbar">
    <div class="row align-items-center">
        <div class="col-md-5 col-lg-5">
            <h4 class="page-title">{{__('Systems/SystemFive/offers.offers_list')}}</h4>
            <div class="breadcrumb-list">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/home')}}">{{ __('side.dashboard') }}</a></li>
                    <li class="breadcrumb-item">{{__('Systems/SystemFive/offers.offers')}}</li>
                    <li class="breadcrumb-item active" aria-current="page">{{__('Systems/SystemFive/offers.offers_list')}}</li>
                </ol>
            </div>
        </div>
        <div class="col-md-3 col-lg-3">
            <select id="offer_state" class="form-control" onchange="filter(this.value)">
                <option value="All">All</option>
                <option value="Awaiting Deliveries">Awaiting Deliveries</option>
                <option value="Submitted">Submitted</option>
                <option value="Rejected">Rejected</option>
            </select>
        </div>
        <div class="col-md-4 col-lg-4">
            <div class="widgetbar">
                <a href="{{ route('offers.create') }}" class="btn btn-primary-rgba"><i class="feather icon-plus mr-2"></i>{{__('Systems/SystemFive/offers.add_offer')}}</a>
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
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless" id="default-datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('Systems/SystemFive/offers.company_name')}}</th>
                                    <th>{{__('Systems/SystemFive/offers.domain')}}</th>
                                    <th>{{__('Systems/SystemFive/offers.offer_title')}}</th>
                                    <th>{{__('Systems/SystemFive/offers.order_detail')}}</th>
                                    <th>{{__('Systems/SystemFive/offers.edit_offer')}}</th>
                                    <th>{{__('Systems/SystemFive/offers.delete')}}</th>

                                </tr>
                            </thead>
                            <tbody>
                                {{--@if(isset($offers) && count($offers) > 0)--}}
                                    {{--@foreach($offers as $key => $offer)--}}
                                        {{--<tr>--}}
                                            {{--<td>{{ $key + 1 }}</td>--}}
                                            {{--<td>{{ $offer->company_name }}</td>--}}
                                            {{--<td>{{ $offer->domain }}</td>--}}
                                            {{--<td>{{ $offer->offer_title }}</td>--}}
                                            {{--<td>--}}
                                                {{--<a onclick="orderdetailShow('{{$offer->order_detail}}')" data-toggle="modal" data-target="#orderDetailShow" class="btn btn-info-rgba"><i class="feather icon-tag"></i></a>--}}
                                            {{--</td>--}}

                                            {{--<td><a href="{{route('offers.edit', $offer->id)}}" class="btn btn-success-rgba"><i class="feather icon-eye"></i></a></td>--}}
                                            {{--<td><a onclick="deleteConfirm({{$offer->id}})" class="btn btn-danger-rgba"><i class="feather icon-trash"></i></a></td>--}}
                                      {{--</tr>--}}
                                    {{--@endforeach--}}
                                    {{--@endif--}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- End col -->
    </div>
    <!-- End row -->
</div>

<!-- End Contentbar -->

<!-- The Order Detail Modal -->
<div class="modal fade" id="orderDetailShow" tabindex="-1" role="dialog" aria-labelledby="exampleStandardModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleStandardModalLabel">{{__('Systems/SystemTwo/jobtasks.job_note')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <textarea id="orderdetail" name="orderdetail" style="width:100%;height:200px;" readonly></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script>

    function status_change(token, id, route) {
        $.ajax({
            url : route,
            type: "POST",
            data: {_token: token, id: id},
            success: function (response) {
                //$(".table").load(location.href + " .table>*", "");
            }
        });
    }
</script>

<script src="{{ asset('assets/dashboard/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/datatables/jszip.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/datatables/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/datatables/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/datatables/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/datatables/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>

<script src="{{ asset('assets/dashboard/js/custom/custom-toasts.js') }}"></script>

<!-- Sweet-Alert js -->
<script src="{{ asset('assets/dashboard/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/custom/custom-sweet-alert.js') }}"></script>

<script>
    $(document).ready(function() {

        filter($("#offer_state").val());

    });

    function orderdetailShow(jobnote) {

        document.getElementById("orderdetail").innerHTML = jobnote;
        return true;

    }
</script>
<script>
    function deleteConfirm(id) {

        swal({
            title: 'Are you sure?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes!',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger m-l-10',
            buttonsStyling: false
        }).then(function () {

            $.ajax({
                method: "post",
                url: "{{url('dashboard/del-offer')}}",
                headers: {
                    'X-CSRF-TOKEN': '<?= csrf_token() ?>'
                },

                data : JSON.stringify({id : id}),
                datatype: 'JSON',
                contentType: 'application/json',

                async: true,
                success: function (data) {
                    console.log(data);
                    //  wait.resolve();
                    $(".loadingMask").css('display', 'none');

                    if (data === 0) {
                        swal(
                            'Error',
                            'Please try again',
                            'error'
                        )
                    } else {
                        swal(
                            'Done!',
                            'Deleted Successfully',
                            'success'
                        ).then(function (){
                            window.location = "{{route('offers.index')}}"
                        });
                    }
                },
                error: function () {
                    swal(
                        'Error',
                        'Please try again',
                        'error'
                    )
                }
            });

        }, function (dismiss) {
            if (dismiss === 'cancel') {
                swal(
                    'Cancelled',
                    'Your offer data is safe :)',
                    'error'
                )
            }
        })

    }
    function filter(value) {
        console.log(value);

        $('#default-datatable').DataTable().destroy();

        $.ajax({
            method: "post",
            url: "{{url('dashboard/filter-offer')}}",
            headers: {
                'X-CSRF-TOKEN': '<?= csrf_token() ?>'
            },

            data : JSON.stringify({value : value}),
            datatype: 'JSON',
            contentType: 'application/json',

            async: true,
            success: function (data) {
                console.log(data);

                var index;

                var content = "";

                for ( index = 0; index < data.length ; index ++ ) {

                    content += "<tr>";
                    content += "<td>";
                    content += index + 1;
                    content += "</td>";
                    content += "<td>";
                    content += data[index].company_name;
                    content += "</td>";
                    content += "<td>";
                    content += data[index].domain;
                    content += "</td>";
                    content += "<td>";
                    content += data[index].offer_title;
                    content += "</td>";

                    content += "<td>";
                    content += "<a onclick=\"orderdetailShow('";
                    content += data[index].order_detail;
                    content += "')\" data-toggle=\"modal\" data-target=\"#orderDetailShow\" class=\"btn btn-info-rgba\"><i class=\"feather icon-tag\"></i></a></td>";

                    content += "<td><a href='/dashboard/offers/edit/";
                    content += data[index].id;
                    content += "'";
                    content += ")}}\" class=\"btn btn-success-rgba\"><i class=\"feather icon-eye\"></i></a></td>";

                    content += "<td><a onclick=\"deleteConfirm(";
                    content += data[index].id;

                    content += ")\" class=\"btn btn-danger-rgba\"><i class=\"feather icon-trash\"></i></a></td>";

                    content += "</tr>";

                }

                console.log(content);

                $("tbody").html(content);

                var buttonCommon = {
                    exportOptions: {
                        format: {
                            body: function ( data, row, column, node ) {
                                // Strip $ from salary column to make it numeric
                                console.log(row);
                                if(row === 4){
                                    return $('#customSwitch' + column).is(":checked") ? 'Active' : 'Inactive' ;
                                }

                                return data;
                            }
                        },
                        columns: [ 0, 1]
                    }
                };

                $('#default-datatable').DataTable(

                    {
                        dom: 'Bfrtip',
                        buttons: [
                            $.extend( true, {}, buttonCommon, {
                                extend: 'print',
                            } ),
                            $.extend( true, {}, buttonCommon, {
                                extend: 'csvHtml5',
                            } ),
                            $.extend( true, {}, buttonCommon, {
                                extend: 'excelHtml5'
                            } ),
                            $.extend( true, {}, buttonCommon, {
                                extend: 'pdfHtml5'
                            } ),
                        ]
                    }

                );


                // table.reload();



                {{--if (data === 0) {--}}
                    {{--swal(--}}
                        {{--'Error',--}}
                        {{--'Please try again',--}}
                        {{--'error'--}}
                    {{--)--}}
                {{--} else {--}}
                    {{--swal(--}}
                        {{--'Done!',--}}
                        {{--'Deleted Successfully',--}}
                        {{--'success'--}}
                    {{--).then(function (){--}}
                        {{--window.location = "{{route('offers.index')}}"--}}
                    {{--});--}}
                {{--}--}}
            },
            error: function () {
                swal(
                    'Error',
                    'Please try again',
                    'error'
                )
            }
        });
    }
    function refresh() {
        $("#offer_state").val("All");
    }

</script>
@endsection
