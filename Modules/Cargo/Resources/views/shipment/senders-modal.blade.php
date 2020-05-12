
<div class="modal fade" id="mdl_sender" style="overflow:hidden;" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times fa-fw"></i> </span></button>
                <h4 class="modal-title" id="myModalLabel">Lookup Sender</h4>
            </div>
            <div class="modal-body ">

                {{--                {!! Form::open(['url' => url('cargo/select-sender'), 'id' => 'frm_select_sender']) !!}--}}
                <table id="tbl_sender_list" class="table table-bordered table-hover table-condensed" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>SN</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th class="center">Postcode</th>
                        <th class="center">Phone Number</th>
                        <th class="center">Email</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($senders->count() && $i=1)
                        @foreach($senders as $sender)
                            <tr id="{{$sender->id}}">
                                <td>{{$i++}}</td>
                                <th>{{$sender->name}}</th>
                                <th>{{$sender->address_line_1}}</th>
                                <th class="center">{{$sender->postcode}}</th>
                                <th class="center">{{$sender->phone_number}}</th>
                                <th class="center">{{$sender->email}}</th>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
                {{--                {!! Form::close() !!}--}}

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="select_sender" type="button" class="btn btn-primary">Select</button>
            </div>
        </div>
    </div>
</div>