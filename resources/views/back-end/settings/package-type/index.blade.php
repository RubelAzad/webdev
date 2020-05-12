@extends('back-end.layouts.app')

@push('scripts')
    <script>
    $(function () {
        $('#btn_create_new_type').click(function (e) {
            e.preventDefault();

            swal({
                title: 'Enter a new package type',
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'Save',
                showLoaderOnConfirm: true,
                inputValidator: (value) => {
                    return !value && 'You need to write something!'
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.value) {
                    axios.post('/settings/package-type-update', {
                        name: result.value
                    }).then((response) => {
                        let data = response.data;

                        if(data.success){
                            swal('Package type has been updated!', '', 'success').then(()=>{
                                document.location.reload();
                            })
                        }else {
                            swal('Package type could not be updated!', '', 'error').then(()=>{
                                document.location.reload();
                            })
                        }
                    });
                }
            });
        });

        $('#tbl_package_type').on('click', '.edit', function (e) {
            e.preventDefault();

            let data = $(this).data();

            axios.get('/settings/package-type-get/' + data.id)
                .then((response) => {
                    let this_package = response.data;

                    swal({
                        title: 'Update package type',
                        input: 'text',
                        inputValue: this_package.name,
                        inputAttributes: {
                            autocapitalize: 'off'
                        },
                        showCancelButton: true,
                        confirmButtonText: 'Save',
                        showLoaderOnConfirm: true,
                        inputValidator: (value) => {
                            return !value && 'You need to write something!'
                        },
                        allowOutsideClick: () => !Swal.isLoading()
                    }).then((result) => {

                        if (result.value) {
                            axios.post('/settings/package-type-update', {
                                type_id: this_package.id, name: result.value
                            }).then((response) => {
                                let data = response.data;

                                if(data.success){
                                    swal('Package type has been updated!', '', 'success').then(()=>{
                                        document.location.reload();
                                    })
                                }else {
                                    swal('Package type could not be updated!', '', 'error').then(()=>{
                                        document.location.reload();
                                    })
                                }
                            });
                        }
                    });
                });
        });


        $('#tbl_package_type').on('click', '.delete', function (e) {
            e.preventDefault();
            let link = $(this).attr('href');
            swal({
                title: "Are you sure?",
                text: "You are about to delete a package type!",
                type: "warning",
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!'
            }).then(function (result) {
                if(result.value){
                    $.LoadingOverlay('show');
                    window.location.href = link;
                }
            });

        });

    });
    </script>
@endpush

@section('top_right_corner_button_group')
    @can('manage_package_type', Modules\Cargo\Entities\CargoPackageType::class)
        <button id="btn_create_new_type" class="btn btn-primary"><i class="fa fa-plus"></i> Create New Type</button>
    @endcan
@endsection


@section('page_header')
    Manage Package Types
@endsection

@section('breadcrumb')
    <li class="active">Manage Package Types</li>
@endsection

@section('content')
    <div class="row">
        <article class="col-xs-12">

            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Package Types</h3></div>

                <div class="panel-body no-padding table-responsive">

                    <table id="tbl_package_type" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th class="center">SN</th>
                            <th>Name</th>
                            <th class="center">Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @if($i = 1)
                            @foreach($types as $type)
                                <tr>
                                    <td class="center">{{$i++}}</td>
                                    <td>{{$type->name}}</td>
                                    <td class="center">
                                        <div class="btn-group btn-group-sm" role="group">
                                            <button data-id="{{$type->id}}" class="btn btn-warning edit"><i class="fa fa-edit"></i></button>
                                            <a href="{{url('settings/package-type-delete/' . $type->id)}}" class="btn btn-danger delete"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>

                </div>

            </div>
        </article>
    </div>
@endsection