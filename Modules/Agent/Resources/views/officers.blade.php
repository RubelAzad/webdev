<button id="btn_add_employee" class="btn btn-primary"><i class="fa fa-user-plus"></i> Add Employee</button>
<table class="table table-bordered">
    <thead>
    <tr>
        <th>Name</th>
        <th>Designation</th>
        <th>Address</th>
        <th>Phone Number</th>
        <th>Email</th>
        <th class="center">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($officers as $officer)
        @php($user = \App\User::find($officer->user_id))
        <tr>
            <td>
                @can('see_user_profile', $user)
                    <a href="{{url('user/view/' . $user->id)}}">{{$officer->name}}</a>
                @else
                    {{$officer->name}}
                @endcan
            </td>
            <td>{{$officer->type->name}}</td>
            <td>{{trim($officer->address_line_1)}}{{$officer->address_line_2 ? ', ' . trim($officer->address_line_2) : ''}}{{$officer->address_line_3 ? ', ' . trim($officer->address_line_3) : ''}}{{trim($officer->city)}}{{$officer->county ? ', ' . trim($officer->county) : ''}}{{$officer->postcode ? ', ' . trim($officer->postcode) : ''}}, {{get_country_name(trim($officer->country))}}</td>
            <td>{{$officer->phone_number}}</td>
            <td>{{$officer->email}}</td>
            <td class="center">
                <div class="btn-group btn-group-sm" role="group">
                    @can('edit_agent_employees', \Modules\Agent\Entities\AgentEmployee::class)
                        <button data-employee_id="{{$officer->id}}" class="btn btn-warning edit"><i class="fa fa-edit"></i></button>
                    @endcan
                    @can('delete_agent_employees', \Modules\Agent\Entities\AgentEmployee::class)
                        <a href="{{url('agent/delete-employee/'. $officer->id)}}" class="btn btn-danger delete"><i class="fa fa-trash"></i></a>
                    @endcan
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>