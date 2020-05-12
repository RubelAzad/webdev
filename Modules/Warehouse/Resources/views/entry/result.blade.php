<hr>
@if($post)
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">Data found</h3>
        </div>
        <div class="panel-body no-padding">
        <table class="table table-bordered">
            <tr>
                <th>Tracking Number</th>
                <td>{{$post->tracking_no}}</td>
            </tr>
            <tr>
                <th>Sender</th>
                <td>{{$post->sender->name}}</td>
            </tr>
            <tr>
                <th>Receiver</th>
                <td>{{$post->receiver->name}}</td>
            </tr>
            <tr>
                <th>Number of Pieces</th>
                <td>{{$post->packages->count()}}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{$post->current_status->name}}</td>
            </tr>
            <tr>
                <th>Change Status</th>
                <td></td>
            </tr>
        </table>
        </div>
        <div class="panel-footer center">
            @if($warehouse->entries->where('post_id')->count() > 0)
                <button class="btn btn-primary submit"><i class="fa fa-save"></i> Update</button>
            @else
                <button class="btn btn-success receive" value="{{$post->id}}"><i class="fa fa-check"></i> Add Entry</button>
            @endif
            <button class="btn btn-danger cancel"><i class="fa fa-times"></i> Cancel</button>
        </div>
    </div>
@else
    <div class="alert alert-danger">
        <h3> Data not found! </h3>
        <button class="btn btn-warning cancel"><i class="fa fa-times"></i> Close</button>
    </div>
@endif