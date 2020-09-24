@extends('admin.layouts.app')

@section('title')
    Card | Management
@endsection

@section('content')
    <div class="row p-2">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body ">
                    <div class=" border-bottom">
                        <div class="row">
                            <div class="col-sm-8 text-right">

                                <label style="margin-right: 7rem; font-size: 30px;">Card Management</label>
                            </div>
                            <div class="col-sm text-right mb-2">
                                <button type="button" class="btn btn-rounded btn-outline-success" onclick="functionAddCard()" data-toggle="tooltip" title="Add card category"><i class="mdi mdi-library-plus menu-icon"></i>&nbsp; Add Card
                                </button>
                            </div>
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
                                    Card type
                                </th>
                                <th>
                                    card title
                                </th>
                                <th>
                                    card Image
                                </th>
                                <th>
                                    card Price
                                </th>
                                <th>
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(sizeof($card_details) > 0)
                                @foreach( $card_details as $key => $card)
                                    <tr id="row_{{$key}}">
                                        <td class="py-1">
                                            {{ $key+1 }}
                                        </td>
                                        <td>
                                            {{ ucfirst($card->card_type )}}
                                        </td>
                                        <td>
                                            {{ ucfirst($card->card_management_title) }}
                                        </td>
                                        <td>
                                            @if($card->card_management_image !== null)
                                                <img src="{{ $card->card_management_image }}" alt="card image">
                                            @else
                                                Image not Saved
                                            @endif
                                        </td>
                                        <td>
                                            {{ $card->card_management_price }} {{ $card->card_management_price_unit }}
                                        </td>
                                        <td >
                                            <button type="button" class="btn btn-rounded btn-inverse-primary btn-sm" onclick="functionupdateCard({{$card->card_management_id}})" data-toggle="tooltip" title="Update Card category"><i class="mdi mdi-pencil-box-outline menu-icon"></i>
                                            </button>
                                            <button type="button" class="btn btn-rounded btn-inverse-danger btn-sm" onclick="functionDelete({{$card->card_management_id}})" data-toggle="tooltip" title="Delete Card category"><i class="mdi mdi-delete-forever menu-icon"></i>
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


    <div class="modal fade" id="addNewCardModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('add_card_management') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add New Card</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row m-3">
                            <label for="exampleInputPassword2" class="col-sm-4 col-form-label">Card Type <small>*</small></label>
                            <div class="col-sm-8">
                                <select name="card_type" id="exampleInputPassword2" class="form-control">
                                    <option value="null">--Select card type--</option>
                                    @if(sizeof($card_type)>0)
                                        @foreach($card_type as $key => $type)
                                            <option id="card_type_{{$key}}" value="{{$type->card_id}}">{{ucfirst($type->card_type)}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group row m-3">
                            <label for="exampleInputPassword3" class="col-sm-4 col-form-label">Card Title <small>*</small></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="exampleInputPassword3" name="card_title" placeholder="Enter card title">
                            </div>
                        </div>
                        <div class="form-group row m-3">
                            <label for="exampleInputPassword4" class="col-sm-4 col-form-label">Card Price <small>*</small> </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="exampleInputPassword4" name="card_price" placeholder="Enter card price">
                            </div>
                        </div>
                        <div class="form-group row m-3">
                            <label for="exampleInputPassword5" class="col-sm-4 col-form-label">Price Unit <small>*</small> </label>
                            <div class="col-sm-8">
                                <select name="price_unit" id="exampleInputPassword5" class="form-control">
                                    <option value="null">--Select price unit--</option>
                                    <option value="INR">INR</option>
                                    <option value="USD">USD</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row m-3">
                            <label for="exampleInputPassword6" class="col-sm-4 col-form-label">Card Image </label>
                            <div class="col-sm-8">
                                <input type="file" name="card_image" id="exampleInputPassword6" class="form-control" accept="image/*">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-rounded btn-outline-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-rounded btn-outline-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateCardModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('update_card_management') }}" method="post" enctype="multipart/form-data">
                    <input type="hidden" id="card_management_id" name="card_management_id">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Update Card</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row m-3">
                            <label for="card_type_update" class="col-sm-4 col-form-label">Card Type <small>*</small></label>
                            <div class="col-sm-8">
                                <select name="card_type" id="card_type_update" class="form-control">
                                    <option value="null">--Select card type--</option>
                                    @if(sizeof($card_type)>0)
                                        @foreach($card_type as $key => $type)
                                            <option id="card_type_{{$key}}" value="{{$type->card_id}}">{{ucfirst($type->card_type)}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group row m-3">
                            <label for="card_title_update" class="col-sm-4 col-form-label">Card Title <small>*</small></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="card_title_update" name="card_title" placeholder="Enter card title">
                            </div>
                        </div>
                        <div class="form-group row m-3">
                            <label for="card_price_update" class="col-sm-4 col-form-label">Card Price <small>*</small> </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="card_price_update" name="card_price" placeholder="Enter card price">
                            </div>
                        </div>
                        <div class="form-group row m-3">
                            <label for="price_unit_update" class="col-sm-4 col-form-label">Price Unit <small>*</small> </label>
                            <div class="col-sm-8">
                                <select name="price_unit" id="price_unit_update" class="form-control">
                                    <option value="null">--Select price unit--</option>
                                    <option value="INR">INR</option>
                                    <option value="USD">USD</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row m-3">
                            <label for="exampleInputPassword6" class="col-sm-4 col-form-label">Current Card Image </label>
                            <div class="col-sm-8" id="current_image_url">
                                <h5 > no image </h5>
                            </div>
                        </div>
                        <div class="form-group row m-3">
                            <label for="card_image_update" class="col-sm-4 col-form-label">Card Image </label>
                            <div class="col-sm-8">
                                <input type="file" name="card_image" id="card_image_update" class="form-control" accept="image/*">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-rounded btn-outline-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-rounded btn-outline-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteCardModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('delete_card_management') }}" method="post" >
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Delete Card Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="card_id_delete" name="card_id" >
                        <label  class="col-form-label ml-3">Are you sure want to delete card category?</label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-rounded btn-outline-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-rounded btn-outline-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection

