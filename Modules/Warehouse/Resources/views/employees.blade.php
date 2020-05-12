<table class="table table-hover table-bordered" style="width: 100%">
    <thead>
    <tr>
        <th>Name</th>
        <th class="center">Role</th>
        <th class="center">Actions</th>
    </tr>
    </thead>
    <tbody>
    @if($employees->count())
        @foreach($employees as $employee)
            <tr>
                <td>{{$employee->user->name}}</td>
                <td class="center">{{$employee->role->name}}</td>
                <td class="center">
                    @can('remove_employee_from_warehouse', \Modules\Warehouse\Entities\Warehouse::class)
                        <a href="{{url('warehouse/remove-employee/' . $employee->id)}}" class="btn btn-danger delete"><i class="fa fa-times"></i></a>
                    @endcan
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>