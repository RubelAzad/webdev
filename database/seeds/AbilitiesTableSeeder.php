<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Ability;

class AbilitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){

        Model::unguard();
        
        Ability::firstOrCreate(['title' => 'See all the users', 'ability' => 'see_all_users', 'model' => 'User',]);

        Ability::firstOrCreate(['title' => 'Add new user', 'ability' => 'add_new_user', 'model' => 'User',]);

        Ability::firstOrCreate(['title' => 'Edit user information', 'ability' => 'edit_user', 'model' => 'User',]);

        Ability::firstOrCreate(['title' => 'Change user status', 'ability' => 'change_user_status', 'model' => 'User',]);

        Ability::firstOrCreate(['title' => "See other's profile", 'ability' => 'see_user_profile', 'model' => 'User',]);

        Ability::firstOrCreate(['title' => 'Login as another user', 'ability' => 'login_as', 'model' => 'User',]);

        Ability::firstOrCreate(['title' => 'Delete user account', 'ability' => 'delete_user', 'model' => 'User',]);
        
        Ability::firstOrCreate(['title' => 'Change password for another user', 'ability' => 'change_user_password', 'model' => 'User',]);

        Ability::firstOrCreate(['title' => 'View user abilities', 'ability' => 'view_user_abilities', 'model' => 'User',]);

        Ability::firstOrCreate(['title' => 'Override user abilities', 'ability' => 'override_user_abilities', 'model' => 'User',]);


	     //============ End of User model ========================

        Ability::firstOrCreate(['title' => 'See all the available roles', 'ability' => 'see_all_roles', 'model' => 'Role',]);

        Ability::firstOrCreate(['title' => 'Create new role', 'ability' => 'add_new_role', 'model' => 'Role',]);

        Ability::firstOrCreate(['title' => 'Edit Role', 'ability' => 'edit_role', 'model' => 'Role',]);

        Ability::firstOrCreate(['title' => 'Change role status', 'ability' => 'update_role_status', 'model' => 'Role',]);

        Ability::firstOrCreate(['title' => 'Delete a role', 'ability' => 'delete_role', 'model' => 'Role',]);

        Ability::firstOrCreate(['title' => 'View current role assignment', 'ability' => 'view_current_role_assignment', 'model' => 'Role',]);

        Ability::firstOrCreate(['title' => 'Add or Remove role for user', 'ability' => 'make_change_on_roll_assignment', 'model' => 'Role',]);

        Ability::firstOrCreate(['title' => 'View role definition', 'ability' => 'view_role_definition', 'model' => 'Role',]);

        Ability::firstOrCreate(['title' => 'Update role definition', 'ability' => 'update_role_definition', 'model' => 'Role',]);

        //============ End of Role model ========================

        Ability::firstOrCreate(['title' => 'Manage System Configuration', 'ability' => 'view_settings', 'model' => 'System Configuration',]);

    }
}