@section('js')
    <script>
        function functionAddCard(){
            $('#addNewCardModal').modal('show')
        }

        function functionupdateCard(card_mamagement_id){
            $.ajax({
                type:"POST",
                url:"{{route('card_management_fetch')}}",
                data:{'card_id':card_mamagement_id,'_token':'{{csrf_token()}}' },
                success: function(result){
                    console.log(result)
                    if (result.status === true) {
                        $('#card_type_update').html(`
                        <option class="form-control" >${result.data.card_type}</option>
                        `)
                        $('#card_title_update').val(result.data.card_management_title)
                        $('#card_price_update').val(result.data.card_management_price)
                        let inr;
                        if (result.data.card_management_price_unit === 'INR') {   inr = 'USD'  } else { inr = 'INR' }
                        $('#price_unit_update').html(`
                        <option class="form-control" selected value="${result.data.card_management_price_unit}">${result.data.card_management_price_unit}</option>
                        <option class="form-control"  value="${inr}">${inr}</option>
                        `)
                        if (result.data.card_management_image === null) {

                        } else {
                            $('#current_image_url').html(`
                        <img src="${result.data.card_management_image}" alt="card image" width="200" height="150">
                        <input type="hidden" name="old_img" value="${result.data.card_management_image}">
                        `)
                        }
                        $('#card_management_id').val(card_mamagement_id)
                        $('#updateCardModal').modal('show')
                    } else {
                        alert(result.msg)
                    }
                },
                error: function(jqxhr){
                    console.log(jqxhr.responseText)
                }
            })
        }

        function functionDelete(card_management_id){
            $('#card_id_delete').val(card_management_id)
            $('#deleteCardModal').modal('show')
        }
    </script>
@endsection
