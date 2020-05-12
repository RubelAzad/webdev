<?php

namespace Modules\Site\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SitePolicy
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

    public function manage_website(User $user){
        return $user->isAllowed('manage_website');
    }

    public function manage_menu(User $user){
        return $user->isAllowed('manage_menu');
    }

    public function manage_feeds(User $user){
        return $user->isAllowed('manage_feeds');
    }

    public function manage_pages(User $user){
        return $user->isAllowed('manage_pages');
    }

    public function manage_news(User $user){
        return $user->isAllowed('manage_news');
    }

    public function manage_partners(User $user){
        return $user->isAllowed('manage_partners');
    }

    public function manage_services(User $user){
        return $user->isAllowed('manage_services');
    }

    public function manage_faqs(User $user){
        return $user->isAllowed('manage_faqs');
    }

    public function manage_slide_shows(User $user){
        return $user->isAllowed('manage_slide_shows');
    }

    public function manage_testimonials(User $user){
        return $user->isAllowed('manage_testimonials');
    }
    public function manage_contact(User $user){
        return $user->isAllowed('manage_contact');
    }
}
