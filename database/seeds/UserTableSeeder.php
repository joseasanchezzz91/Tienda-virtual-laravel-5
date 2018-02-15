<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()

    {
        $data=array([
            'name'=>"jose",'apellido'=>'sanchez','email'=>'jose@mail.com','user'=>'jose','password'=> \Hash::make('1234567'),'type'=>'admin'
            ,'activo'=>1,'direccion'=>'venezuela'
        ],['name'=>"maria",'apellido'=>'sanchez','email'=>'maria@mail.com','user'=>'maria','password'=> \Hash::make('1234567'),'type'=>'user'
            ,'activo'=>1,'direccion'=>'venezuela']);


        User::insert($data);
    }
}
