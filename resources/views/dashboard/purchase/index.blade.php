@extends('layouts.main')


@section('content')
@include('sweet::alert')
<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header with-border">

            <form action="{{ route('purchase.index') }}" method="get">

                <div class="row no-gutters">
                    <div class="col-12 col-sm-6 col-md-8">
                        <h3 class="card-title">@lang('site.purchases')</h3>
                    </div>
                    <div class="col-6 col-md-4">
                        @if (auth()->user()->hasPermission('create_purchases'))
                        <a type="" class="btn btn-success btn float-right" style=""
                            href="{{ route('purchase.create') }}"><i class="fas fa-user-plus"></i>
                            @lang('site.createpurchase')</a>
                        @else
                        <a type="" class="btn btn-success disabled btn float-right" href="#"><i
                                class="fas fa-user-plus"></i>
                            @lang('site.createpurchase')
                        </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        <!-- /.card-header -->
        <div class="card-body">
            <div id="category_table_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="category_table" class="table table-bordered table-striped table-hover  dataTable"
                            role="grid" aria-describedby="category_table_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="category_table" rowspan="1"
                                        colspan="1" aria-sort="ascending"
                                        aria-label="Rendering engine: activate to sort column descending"
                                        style="width: 283px;">No</th>
                                    <th class="sorting" tabindex="0" aria-controls="category_table" rowspan="1"
                                        colspan="1" aria-label="Browser: activate to sort column ascending"
                                        style="width: 359px;">@lang('site.numberpurchase')</th>
                                    <th class="sorting" tabindex="0" aria-controls="category_table" rowspan="1"
                                        colspan="1" aria-label="Platform(s): activate to sort column ascending"
                                        style="width: 320px;">@lang('site.total')</th>
                                    <th class="sorting" tabindex="0" aria-controls="category_table" rowspan="1"
                                        colspan="1" aria-label="Platform(s): activate to sort column ascending"
                                        style="width: 320px;">@lang('site.discount')</th>
                                    <th class="sorting" tabindex="0" aria-controls="category_table" rowspan="1"
                                        colspan="1" aria-label="Platform(s): activate to sort column ascending"
                                        style="width: 320px;">@lang('site.totalamount')</th>
                                    <th class="sorting" tabindex="0" aria-controls="category_table" rowspan="1"
                                        colspan="1" aria-label="Platform(s): activate to sort column ascending"
                                        style="width: 320px;">@lang('site.paid')</th>
                                    <th class="sorting" tabindex="0" aria-controls="category_table" rowspan="1"
                                        colspan="1" aria-label="Platform(s): activate to sort column ascending"
                                        style="width: 320px;">@lang('site.due')</th>
                                    <th class="sorting" tabindex="0" aria-controls="category_table" rowspan="1"
                                        colspan="1" aria-label="Engine version: activate to sort column ascending"
                                        style="width: 243px;">@lang('site.action')</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($purchases as $index => $purchase)

                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $purchase->number_purchase }}</td>
                                    <td>{{ $purchase->total }}</td>
                                    <td>{{ $purchase->discount }}</td>
                                    @if ($purchase->status == "paid")
                                    <td><span class="badge bg-success">{{ $purchase->total_amount }}</span></td>
                                    @endif
                                    @if ($purchase->status == "nopaid")
                                    <td><span class="badge bg-warning">{{ $purchase->total_amount }}</span></td>
                                    @endif
                                    @if ($purchase->status == "debt")
                                    <td><span class="badge bg-danger">{{ $purchase->total_amount }}</span></td>
                                    @endif
                                    <td>{{ $purchase->paid }}</td>
                                    <td>{{ $purchase->due }}</td>
                                    <td>
                                        <a href="{{ route('purchase.show', $purchase->id) }}"
                                            class="btn btn-primary btn-sm"><i class="fas fa-print"></i></a>
                                        @if (auth()->user()->hasPermission('update_purchases'))
                                        @if ($purchase->due != 0)
                                        <button class="btn btn-warning btn-sm pcredit">@lang('site.paymentdue')</button>
                                        @endif
                                        @endif
                                        @if (auth()->user()->hasPermission('update_purchases'))
                                        <a class="btn btn-warning btn-sm"
                                            href="{{ route('purchase.edit', $purchase->id) }}"><i
                                                class="fas fa-user-edit"></i></a>
                                        @else
                                        <a class="btn btn-warning btn-sm disabled"
                                            href="{{ route('purchase.edit', $purchase->id) }}"><i
                                                class="fas fa-user-edit"></a>
                                        @endif
                                        @if (auth()->user()->hasPermission('delete_purchases'))
                                        <button id="delete" onclick="deletemoderator({{ $purchase->id }})"
                                            class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                        <form id="form-delete-{{ $purchase->id }}"
                                            action="{{ route('purchase.destroy', $purchase->id) }}" method="post"
                                            style="display:inline-block;">
                                            {{ csrf_field() }}
                                            {{ method_field('delete') }}
                                        </form>
                                        @else
                                        <button type="submit" class="btn btn-danger btn-sm disabled"><i
                                                class="fas fa-trash"></i>
                                            @lang('site.delete')</button>
                                        @endif

                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th rowspan="1" colspan="1">No</th>
                                    <th rowspan="1" colspan="1">@lang('site.numberpurchase')</th>
                                    <th rowspan="1" colspan="1">@lang('site.total')</th>
                                    <th rowspan="1" colspan="1">@lang('site.discount')</th>
                                    <th rowspan="1" colspan="1">@lang('site.totalamount')</th>
                                    <th rowspan="1" colspan="1">@lang('site.paid')</th>
                                    <th rowspan="1" colspan="1">@lang('site.due')</th>
                                    <th rowspan="1" colspan="1">@lang('site.action')</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="modal fade" id="payment_credit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">@lang('site.paymentdue')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="paymentcredit">
                        {{ csrf_field() }}
                        {{ method_field('post') }}
                        @include('partials._errors')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="hidden" id="id" name="id">
                                    <div class="form-group row">
                                        <label class="col-sm-5 col-form-label">@lang('site.numberpurchase')</label>
                                        <input type="text" id="number_purchase" name="number_purchase"
                                            class="form-control col-sm-6 text-center" readonly>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-5 col-form-label">@lang('site.totalamount')</label>
                                        <input type="number" id="paid" name="paid"
                                            class="form-control col-sm-6 text-center" readonly>
                                    </div>
                                    <div>
                                        <div class="form-group row">
                                            <label class="col-sm-5 col-form-label">@lang('site.due')</label>
                                            <input id="credit" type="number" name="credit"
                                                class="form-control col-sm-6 text-center" readonly></input>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="form-group row">
                                            <label class="col-sm-5 col-form-label">@lang('site.paiddue')</label>
                                            <input id="paidcredit" type="number" name="paidcredit"
                                                class="form-control col-sm-6 text-center" value="0"></input>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">@lang('site.close')</button>
                            <button type="submit" class="btn btn-primary">@lang('site.save')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

@stop
@section('script')
<script type="text/javascript">
    $(document).ready(function () {
        jQuery.noConflict();
        // update purchase with ajax request
        $('.pcredit').on('click', function () {
            $('#payment_credit').modal('show');

            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();
            console.log(data);
            $('#id').val(data[0]);
            $('#number_purchase').val(data[1]);
            $('#paid').val(data[5]);
            $('#credit').val(data[6]);
            $('#paidcredit').val();
            $("#paidcredit").attr({
                "max": data[6], // substitute your own
            });


        });

        $('#paymentcredit').on('submit', function (e) {
            e.preventDefault();

            var id = $('#id').val();

            $.ajax({
                type: 'PUT',
                url: "/paymentduep/" + id,
                data: $('#paymentcredit').serialize(),
                success: function (data) {
                    console.log(data);
                    $('#payment_credit').modal('hide');
                    location.reload();


                },
                error: function (error) {
                    console.log(error);



                }
            });
        });
    });

</script>


@endsection
