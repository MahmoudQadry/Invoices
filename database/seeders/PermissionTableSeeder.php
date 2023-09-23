<?php



namespace Database\Seeders;



use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;



class PermissionTableSeeder extends Seeder

{

    /**

     * Run the database seeds.

     */

    public function run(): void

    {

        $permissions = [

           'add_user',

           'edit_user',

           'delete_user',

           'add_section',

           'add_product',

           'delete_invoice',

           'sendToArchive',

           'addInvoice',
           'add_role',
           'show_roles',
           'edit_role',
           'delete_role',

        ];



        foreach ($permissions as $permission) {

             Permission::create(['name' => $permission]);

        }

    }

}