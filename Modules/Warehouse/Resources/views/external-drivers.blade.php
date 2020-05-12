<table class="table table-hover table-bordered" style="width: 100%">
    <thead>
    <tr>
        <th>Name</th>
        <th class="center">Contact Number</th>
        <th>Email</th>
        <th>Address</th>
        <th>Note</th>
        <th class="center">Actions</th>
    </tr>
    </thead>
    <tbody>
    @if($drivers->count())
        @foreach($drivers as $driver)
            <tr>
                <td>{{$driver->name}}</td>
                <td class="center">{{$driver->phone_number}}</td>
                <td>{{$driver->email}}</td>
                <td>{{$driver->address}}</td>
                <td>{{$driver->note}}</td>
                <td class="center">
                    @can('manage_external_driver_for_warehouse', $house)
                        <a href="{{url('warehouse/delete-external-driver/' . $driver->id)}}" class="btn btn-danger delete"><i class="fa fa-times"></i></a>
                    @endcan
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>