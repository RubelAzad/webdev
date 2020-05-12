<?php

namespace Modules\Agent\Policies;

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

    public function view_agent_documents(User $user){ return $user->isAllowed('view_agent_documents' ); }
    public function upload_agent_documents(User $user){ return $user->isAllowed('upload_agent_documents' ); }
    public function download_agent_documents(User $user){ return $user->isAllowed('download_agent_documents' ); }
    public function delete_agent_documents(User $user){ return $user->isAllowed('delete_agent_documents' ); }
}
