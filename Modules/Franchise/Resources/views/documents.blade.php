<table class="table table-bordered">
    <thead>
    <tr>
        <th>Document Type</th>
        <th>Document</th>
        <th class="center">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($documents as $document)
        <tr>
            <td>{{$document->type->name}}</td>
            <td>{{$document->actual_file->name}}</td>
            <td class="center">
                <div class="btn-group btn-group-sm" role="group">
                    @can('view_franchise_documents', \Modules\Franchise\Entities\FranchiseDocument::class)
                        <button id="{{$document->actual_file->hash}}" value="{{$document->actual_file->extension}}" class="btn btn-info view-document"><i class="fa fa-search"></i></button>
                    @endcan
                    @can('delete_franchise_documents', \Modules\Franchise\Entities\FranchiseDocument::class)
                        <a href="{{url('franchise/delete-document/' . $document->id)}}" class="btn btn-danger delete-document"><i class="fa fa-times"></i></a>
                    @endcan
                    @can('download_franchise_documents', \Modules\Franchise\Entities\FranchiseDocument::class)
                        <a href="{{url('file/download/'. $document->actual_file->hash)}}" class="btn btn-success download-document"><i class="fa fa-download"></i></a>
                    @endcan
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>