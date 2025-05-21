<?php

namespace Modules\Penilaian\Database\Seeders;

use App\Models\Core\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;

class UserTableSeeder extends Seeder
{
    protected $truncate;
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function __construct($truncate = true){
        $this->truncate = $truncate;
    }

    public function run()
    {
        // Model::unguard();

        // $this->call("OthersTableSeeder");
        User::where('username', '!=', 'super')->delete();
        Artisan::call('permission:create-permission-routes');
        User::insert([
            [
                'name' => 'Widura Hasta',
                'email' => 'widurategalrejo@gmail.com',
                'username' => 'widura',
                'password' => Hash::make('poliwangi123'),
                'unit' => 0,
                'staff' => 0,
                'role_aktif' => 'terdaftar',
                'status' => 2
            ],
            [
                'name' => 'John Doe',
                'email' => 'johndoe@gmail.com',
                'username' => 'Johndoe',
                'password' => Hash::make('poliwangi123'),
                'unit' => 0,
                'staff' => 0,
                'role_aktif' => 'operator',
                'status' => 2
            ],
            [
                'name' => 'Bjorka',
                'email' => 'bjorka@gmail.com',
                'username' => 'Bjorka',
                'password' => Hash::make('poliwangi123'),
                'unit' => 0,
                'staff' => 0,
                'role_aktif' => 'terdaftar',
                'status' => 2
            ],
        ]);
    }
}
