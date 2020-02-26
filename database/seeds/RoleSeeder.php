<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = new Role();
        $role_admin->name = 'admin';
        $role_admin->description = 'Administrator';
        $role_admin->save();

        $role_editor = new Role();
        $role_editor->name = 'editor';
        $role_editor->description = 'Editor';
        $role_editor->save();

        $role_author = new Role();
        $role_author->name = 'author';
        $role_author->description = 'Author';
        $role_author->save();

        $role_sitter = new Role();
        $role_sitter->name = 'sitter';
        $role_sitter->description = 'Babysitter';
        $role_sitter->save();

        $role_parent = new Role();
        $role_parent->name = 'parent';
        $role_parent->description = 'Parent';
        $role_parent->save();

        $role_premium = new Role();
        $role_premium->name = 'premium';
        $role_premium->description = 'Premium';
        $role_premium->save();

        $role_incomplete = new Role();
        $role_incomplete->name = 'incomplete';
        $role_incomplete->description = 'Incomplete';
        $role_incomplete->save();

        $role_unknown = new Role();
        $role_unknown->name = 'unknown';
        $role_unknown->description = 'Unknown';
        $role_unknown->save();
    }
}
