@extends('admin.layouts.app')

@section('title')
    Orders
@endsection

@section('content')
    <div class="row p-2">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body ">
                    <div class=" border-bottom">
                        <div class="text-center">
                                <label style="margin-right: 7rem; font-size: 30px;">Orders</label>

                        </div>
                        @include('admin.layouts.alerts')
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped border text-center">
                            <thead>
                            <tr>
                                <th>
                                    S.no
                                </th>
                                <th>
                                    Order invoice
                                </th>
                                <th>
                                    User name
                                </th>
                                <th>
                                    Card name
                                </th>
                                <th>
                                    Order type
                                </th>
                                <th>
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(sizeof($orders) > 0)
                                @foreach( $orders as $key => $order)
                                    <tr id="row_{{$key}}">
                                        <td class="py-1">
                                            {{ $key+1 }}
                                        </td>
                                        <td>
                                            {{ $order->invoice_id }}
                                        </td>
                                        <td>
                                            {{ $order->user_name }}
                                        </td>
                                        <td>
                                            {{ $order->card_management_title }}
                                        </td>
                                        <td>
                                            {{ $order->order_type }}
                                        </td>
                                        <td >
                                            <button type="button" class="btn btn-rounded btn-inverse-primary btn-sm" onclick="functionupdateCard({{$order->card_id}})" data-toggle="tooltip" title="Update Order Details"><i class="mdi mdi-table-edit menu-icon"></i>
                                            </button>
                                            <button type="button" class="btn btn-rounded btn-inverse-info btn-sm" onclick="functionDelete({{$order->card_id}})" data-toggle="tooltip" title="View More Details"><i class="mdi mdi mdi-eye menu-icon"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td>
                                        No, Cards found please add cards
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
