@extends('admin.layouts.app')

@section('title')
    Card | Categories
@endsection

@section('content')
    <div class="row p-2">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body ">
                    <div class=" border-bottom">
                        <div class="row">
                            <div class="col-sm-8 text-right">

                                <label style="margin-right: 7rem; font-size: 30px;">Card Categories</label>
                            </div>
                            <div class="col-sm text-right mb-2">
                                <button type="button" class="btn btn-rounded btn-outline-success" onclick="functionAddCard()" data-toggle="tooltip" title="Add card category"><i class="mdi mdi-library-plus menu-icon"></i>&nbsp; Add category
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
                                    card description
                                </th>
                                <th>
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(sizeof($card_categories) > 0)
                                @foreach( $card_categories as $key => $card)
                                    <tr id="row_{{$key}}">
                                        <td class="py-1">
                                            {{ $key+1 }}
                                        </td>
                                        <td>
                                            {{ ucfirst($card->card_type )}}
                                        </td>
                                        <td>
                                            {{ $card->card_description }}
                                        </td>
                                        <td >
                                            <button type="button" class="btn btn-rounded btn-inverse-primary btn-sm" onclick="functionupdateCard({{$card->card_id}})" data-toggle="tooltip" title="Update Card category"><i class="mdi mdi-table-edit menu-icon"></i>
                                            </button>
                                            <button type="button" class="btn btn-rounded btn-inverse-danger btn-sm" onclick="functionDelete({{$card->card_id}})" data-toggle="tooltip" title="Delete Card category"><i class="mdi mdi-delete-forever menu-icon"></i>
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
                <form action="{{ route('add_card') }}" method="post" >
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add Card Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row m-3">
                            <label for="exampleInputPassword2" class="col-sm-4 col-form-label">Card Type <small>*</small></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="exampleInputPassword2" name="card_type" required placeholder="Enter Card type">
                            </div>
                        </div>
                        <div class="form-group row m-3">
                            <label for="exampleInputPassword3" class="col-sm-4 col-form-label">Card Description</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" name="card_desc" id="exampleInputPassword3" cols="30" rows="5"></textarea>
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
                <form action="{{ route('update_card') }}" method="post" >
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Update Card Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row m-3">
                            <label for="cardType" class="col-sm-4 col-form-label">Card Type <small>*</small></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="cardType" name="card_type" required placeholder="Enter Card type">
                                <input type="hidden" id="card_id_update" name="card_id" >
                            </div>
                        </div>
                        <div class="form-group row m-3">
                            <label for="CardDesc" class="col-sm-4 col-form-label">Card Description</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" name="card_desc" id="CardDesc" cols="15" rows="5"></textarea>
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
                <form action="{{ route('delete_card') }}" method="post" >
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

        function functionupdateCard(card_id){
            $.ajax({
                type:"POST",
                url:"{{route('card_fetch')}}",
                data:{'card_id':card_id,'_token':'{{csrf_token()}}' },
                success: function(result){
                    console.log(result)
                    if (result.status === true) {
                        $('#cardType').val(result.data.card_type)
                        $('#card_id_update').val(card_id)
                        $('#CardDesc').val(result.data.card_description)
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

        function functionDelete(card_id){
            $('#card_id_delete').val(card_id)
            $('#deleteCardModal').modal('show')
        }
    </script>
@endsection
