<table id="tbl_enquiries" class="table table-bordered table-hover" style="width: 100%">
    <thead>
    <tr>
        <th>Date</th>
        <th>Name</th>
        <th>Email</th>
        <th>Contact Number</th>
        <th>Subject</th>
        <th>Message</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($enquiries as $enquiry)
        <tr>
            <td>{{$enquiry->created_at->format('d/m/Y')}}</td>
            <td>{{$enquiry->name}}</td>
            <td>{{$enquiry->email}}</td>
            <td>{{$enquiry->phone_number}}</td>
            <td>{{$enquiry->subject}}</td>
            <td>{{str_limit($enquiry->message, 20, '...')}}</td>
            <td>
                @can('view_enquiry_details', $enquiry)
                    <a href="{{url('enquiry/show/'. $enquiry->id)}}" class="btn btn-info btn-sm"><i class="fa fa-search"></i></a>
                @endcan
            </td>
        </tr>
    @endforeach
    </tbody>
</table>