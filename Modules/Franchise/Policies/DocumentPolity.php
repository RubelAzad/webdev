<?php

namespace Modules\Franchise\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\User;

class DocumentPolity
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function view_franchise_documents(User $user){ return $user->isAllowed('view_franchise_documents' ); }
    public function upload_franchise_documents(User $user){ return $user->isAllowed('upload_franchise_documents' ); }
    public function download_franchise_documents(User $user){ return $user->isAllowed('download_franchise_documents' ); }
    public function delete_franchise_documents(User $user){ return $user->isAllowed('delete_franchise_documents' ); }
}
