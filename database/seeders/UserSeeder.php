<?php
namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Role::create([
            'name'       => 'Admin',
            'guard_name' => 'web',
        ]);
        $role = Role::pluck('id')->first();
        User::create([
            'name'     => 'ibnu',
            'email'    => 'ibnu@email.com',
            'password' => Hash::make('1234'),
            'role_id'  => $role,
        ]);
    }
}
