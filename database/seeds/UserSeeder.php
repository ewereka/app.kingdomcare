<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::where('name', 'admin')->first();

        $sean = new User(array(
            'first_name' => env('USERS_SEAN_FIRST_NAME'),
            'last_name' => env('USERS_SEAN_LAST_NAME'),
            'email' => env('USERS_SEAN_EMAIL'),
            'password' => Hash::make(env('USERS_SEAN_PASSWORD')),
            'api_token' => Str::random(60),
            'phone' => env('USERS_SEAN_PHONE'),
            'city' => env('USERS_SEAN_CITY'),
            'region' => env('USERS_SEAN_REGION'),
            'dob' => env('USERS_SEAN_DOB'),
            'registration_complete' => true,
        ));
        $sean->save();
        $sean->roles()->attach($role_admin);

        if( in_array(App::environment(), ['development', 'local'])) {
            $role_sitter = Role::where('name', 'sitter')->first();
            $role_parent = Role::where('name', 'parent')->first();
            $role_premium = Role::where('name', 'premium')->first();
            $role_unknown = Role::where('name', 'unknown')->first();
            $role_incomplete = Role::where('name', 'incomplete')->first();

            $test_sitter = new User(array(
                'first_name' => 'Babysitter',
                'last_name' => 'McBeta',
                'email' => 'dev-test-sitter@kingdomcaresitters.com',
                'password' => Hash::make(env('USERS_TEST_PASSWORD')),
                'api_token' => Str::random(60),
                'phone' =>'6105551212',
                'dob' => Carbon\Carbon::createFromDate(2000,1,23)->toDateString()
            ));
            $test_sitter->save();
            $test_sitter->roles()->attach($role_sitter);

            $test_parent = new User(array(
                'first_name' => 'Parent',
                'last_name' => 'McBeta',
                'email' => 'dev-test-parent@kingdomcaresitters.com',
                'password' => Hash::make(env('USERS_TEST_PASSWORD')),
                'api_token' => Str::random(60),
                'phone' =>'6105551212',
                'dob' => Carbon\Carbon::createFromDate(1988,12,3)->toDateString()
            ));
            $test_parent->save();
            $test_parent->roles()->attach($role_parent);

            $test_sitter_premium = new User(array(
                'first_name' => 'Sitter-Plus',
                'last_name' => 'McBeta',
                'email' => 'dev-test-sitter-premium@kingdomcaresitters.com',
                'password' => Hash::make(env('USERS_TEST_PASSWORD')),
                'api_token' => Str::random(60),
                'phone' =>'6105551212',
                'dob' => Carbon\Carbon::createFromDate(1994,3,19)->toDateString()
            ));
            $test_sitter_premium->save();
            $test_sitter_premium->roles()->attach($role_sitter);
            $test_sitter_premium->roles()->attach($role_premium);

            $test_incomplete = new User(array(
                'first_name' => 'Incomplete',
                'last_name' => 'McBeta',
                'email' => 'dev-test-incomplete@kingdomcaresitters.com',
                'password' => Hash::make(env('USERS_TEST_PASSWORD')),
                'api_token' => Str::random(60),
                'phone' =>'6105551212',
                'dob' => Carbon\Carbon::createFromDate(1981,8,28)->toDateString()
            ));
            $test_incomplete->save();
            $test_incomplete->roles()->attach($role_incomplete);

            $test_unknown = new User(array(
                'first_name' => 'Unknown',
                'last_name' => 'McBeta',
                'email' => 'dev-test-unknown@kingdomcaresitters.com',
                'password' => Hash::make(env('USERS_TEST_PASSWORD')),
                'api_token' => Str::random(60),
                'phone' =>'6105551212',
                'dob' => Carbon\Carbon::createFromDate(1996,6,30)->toDateString()
            ));
            $test_unknown->save();
            $test_unknown->roles()->attach($role_unknown);
        }
    }
}
