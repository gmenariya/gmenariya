<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => '1',
                'title' => 'user_management_access',
            ],
            [
                'id'    => '2',
                'title' => 'permission_create',
            ],
            [
                'id'    => '3',
                'title' => 'permission_edit',
            ],
            [
                'id'    => '4',
                'title' => 'permission_show',
            ],
            [
                'id'    => '5',
                'title' => 'permission_delete',
            ],
            [
                'id'    => '6',
                'title' => 'permission_access',
            ],
            [
                'id'    => '7',
                'title' => 'role_create',
            ],
            [
                'id'    => '8',
                'title' => 'role_edit',
            ],
            [
                'id'    => '9',
                'title' => 'role_show',
            ],
            [
                'id'    => '10',
                'title' => 'role_delete',
            ],
            [
                'id'    => '11',
                'title' => 'role_access',
            ],
            [
                'id'    => '12',
                'title' => 'user_create',
            ],
            [
                'id'    => '13',
                'title' => 'user_edit',
            ],
            [
                'id'    => '14',
                'title' => 'user_show',
            ],
            [
                'id'    => '15',
                'title' => 'user_delete',
            ],
            [
                'id'    => '16',
                'title' => 'user_access',
            ],
            [
                'id'    => '17',
                'title' => 'xcategory_create',
            ],
            [
                'id'    => '18',
                'title' => 'xcategory_edit',
            ],
            [
                'id'    => '19',
                'title' => 'xcategory_show',
            ],
            [
                'id'    => '20',
                'title' => 'xcategory_delete',
            ],
            [
                'id'    => '21',
                'title' => 'xcategory_access',
            ],
            [
                'id'    => '22',
                'title' => 'category_create',
            ],
            [
                'id'    => '23',
                'title' => 'category_edit',
            ],
            [
                'id'    => '24',
                'title' => 'category_show',
            ],
            [
                'id'    => '25',
                'title' => 'category_delete',
            ],
            [
                'id'    => '26',
                'title' => 'category_access',
            ],
            [
                'id'    => '27',
                'title' => 'testpost_create',
            ],
            [
                'id'    => '28',
                'title' => 'testpost_edit',
            ],
            [
                'id'    => '29',
                'title' => 'testpost_show',
            ],
            [
                'id'    => '30',
                'title' => 'testpost_delete',
            ],
            [
                'id'    => '31',
                'title' => 'testpost_access',
            ],
            [
                'id'    => '32',
                'title' => 'testmodule_create',
            ],
            [
                'id'    => '33',
                'title' => 'testmodule_edit',
            ],
            [
                'id'    => '34',
                'title' => 'testmodule_show',
            ],
            [
                'id'    => '35',
                'title' => 'testmodule_delete',
            ],
            [
                'id'    => '36',
                'title' => 'testmodule_access',
            ],
        ];

        Permission::insert($permissions);
    }
}
