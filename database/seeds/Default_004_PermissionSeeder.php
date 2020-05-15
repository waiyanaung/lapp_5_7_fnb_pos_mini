<?php
/**
 * Created by Visual Studio Code.
 * Author: william
 * Date: 11/2/2016
 * Time: 2:18 PM
 */
use Illuminate\Database\Seeder;

class Default_004_PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        DB::table('core_permissions')->delete();
        $existingPermissions = DB::select('SELECT id FROM core_permissions');
        $today = date('Y-m-d H:i:s');

        $permissions = array(

            // Roles
            ['id' => 1, 'module' => 'Role', 'name' => 'Listing', 'description' => 'Role Listing', 'url' => 'backend_app/role', 'created_by' => 1, 'created_at' => $today],
            ['id' => 2, 'module' => 'Role', 'name' => 'New', 'description' => 'Role New', 'url' => 'backend_app/role/create', 'created_by' => 1, 'created_at' => $today],
            ['id' => 3, 'module' => 'Role', 'name' => 'Store', 'description' => 'Role Store', 'url' => 'backend_app/role/store', 'created_by' => 1, 'created_at' => $today],
            ['id' => 4, 'module' => 'Role', 'name' => 'Edit', 'description' => 'Role Edit', 'url' => 'backend_app/role/edit', 'created_by' => 1, 'created_at' => $today],
            ['id' => 5, 'module' => 'Role', 'name' => 'Update', 'description' => 'Role Update', 'url' => 'backend_app/role/update', 'created_by' => 1, 'created_at' => $today],
            ['id' => 6, 'module' => 'Role', 'name' => 'Destroy', 'description' => 'Role Destroy', 'url' => 'backend_app/role/destroy', 'created_by' => 1, 'created_at' => $today],
            ['id' => 7, 'module' => 'Role', 'name' => 'Permission View', 'description' => 'Role Permission View', 'url' => 'backend_app/rolePermission', 'created_by' => 1, 'created_at' => $today],
            ['id' => 8, 'module' => 'Role', 'name' => 'Permission Assign', 'description' => 'Role Permission Assign', 'url' => 'backend_app/rolePermissionAssign', 'created_by' => 1, 'created_at' => $today],
            ['id' => 9, 'module' => 'Role', 'name' => 'Activate', 'description' => 'Role Activate', 'url' => 'backend_app/role/enable', 'created_by' => 1, 'created_at' => $today],

            // Users
            ['id' => 11, 'module' => 'User', 'name' => 'Listing', 'description' => 'User Listing', 'url' => 'backend_app/user', 'created_by' => 1, 'created_at' => $today],
            ['id' => 12, 'module' => 'User', 'name' => 'New', 'description' => 'User New', 'url' => 'backend_app/user/create', 'created_by' => 1, 'created_at' => $today],
            ['id' => 13, 'module' => 'User', 'name' => 'Store', 'description' => 'User Store', 'url' => 'backend_app/user/store', 'created_by' => 1, 'created_at' => $today],
            ['id' => 14, 'module' => 'User', 'name' => 'Edit', 'description' => 'User Edit', 'url' => 'backend_app/user/edit', 'created_by' => 1, 'created_at' => $today],
            ['id' => 15, 'module' => 'User', 'name' => 'Update', 'description' => 'User Update', 'url' => 'backend_app/user/update', 'created_by' => 1, 'created_at' => $today],
            ['id' => 16, 'module' => 'User', 'name' => 'Destroy', 'description' => 'User Destroy', 'url' => 'backend_app/user/destroy', 'created_by' => 1, 'created_at' => $today],
            // ['id' => 17, 'module' => 'User', 'name' => 'Auth', 'description' => 'Getting Auth User', 'url' => 'backend_app/userAuth', 'created_by' => 1, 'created_at' => $today],
            ['id' => 18, 'module' => 'User', 'name' => 'Profile', 'description' => 'User Profile', 'url' => 'backend_app/user/profile', 'created_by' => 1, 'created_at' => $today],
            ['id' => 19, 'module' => 'User', 'name' => 'Password Edit and Update', 'description' => 'User Edit and Update Password', 'url' => 'backend_app/user/password', 'created_by' => 1, 'created_at' => $today],

            //user disable/enable
            ['id' => 21, 'module' => 'User', 'name' => 'Disable', 'description' => 'User Disable', 'url' => 'backend_app/user/disable', 'created_by' => 1, 'created_at' => $today],
            ['id' => 22, 'module' => 'User', 'name' => 'Enable', 'description' => 'User Enable', 'url' => 'backend_app/user/enable', 'created_by' => 1, 'created_at' => $today],
            ['id' => 23, 'module' => 'User', 'name' => 'Disabled Users', 'description' => 'Disabled User List', 'url' => 'backend_app/user/disabled_users', 'created_by' => 1, 'created_at' => $today],
            ['id' => 24, 'module' => 'User', 'name' => 'Enable', 'description' => 'User Multiple Enable', 'url' => 'backend_app/user/multipleenable', 'created_by' => 1, 'created_at' => $today],

            // Permissions
            ['id' => 31, 'module' => 'Permission', 'name' => 'Listing', 'description' => 'Permission Listing', 'url' => 'backend_app/permission', 'created_by' => 1, 'created_at' => $today],
            // ['id'=>32,'module'=>'Permission','name'=>'New','description'=>'Permission New','url'=>'backend_app/permission/create','created_by'=>1,'created_at'=>$today],
            // ['id'=>33,'module'=>'Permission','name'=>'Store','description'=>'Permission Store','url'=>'backend_app/permission/store','created_by'=>1,'created_at'=>$today],
            // ['id'=>34,'module'=>'Permission','name'=>'Edit','description'=>'Permission Edit','url'=>'backend_app/permission/edit','created_by'=>1,'created_at'=>$today],
            // ['id'=>35,'module'=>'Permission','name'=>'Update','description'=>'Permission Update','url'=>'backend_app/permission/update','created_by'=>1,'created_at'=>$today],
            // ['id'=>36,'module'=>'Permission','name'=>'Destroy','description'=>'Permission Destroy','url'=>'backend_app/permission/destroy','created_by'=>1,'created_at'=>$today],

            // Country
            ['id' => 41, 'module' => 'Country', 'name' => 'Listing', 'description' => 'Country Listing', 'url' => 'backend_app/country', 'created_by' => 1, 'created_at' => $today],
            ['id' => 42, 'module' => 'Country', 'name' => 'New', 'description' => 'Country New', 'url' => 'backend_app/country/create', 'created_by' => 1, 'created_at' => $today],
            ['id' => 43, 'module' => 'Country', 'name' => 'store', 'description' => 'Country Store', 'url' => 'backend_app/country/store', 'created_by' => 1, 'created_at' => $today],
            ['id' => 44, 'module' => 'Country', 'name' => 'Edit', 'description' => 'Country Edit', 'url' => 'backend_app/country/edit', 'created_by' => 1, 'created_at' => $today],
            ['id' => 45, 'module' => 'Country', 'name' => 'Update', 'description' => 'Country Update', 'url' => 'backend_app/country/update', 'created_by' => 1, 'created_at' => $today],
            ['id' => 46, 'module' => 'Country', 'name' => 'Destroy', 'description' => 'Country Destroy', 'url' => 'backend_app/country/destroy', 'created_by' => 1, 'created_at' => $today],
            ['id' => 47, 'module' => 'Country', 'name' => 'Activate', 'description' => 'Country Activate', 'url' => 'backend_app/country/enable', 'created_by' => 1, 'created_at' => $today],

            // Township
            ['id' => 51, 'module' => 'Township', 'name' => 'Listing', 'description' => 'Township Listing', 'url' => 'backend_app/township', 'created_by' => 1, 'created_at' => $today],
            ['id' => 52, 'module' => 'Township', 'name' => 'New', 'description' => 'Township New', 'url' => 'backend_app/township/create', 'created_by' => 1, 'created_at' => $today],
            ['id' => 53, 'module' => 'Township', 'name' => 'store', 'description' => 'Township Store', 'url' => 'backend_app/township/store', 'created_by' => 1, 'created_at' => $today],
            ['id' => 54, 'module' => 'Township', 'name' => 'Edit', 'description' => 'Township Edit', 'url' => 'backend_app/township/edit', 'created_by' => 1, 'created_at' => $today],
            ['id' => 55, 'module' => 'Township', 'name' => 'Update', 'description' => 'Township Update', 'url' => 'backend_app/township/update', 'created_by' => 1, 'created_at' => $today],
            ['id' => 56, 'module' => 'Township', 'name' => 'Destroy', 'description' => 'Township Destroy', 'url' => 'backend_app/township/destroy', 'created_by' => 1, 'created_at' => $today],
            ['id' => 57, 'module' => 'Township', 'name' => 'Activate', 'description' => 'Township Activate', 'url' => 'backend_app/township/enable', 'created_by' => 1, 'created_at' => $today],

            // City
            ['id' => 61, 'module' => 'City', 'name' => 'Listing', 'description' => 'City Listing', 'url' => 'backend_app/city', 'created_by' => 1, 'created_at' => $today],
            ['id' => 62, 'module' => 'City', 'name' => 'New', 'description' => 'City New', 'url' => 'backend_app/city/create', 'created_by' => 1, 'created_at' => $today],
            ['id' => 63, 'module' => 'City', 'name' => 'store', 'description' => 'City Store', 'url' => 'backend_app/city/store', 'created_by' => 1, 'created_at' => $today],
            ['id' => 64, 'module' => 'City', 'name' => 'Edit', 'description' => 'City Edit', 'url' => 'backend_app/city/edit', 'created_by' => 1, 'created_at' => $today],
            ['id' => 65, 'module' => 'City', 'name' => 'Update', 'description' => 'City Update', 'url' => 'backend_app/city/update', 'created_by' => 1, 'created_at' => $today],
            ['id' => 66, 'module' => 'City', 'name' => 'Destroy', 'description' => 'City Destroy', 'url' => 'backend_app/city/destroy', 'created_by' => 1, 'created_at' => $today],
            ['id' => 67, 'module' => 'City', 'name' => 'Activate', 'description' => 'City Activate', 'url' => 'backend_app/city/enable', 'created_by' => 1, 'created_at' => $today],

            // Ajax Country and City
            ['id' => 71, 'module' => 'Country', 'name' => 'Jquery Validation', 'description' => 'Country Jquery Validation', 'url' => 'backend_app/country/check_country_name', 'created_by' => 1, 'created_at' => $today],
            ['id' => 72, 'module' => 'City', 'name' => 'Jquery Validation', 'description' => 'City Jquery Validation', 'url' => 'backend_app/city/check_city_name', 'created_by' => 1, 'created_at' => $today],

            // System Config
            ['id' => 81, 'module' => 'Backend Config', 'name' => 'View', 'description' => 'Editing', 'url' => 'backend_app/config', 'created_by' => 1, 'created_at' => $today],
            ['id' => 82, 'module' => 'Backend Multi Language', 'name' => 'Multi_Language', 'description' => 'Backend Multi_Language', 'url' => 'backend_app/language', 'created_by' => 1, 'created_at' => $today],

            // System Reference
            ['id' => 83, 'module' => 'Backend_System_reference', 'name' => 'Backend_System_reference', 'description' => 'Backend_System_reference', 'url' => 'backend_app/reference', 'created_by' => 1, 'created_at' => $today],


            // Page
            ['id' => 91, 'module' => 'Page', 'name' => 'Listing', 'description' => 'Page Listing', 'url' => 'backend_app/page', 'created_by' => 1, 'created_at' => $today],
            ['id' => 92, 'module' => 'Page', 'name' => 'Edit', 'description' => 'Page Edit', 'url' => 'backend_app/page/edit', 'created_by' => 1, 'created_at' => $today],
            ['id' => 93, 'module' => 'Page', 'name' => 'Update', 'description' => 'Page Update', 'url' => 'backend_app/page/update', 'created_by' => 1, 'created_at' => $today],

            //Activity Log
            ['id' => 101, 'module' => 'Activity Log', 'name' => 'Activity Log', 'description' => 'Activity Log', 'url' => 'backend_app/activities', 'created_by' => 1, 'created_at' => $today],

            //Faq Information
            ['id' => 102, 'module' => 'FaqInformation', 'name' => 'View and Store', 'description' => 'Faq Information View and Store', 'url' => 'backend_app/faq_information', 'created_by' => 1, 'created_at' => $today],

            //About Us Information
            ['id' => 103, 'module' => 'About_Us', 'name' => 'View and Store', 'description' => 'About Us View and Store', 'url' => 'backend_app/about_us', 'created_by' => 1, 'created_at' => $today],

            //Contact Us Information Address
            ['id' => 104, 'module' => 'Contact_Us', 'name' => 'View and Store Contact Address', 'description' => 'Contact Us Address View and Store', 'url' => 'backend_app/contact_us/address', 'created_by' => 1, 'created_at' => $today],

            //Terms and Condition
            ['id' => 105, 'module' => 'Terms_and_Condition', 'name' => 'View and Store', 'description' => 'Terms and Conditions Information View and Store', 'url' => 'backend_app/terms_and_conditions', 'created_by' => 1, 'created_at' => $today],

            // Organization
            ['id' => 121, 'module' => 'Organization', 'name' => 'Listing', 'description' => 'Organization Listing', 'url' => 'backend_app/organization', 'created_by' => 1, 'created_at' => $today],
            ['id' => 122, 'module' => 'Organization', 'name' => 'New', 'description' => 'Organization New', 'url' => 'backend_app/organization/create', 'created_by' => 1, 'created_at' => $today],
            ['id' => 123, 'module' => 'Organization', 'name' => 'store', 'description' => 'Organization Store', 'url' => 'backend_app/organization/store', 'created_by' => 1, 'created_at' => $today],
            ['id' => 124, 'module' => 'Organization', 'name' => 'Edit', 'description' => 'Organization Edit', 'url' => 'backend_app/organization/edit', 'created_by' => 1, 'created_at' => $today],
            ['id' => 125, 'module' => 'Organization', 'name' => 'Update', 'description' => 'Organization Update', 'url' => 'backend_app/organization/update', 'created_by' => 1, 'created_at' => $today],
            ['id' => 126, 'module' => 'Organization', 'name' => 'Destroy', 'description' => 'Organization Destroy', 'url' => 'backend_app/organization/destroy', 'created_by' => 1, 'created_at' => $today],

            // Project
            ['id' => 131, 'module' => 'Project', 'name' => 'Listing', 'description' => 'Project Listing', 'url' => 'backend_app/project', 'created_by' => 1, 'created_at' => $today],
            ['id' => 132, 'module' => 'Project', 'name' => 'New', 'description' => 'Project New', 'url' => 'backend_app/project/create', 'created_by' => 1, 'created_at' => $today],
            ['id' => 133, 'module' => 'Project', 'name' => 'store', 'description' => 'Project Store', 'url' => 'backend_app/project/store', 'created_by' => 1, 'created_at' => $today],
            ['id' => 134, 'module' => 'Project', 'name' => 'Edit', 'description' => 'Project Edit', 'url' => 'backend_app/project/edit', 'created_by' => 1, 'created_at' => $today],
            ['id' => 135, 'module' => 'Project', 'name' => 'Update', 'description' => 'Project Update', 'url' => 'backend_app/project/update', 'created_by' => 1, 'created_at' => $today],
            ['id' => 136, 'module' => 'Project', 'name' => 'Destroy', 'description' => 'Project Destroy', 'url' => 'backend_app/project/destroy', 'created_by' => 1, 'created_at' => $today],

            // Location
            ['id' => 141, 'module' => 'Location', 'name' => 'Listing', 'description' => 'Location Listing', 'url' => 'backend_app/location', 'created_by' => 1, 'created_at' => $today],
            ['id' => 142, 'module' => 'Location', 'name' => 'New', 'description' => 'Location New', 'url' => 'backend_app/location/create', 'created_by' => 1, 'created_at' => $today],
            ['id' => 143, 'module' => 'Location', 'name' => 'store', 'description' => 'Location Store', 'url' => 'backend_app/location/store', 'created_by' => 1, 'created_at' => $today],
            ['id' => 144, 'module' => 'Location', 'name' => 'Edit', 'description' => 'Location Edit', 'url' => 'backend_app/location/edit', 'created_by' => 1, 'created_at' => $today],
            ['id' => 145, 'module' => 'Location', 'name' => 'Update', 'description' => 'Location Update', 'url' => 'backend_app/location/update', 'created_by' => 1, 'created_at' => $today],
            ['id' => 146, 'module' => 'Location', 'name' => 'Destroy', 'description' => 'Location Destroy', 'url' => 'backend_app/location/destroy', 'created_by' => 1, 'created_at' => $today],

            // Document
            ['id' => 151, 'module' => 'Document', 'name' => 'Listing', 'description' => 'Document Listing', 'url' => 'backend_app/document', 'created_by' => 1, 'created_at' => $today],
            ['id' => 152, 'module' => 'Document', 'name' => 'New', 'description' => 'Document New', 'url' => 'backend_app/document/create', 'created_by' => 1, 'created_at' => $today],
            ['id' => 153, 'module' => 'Document', 'name' => 'store', 'description' => 'Document Store', 'url' => 'backend_app/document/store', 'created_by' => 1, 'created_at' => $today],
            ['id' => 154, 'module' => 'Document', 'name' => 'Edit', 'description' => 'Document Edit', 'url' => 'backend_app/document/edit', 'created_by' => 1, 'created_at' => $today],
            ['id' => 155, 'module' => 'Document', 'name' => 'Update', 'description' => 'Document Update', 'url' => 'backend_app/document/update', 'created_by' => 1, 'created_at' => $today],
            ['id' => 156, 'module' => 'Document', 'name' => 'Destroy', 'description' => 'Document Destroy', 'url' => 'backend_app/document/destroy', 'created_by' => 1, 'created_at' => $today],

            // Checklistquestion
            ['id' => 161, 'module' => 'Checklistquestion', 'name' => 'Listing', 'description' => 'Checklistquestion Listing', 'url' => 'backend_app/checklistquestion', 'created_by' => 1, 'created_at' => $today],
            ['id' => 162, 'module' => 'Checklistquestion', 'name' => 'New', 'description' => 'Checklistquestion New', 'url' => 'backend_app/checklistquestion/create', 'created_by' => 1, 'created_at' => $today],
            ['id' => 163, 'module' => 'Checklistquestion', 'name' => 'store', 'description' => 'Checklistquestion Store', 'url' => 'backend_app/checklistquestion/store', 'created_by' => 1, 'created_at' => $today],
            ['id' => 164, 'module' => 'Checklistquestion', 'name' => 'Edit', 'description' => 'Checklistquestion Edit', 'url' => 'backend_app/checklistquestion/edit', 'created_by' => 1, 'created_at' => $today],
            ['id' => 165, 'module' => 'Checklistquestion', 'name' => 'Update', 'description' => 'Checklistquestion Update', 'url' => 'backend_app/checklistquestion/update', 'created_by' => 1, 'created_at' => $today],
            ['id' => 166, 'module' => 'Checklistquestion', 'name' => 'Destroy', 'description' => 'Checklistquestion Destroy', 'url' => 'backend_app/checklistquestion/destroy', 'created_by' => 1, 'created_at' => $today],

            // Checklistupload
            ['id' => 171, 'module' => 'Checklistupload', 'name' => 'Listing', 'description' => 'Checklistupload Listing', 'url' => 'backend_app/checklistupload', 'created_by' => 1, 'created_at' => $today],
            ['id' => 172, 'module' => 'Checklistupload', 'name' => 'New', 'description' => 'Checklistupload New', 'url' => 'backend_app/checklistupload/create', 'created_by' => 1, 'created_at' => $today],
            ['id' => 173, 'module' => 'Checklistupload', 'name' => 'store', 'description' => 'Checklistupload Store', 'url' => 'backend_app/checklistupload/store', 'created_by' => 1, 'created_at' => $today],
            ['id' => 174, 'module' => 'Checklistupload', 'name' => 'Edit', 'description' => 'Checklistupload Edit', 'url' => 'backend_app/checklistupload/edit', 'created_by' => 1, 'created_at' => $today],
            ['id' => 175, 'module' => 'Checklistupload', 'name' => 'Update', 'description' => 'Checklistupload Update', 'url' => 'backend_app/checklistupload/update', 'created_by' => 1, 'created_at' => $today],
            ['id' => 176, 'module' => 'Checklistupload', 'name' => 'Destroy', 'description' => 'Checklistupload Destroy', 'url' => 'backend_app/checklistupload/destroy', 'created_by' => 1, 'created_at' => $today],

            // Article
            ['id' => 181, 'module' => 'Article', 'name' => 'Listing', 'description' => 'Article Listing', 'url' => 'backend_app/article', 'created_by' => 1, 'created_at' => $today],
            ['id' => 182, 'module' => 'Article', 'name' => 'New', 'description' => 'Article New', 'url' => 'backend_app/article/create', 'created_by' => 1, 'created_at' => $today],
            ['id' => 183, 'module' => 'Article', 'name' => 'store', 'description' => 'Article Store', 'url' => 'backend_app/article/store', 'created_by' => 1, 'created_at' => $today],
            ['id' => 184, 'module' => 'Article', 'name' => 'Edit', 'description' => 'Article Edit', 'url' => 'backend_app/article/edit', 'created_by' => 1, 'created_at' => $today],
            ['id' => 185, 'module' => 'Article', 'name' => 'Update', 'description' => 'Article Update', 'url' => 'backend_app/article/update', 'created_by' => 1, 'created_at' => $today],
            ['id' => 186, 'module' => 'Article', 'name' => 'Destroy', 'description' => 'Article Destroy', 'url' => 'backend_app/article/destroy', 'created_by' => 1, 'created_at' => $today],
            ['id' => 187, 'module' => 'Article', 'name' => 'Activate', 'description' => 'Article Activate', 'url' => 'backend_app/article/enable', 'created_by' => 1, 'created_at' => $today],

            // Articleimage
            ['id' => 191, 'module' => 'Articleimage', 'name' => 'Listing', 'description' => 'Articleimage Listing', 'url' => 'backend_app/articleimage', 'created_by' => 1, 'created_at' => $today],
            ['id' => 192, 'module' => 'Articleimage', 'name' => 'New', 'description' => 'Articleimage New', 'url' => 'backend_app/articleimage/create', 'created_by' => 1, 'created_at' => $today],
            ['id' => 193, 'module' => 'Articleimage', 'name' => 'store', 'description' => 'Articleimage Store', 'url' => 'backend_app/articleimage/store', 'created_by' => 1, 'created_at' => $today],
            ['id' => 194, 'module' => 'Articleimage', 'name' => 'Edit', 'description' => 'Articleimage Edit', 'url' => 'backend_app/articleimage/edit', 'created_by' => 1, 'created_at' => $today],
            ['id' => 195, 'module' => 'Articleimage', 'name' => 'Update', 'description' => 'Articleimage Update', 'url' => 'backend_app/articleimage/update', 'created_by' => 1, 'created_at' => $today],
            ['id' => 196, 'module' => 'Articleimage', 'name' => 'Destroy', 'description' => 'Articleimage Destroy', 'url' => 'backend_app/articleimage/destroy', 'created_by' => 1, 'created_at' => $today],

            // Gallery
            ['id' => 201, 'module' => 'Gallery', 'name' => 'Listing', 'description' => 'Gallery Listing', 'url' => 'backend_app/gallery', 'created_by' => 1, 'created_at' => $today],
            ['id' => 202, 'module' => 'Gallery', 'name' => 'New', 'description' => 'Gallery New', 'url' => 'backend_app/gallery/create', 'created_by' => 1, 'created_at' => $today],
            ['id' => 203, 'module' => 'Gallery', 'name' => 'store', 'description' => 'Gallery Store', 'url' => 'backend_app/gallery/store', 'created_by' => 1, 'created_at' => $today],
            ['id' => 204, 'module' => 'Gallery', 'name' => 'Edit', 'description' => 'Gallery Edit', 'url' => 'backend_app/gallery/edit', 'created_by' => 1, 'created_at' => $today],
            ['id' => 205, 'module' => 'Gallery', 'name' => 'Update', 'description' => 'Gallery Update', 'url' => 'backend_app/gallery/update', 'created_by' => 1, 'created_at' => $today],
            ['id' => 206, 'module' => 'Gallery', 'name' => 'Destroy', 'description' => 'Gallery Destroy', 'url' => 'backend_app/gallery/destroy', 'created_by' => 1, 'created_at' => $today],
            ['id' => 207, 'module' => 'Gallery', 'name' => 'Activate', 'description' => 'Gallery Activate', 'url' => 'backend_app/gallery/enable', 'created_by' => 1, 'created_at' => $today],

            // Galleryimage
            ['id' => 211, 'module' => 'Galleryimage', 'name' => 'Listing', 'description' => 'Galleryimage Listing', 'url' => 'backend_app/galleryimage', 'created_by' => 1, 'created_at' => $today],
            ['id' => 212, 'module' => 'Galleryimage', 'name' => 'New', 'description' => 'Galleryimage New', 'url' => 'backend_app/galleryimage/create', 'created_by' => 1, 'created_at' => $today],
            ['id' => 213, 'module' => 'Galleryimage', 'name' => 'store', 'description' => 'Galleryimage Store', 'url' => 'backend_app/galleryimage/store', 'created_by' => 1, 'created_at' => $today],
            ['id' => 214, 'module' => 'Galleryimage', 'name' => 'Edit', 'description' => 'Galleryimage Edit', 'url' => 'backend_app/galleryimage/edit', 'created_by' => 1, 'created_at' => $today],
            ['id' => 215, 'module' => 'Galleryimage', 'name' => 'Update', 'description' => 'Galleryimage Update', 'url' => 'backend_app/galleryimage/update', 'created_by' => 1, 'created_at' => $today],
            ['id' => 216, 'module' => 'Galleryimage', 'name' => 'Destroy', 'description' => 'Galleryimage Destroy', 'url' => 'backend_app/galleryimage/destroy', 'created_by' => 1, 'created_at' => $today],
            ['id' => 217, 'module' => 'Galleryimage', 'name' => 'Add Images', 'description' => 'Galleryimage Add Images', 'url' => 'backend_app/galleryimage/add', 'created_by' => 1, 'created_at' => $today],

            // Product
            ['id' => 221, 'module' => 'Product', 'name' => 'Listing', 'description' => 'Product Listing', 'url' => 'backend_app/product', 'created_by' => 1, 'created_at' => $today],
            ['id' => 222, 'module' => 'Product', 'name' => 'New', 'description' => 'Product New', 'url' => 'backend_app/product/create', 'created_by' => 1, 'created_at' => $today],
            ['id' => 223, 'module' => 'Product', 'name' => 'store', 'description' => 'Product Store', 'url' => 'backend_app/product/store', 'created_by' => 1, 'created_at' => $today],
            ['id' => 224, 'module' => 'Product', 'name' => 'Edit', 'description' => 'Product Edit', 'url' => 'backend_app/product/edit', 'created_by' => 1, 'created_at' => $today],
            ['id' => 225, 'module' => 'Product', 'name' => 'Update', 'description' => 'Product Update', 'url' => 'backend_app/product/update', 'created_by' => 1, 'created_at' => $today],
            ['id' => 226, 'module' => 'Product', 'name' => 'Destroy', 'description' => 'Product Destroy', 'url' => 'backend_app/product/destroy', 'created_by' => 1, 'created_at' => $today],
            ['id' => 227, 'module' => 'Product', 'name' => 'Activate', 'description' => 'Product Activate', 'url' => 'backend_app/product/enable', 'created_by' => 1, 'created_at' => $today],

            // Team
            ['id' => 231, 'module' => 'Team', 'name' => 'Listing', 'description' => 'Team Listing', 'url' => 'backend_app/team', 'created_by' => 1, 'created_at' => $today],
            ['id' => 232, 'module' => 'Team', 'name' => 'New', 'description' => 'Team New', 'url' => 'backend_app/team/create', 'created_by' => 1, 'created_at' => $today],
            ['id' => 233, 'module' => 'Team', 'name' => 'store', 'description' => 'Team Store', 'url' => 'backend_app/team/store', 'created_by' => 1, 'created_at' => $today],
            ['id' => 234, 'module' => 'Team', 'name' => 'Edit', 'description' => 'Team Edit', 'url' => 'backend_app/team/edit', 'created_by' => 1, 'created_at' => $today],
            ['id' => 235, 'module' => 'Team', 'name' => 'Update', 'description' => 'Team Update', 'url' => 'backend_app/team/update', 'created_by' => 1, 'created_at' => $today],
            ['id' => 236, 'module' => 'Team', 'name' => 'Destroy', 'description' => 'Team Destroy', 'url' => 'backend_app/team/destroy', 'created_by' => 1, 'created_at' => $today],
            ['id' => 237, 'module' => 'Team', 'name' => 'Enable', 'description' => 'Team Enable', 'url' => 'backend_app/team/enable', 'created_by' => 1, 'created_at' => $today],

            // Service
            ['id' => 241, 'module' => 'Service', 'name' => 'Listing', 'description' => 'Service Listing', 'url' => 'backend_app/service', 'created_by' => 1, 'created_at' => $today],
            ['id' => 242, 'module' => 'Service', 'name' => 'New', 'description' => 'Service New', 'url' => 'backend_app/service/create', 'created_by' => 1, 'created_at' => $today],
            ['id' => 243, 'module' => 'Service', 'name' => 'store', 'description' => 'Service Store', 'url' => 'backend_app/service/store', 'created_by' => 1, 'created_at' => $today],
            ['id' => 244, 'module' => 'Service', 'name' => 'Edit', 'description' => 'Service Edit', 'url' => 'backend_app/service/edit', 'created_by' => 1, 'created_at' => $today],
            ['id' => 245, 'module' => 'Service', 'name' => 'Update', 'description' => 'Service Update', 'url' => 'backend_app/service/update', 'created_by' => 1, 'created_at' => $today],
            ['id' => 246, 'module' => 'Service', 'name' => 'Destroy', 'description' => 'Service Destroy', 'url' => 'backend_app/service/destroy', 'created_by' => 1, 'created_at' => $today],
            ['id' => 247, 'module' => 'Service', 'name' => 'Activate', 'description' => 'Service Activate', 'url' => 'backend_app/service/enable', 'created_by' => 1, 'created_at' => $today],

            // Item
            ['id' => 251, 'module' => 'Item', 'name' => 'Listing', 'description' => 'Item Listing', 'url' => 'backend_app/item', 'created_by' => 1, 'created_at' => $today],
            ['id' => 252, 'module' => 'Item', 'name' => 'New', 'description' => 'Item New', 'url' => 'backend_app/item/create', 'created_by' => 1, 'created_at' => $today],
            ['id' => 253, 'module' => 'Item', 'name' => 'store', 'description' => 'Item Store', 'url' => 'backend_app/item/store', 'created_by' => 1, 'created_at' => $today],
            ['id' => 254, 'module' => 'Item', 'name' => 'Edit', 'description' => 'Item Edit', 'url' => 'backend_app/item/edit', 'created_by' => 1, 'created_at' => $today],
            ['id' => 255, 'module' => 'Item', 'name' => 'Update', 'description' => 'Item Update', 'url' => 'backend_app/item/update', 'created_by' => 1, 'created_at' => $today],
            ['id' => 256, 'module' => 'Item', 'name' => 'Destroy', 'description' => 'Item Destroy', 'url' => 'backend_app/item/destroy', 'created_by' => 1, 'created_at' => $today],
            ['id' => 257, 'module' => 'Item', 'name' => 'Activate', 'description' => 'Item Activate', 'url' => 'backend_app/item/enable', 'created_by' => 1, 'created_at' => $today],
            ['id' => 258, 'module' => 'Item', 'name' => 'API', 'description' => 'Item Listing', 'url' => 'backend_app/api/item', 'created_by' => 1, 'created_at' => $today],

            // Slider
            ['id' => 261, 'module' => 'Slider', 'name' => 'Listing', 'description' => 'Slider Listing', 'url' => 'backend_app/slider', 'created_by' => 1, 'created_at' => $today],
            ['id' => 262, 'module' => 'Slider', 'name' => 'New', 'description' => 'Slider New', 'url' => 'backend_app/slider/create', 'created_by' => 1, 'created_at' => $today],
            ['id' => 263, 'module' => 'Slider', 'name' => 'store', 'description' => 'Slider Store', 'url' => 'backend_app/slider/store', 'created_by' => 1, 'created_at' => $today],
            ['id' => 264, 'module' => 'Slider', 'name' => 'Edit', 'description' => 'Slider Edit', 'url' => 'backend_app/slider/edit', 'created_by' => 1, 'created_at' => $today],
            ['id' => 265, 'module' => 'Slider', 'name' => 'Update', 'description' => 'Slider Update', 'url' => 'backend_app/slider/update', 'created_by' => 1, 'created_at' => $today],
            ['id' => 266, 'module' => 'Slider', 'name' => 'Destroy', 'description' => 'Slider Destroy', 'url' => 'backend_app/slider/destroy', 'created_by' => 1, 'created_at' => $today],
            ['id' => 267, 'module' => 'Slider', 'name' => 'Activate', 'description' => 'Slider Activate', 'url' => 'backend_app/slider/enable', 'created_by' => 1, 'created_at' => $today],

            // Category
            ['id' => 271, 'module' => 'Category', 'name' => 'Listing', 'description' => 'Category Listing', 'url' => 'backend_app/category', 'created_by' => 1, 'created_at' => $today],
            ['id' => 272, 'module' => 'Category', 'name' => 'New', 'description' => 'Category New', 'url' => 'backend_app/category/create', 'created_by' => 1, 'created_at' => $today],
            ['id' => 273, 'module' => 'Category', 'name' => 'store', 'description' => 'Category Store', 'url' => 'backend_app/category/store', 'created_by' => 1, 'created_at' => $today],
            ['id' => 274, 'module' => 'Category', 'name' => 'Edit', 'description' => 'Category Edit', 'url' => 'backend_app/category/edit', 'created_by' => 1, 'created_at' => $today],
            ['id' => 275, 'module' => 'Category', 'name' => 'Update', 'description' => 'Category Update', 'url' => 'backend_app/category/update', 'created_by' => 1, 'created_at' => $today],
            ['id' => 276, 'module' => 'Category', 'name' => 'Destroy', 'description' => 'Category Destroy', 'url' => 'backend_app/category/destroy', 'created_by' => 1, 'created_at' => $today],
            ['id' => 277, 'module' => 'Category', 'name' => 'Activate', 'description' => 'Category Activate', 'url' => 'backend_app/category/enable', 'created_by' => 1, 'created_at' => $today],

            // Contact Us
            ['id' => 281, 'module' => 'Contact_Us', 'name' => 'Listing', 'description' => 'Contact us Listing', 'url' => 'backend_app/contact_us', 'created_by' => 1, 'created_at' => $today],
            ['id' => 282, 'module' => 'Contact_Us', 'name' => 'New', 'description' => 'Contact us New', 'url' => 'backend_app/contact_us/create', 'created_by' => 1, 'created_at' => $today],
            ['id' => 283, 'module' => 'Contact_Us', 'name' => 'store', 'description' => 'Contact us Store', 'url' => 'backend_app/contact_us/store', 'created_by' => 1, 'created_at' => $today],
            ['id' => 284, 'module' => 'Contact_Us', 'name' => 'Edit', 'description' => 'Contact us Edit', 'url' => 'backend_app/contact_us/edit', 'created_by' => 1, 'created_at' => $today],
            ['id' => 285, 'module' => 'Contact_Us', 'name' => 'Update', 'description' => 'Contact us Update', 'url' => 'backend_app/contact_us/update', 'created_by' => 1, 'created_at' => $today],
            ['id' => 286, 'module' => 'Contact_Us', 'name' => 'Destroy', 'description' => 'Contact us Destroy', 'url' => 'backend_app/contact_us/destroy', 'created_by' => 1, 'created_at' => $today],

            // Brand
            ['id' => 291, 'module' => 'Brand', 'name' => 'Listing', 'description' => 'Brand Listing', 'url' => 'backend_app/brand', 'created_by' => 1, 'created_at' => $today],
            ['id' => 292, 'module' => 'Brand', 'name' => 'New', 'description' => 'Brand New', 'url' => 'backend_app/brand/create', 'created_by' => 1, 'created_at' => $today],
            ['id' => 293, 'module' => 'Brand', 'name' => 'store', 'description' => 'Brand Store', 'url' => 'backend_app/brand/store', 'created_by' => 1, 'created_at' => $today],
            ['id' => 294, 'module' => 'Brand', 'name' => 'Edit', 'description' => 'Brand Edit', 'url' => 'backend_app/brand/edit', 'created_by' => 1, 'created_at' => $today],
            ['id' => 295, 'module' => 'Brand', 'name' => 'Update', 'description' => 'Brand Update', 'url' => 'backend_app/brand/update', 'created_by' => 1, 'created_at' => $today],
            ['id' => 296, 'module' => 'Brand', 'name' => 'Destroy', 'description' => 'Brand Destroy', 'url' => 'backend_app/brand/destroy', 'created_by' => 1, 'created_at' => $today],
            ['id' => 297, 'module' => 'Brand', 'name' => 'Activate', 'description' => 'Brand Activate', 'url' => 'backend_app/brand/enable', 'created_by' => 1, 'created_at' => $today],

            // Faq_information
            ['id' => 301, 'module' => 'Faq_information', 'name' => 'Listing', 'description' => 'Faq_information Listing', 'url' => 'backend_app/faq_information', 'created_by' => 1, 'created_at' => $today],
            ['id' => 302, 'module' => 'Faq_information', 'name' => 'New', 'description' => 'Faq_information New', 'url' => 'backend_app/faq_information/create', 'created_by' => 1, 'created_at' => $today],
            ['id' => 303, 'module' => 'Faq_information', 'name' => 'store', 'description' => 'Faq_information Store', 'url' => 'backend_app/faq_information/store', 'created_by' => 1, 'created_at' => $today],
            ['id' => 304, 'module' => 'Faq_information', 'name' => 'Edit', 'description' => 'Faq_information Edit', 'url' => 'backend_app/faq_information/edit', 'created_by' => 1, 'created_at' => $today],
            ['id' => 305, 'module' => 'Faq_information', 'name' => 'Update', 'description' => 'Faq_information Update', 'url' => 'backend_app/faq_information/update', 'created_by' => 1, 'created_at' => $today],
            ['id' => 306, 'module' => 'Faq_information', 'name' => 'Destroy', 'description' => 'Faq_information Destroy', 'url' => 'backend_app/faq_information/destroy', 'created_by' => 1, 'created_at' => $today],
            ['id' => 307, 'module' => 'Faq_information', 'name' => 'Activate', 'description' => 'Faq_information Activate', 'url' => 'backend_app/faq_information/enable', 'created_by' => 1, 'created_at' => $today],           
            
             // Transaction_Order
             ['id' => 361, 'module' => 'Transaction_Order', 'name' => 'Listing', 'description' => 'Transaction_Order Listing', 'url' => 'backend_app/transaction_order', 'created_by' => 1, 'created_at' => $today],
             ['id' => 362, 'module' => 'Transaction_Order', 'name' => 'New', 'description' => 'Transaction_Order New', 'url' => 'backend_app/transaction_order/create', 'created_by' => 1, 'created_at' => $today],
             ['id' => 363, 'module' => 'Transaction_Order', 'name' => 'store', 'description' => 'Transaction_Order Store', 'url' => 'backend_app/transaction_order/store', 'created_by' => 1, 'created_at' => $today],
             ['id' => 364, 'module' => 'Transaction_Order', 'name' => 'Edit', 'description' => 'Transaction_Order Edit', 'url' => 'backend_app/transaction_order/edit', 'created_by' => 1, 'created_at' => $today],
             ['id' => 365, 'module' => 'Transaction_Order', 'name' => 'Update', 'description' => 'Transaction_Order Update', 'url' => 'backend_app/transaction_order/update', 'created_by' => 1, 'created_at' => $today],
             ['id' => 366, 'module' => 'Transaction_Order', 'name' => 'Destroy', 'description' => 'Transaction_Order Destroy', 'url' => 'backend_app/transaction_order/destroy', 'created_by' => 1, 'created_at' => $today],
             ['id' => 367, 'module' => 'Transaction_Order', 'name' => 'Activate', 'description' => 'Transaction_Order Activate', 'url' => 'backend_app/transaction_order/enable', 'created_by' => 1, 'created_at' => $today],
 
             // Transaction
             ['id' => 371, 'module' => 'Transaction', 'name' => 'Listing', 'description' => 'Transaction Listing', 'url' => 'backend_app/transaction', 'created_by' => 1, 'created_at' => $today],
             ['id' => 372, 'module' => 'Transaction', 'name' => 'New', 'description' => 'Transaction New', 'url' => 'backend_app/transaction/create', 'created_by' => 1, 'created_at' => $today],
             ['id' => 373, 'module' => 'Transaction', 'name' => 'store', 'description' => 'Transaction Store', 'url' => 'backend_app/transaction/store', 'created_by' => 1, 'created_at' => $today],
             ['id' => 374, 'module' => 'Transaction', 'name' => 'Edit', 'description' => 'Transaction Edit', 'url' => 'backend_app/transaction/edit', 'created_by' => 1, 'created_at' => $today],
             ['id' => 375, 'module' => 'Transaction', 'name' => 'Update', 'description' => 'Transaction Update', 'url' => 'backend_app/transaction/update', 'created_by' => 1, 'created_at' => $today],
             ['id' => 376, 'module' => 'Transaction', 'name' => 'Destroy', 'description' => 'Transaction Destroy', 'url' => 'backend_app/transaction/destroy', 'created_by' => 1, 'created_at' => $today],
             ['id' => 377, 'module' => 'Transaction', 'name' => 'Show', 'description' => 'Transaction Show', 'url' => 'backend_app/transaction/show', 'created_by' => 1, 'created_at' => $today],
             ['id' => 378, 'module' => 'Transaction', 'name' => 'Show', 'description' => 'Transaction Show', 'url' => 'backend_app/transaction/show', 'created_by' => 1, 'created_at' => $today],
 


            //  //CSVImport
            // ['id'=>600,'module'=>'CSVImport','name'=>'Listing','description'=>'CSVImport Listing','url'=>'backend_app/import','created_by'=>1,'created_at'=>$today],
            // ['id'=>601,'module'=>'CSVImport','name'=>'Store','description'=>'CSVImport Store','url'=>'backend_app/import/store','created_by'=>1,'created_at'=>$today],

            //  ['id'=>360,'module'=>'Report','name'=>'Sale Summary Report','description'=>'Sale Summary Report Listing','url'=>'backend_app/salesummaryreport','created_by'=>1,'created_at'=>$today],
            // ['id'=>361,'module'=>'Report','name'=>'Sale Summary Report Search','description'=>'Sale Summary Report Search','url'=>'backend_app/salesummaryreport/search/{type?}/{from?}/{to?}','created_by'=>1,'created_at'=>$today],
            // ['id'=>362,'module'=>'Report','name'=>'Sale Summary Report Excel','description'=>'Sale Summary Report Excel','url'=>'backend_app/salesummaryreport/exportexcel/{type?}/{from?}/{to?}','created_by'=>1,'created_at'=>$today],

            // ['id'=>520,'module'=>'Slider','name'=>'Create','description'=>'Slider Create','url'=>'backend_app/slider/create','created_by'=>1,'created_at'=>$today],
            // ['id'=>521,'module'=>'Slider','name'=>'Store','description'=>'Slider Store','url'=>'backend_app/slider/store','created_by'=>1,'created_at'=>$today],
            // ['id'=>522,'module'=>'Slider','name'=>'Edit','description'=>'Slider Edit','url'=>'Slider Edit','created_by'=>1,'created_at'=>$today],
            // ['id'=>523,'module'=>'Slider','name'=>'Update','description'=>'Slider Update','url'=>'Slider Update','created_by'=>1,'created_at'=>$today],
            // ['id'=>524,'module'=>'Slider','name'=>'Destroy','description'=>'Slider Destroy','url'=>'backend_app/slider/destroy','created_by'=>1,'created_at'=>$today],
            // ['id'=>525,'module'=>'Slider','name'=>'Listing','description'=>'Slider Listing','url'=>'backend_app/slider','created_by'=>1,'created_at'=>$today],

            // ['id'=>30,'module'=>'Backend','name'=>'Listing','description'=>'Backend Listing','url'=>'backend','created_by'=>1,'created_at'=>$today],
            // ['id'=>31,'module'=>'Backend','name'=>'New','description'=>'Backend New','url'=>'backend_app/create','created_by'=>1,'created_at'=>$today],
            // ['id'=>32,'module'=>'Backend','name'=>'Store','description'=>'Backend Store','url'=>'backend_app/store','created_by'=>1,'created_at'=>$today],
            // ['id'=>33,'module'=>'Backend','name'=>'Edit','description'=>'Backend Edit','url'=>'backend_app/edit','created_by'=>1,'created_at'=>$today],
            // ['id'=>34,'module'=>'Backend','name'=>'Update','description'=>'Backend Update','url'=>'backend_app/update','created_by'=>1,'created_at'=>$today],
            // ['id'=>35,'module'=>'Backend','name'=>'Detail','description'=>'Backend Detail','url'=>'backend_app/detail','created_by'=>1,'created_at'=>$today],
            // ['id'=>36,'module'=>'Backend','name'=>'Detail Update','description'=>'Backend Update','url'=>'backend_app/detail/update','created_by'=>1,'created_at'=>$today],
            // ['id'=>37,'module'=>'Frontend','name'=>'Listing','description'=>'Listing','url'=>'frontend','created_by'=>1,'created_at'=>$today],
            // ['id'=>38,'module'=>'Frontend','name'=>'Log','description'=>'Backend','url'=>'log/backend','created_by'=>1,'created_at'=>$today],
            // ['id'=>39,'module'=>'Frontend','name'=>'Log','description'=>'Frontend','url'=>'log/frontend','created_by'=>1,'created_at'=>$today],

            // ['id'=>40,'module'=>'Frontend','name'=>'Log','description'=>'Activation','url'=>'log/activation','created_by'=>1,'created_at'=>$today],
            // ['id'=>41,'module'=>'Frontend','name'=>'Update Status','description'=>'Update Status','url'=>'frontend/updatestatus','created_by'=>1,'created_at'=>$today],
            // ['id'=>42,'module'=>'Frontend','name'=>'Update','description'=>'Update Frontend','url'=>'frontend/update','created_by'=>1,'created_at'=>$today],
            // ['id'=>43,'module'=>'Frontend','name'=>'Edit','description'=>'Edit Frontend','url'=>'frontend/edit','created_by'=>1,'created_at'=>$today],
            // ['id'=>44,'module'=>'Backend','name'=>'View','description'=>'Editing','url'=>'backend_app/site_config','created_by'=>1,'created_at'=>$today],

        );

//        DB::table('core_permissions')->insert($permissions);

        if (isset($existingPermissions) && count($existingPermissions) > 0) {

            $newPermissions = array();

            foreach ($permissions as $defaultPermission) {

                $existFlag = 0;
                foreach ($existingPermissions as $existPermission) {

                    if ($defaultPermission['id'] == $existPermission->id) {
                        $existFlag++;
                        break;
                    }
                }
                if ($existFlag == 0) {
                    array_push($newPermissions, $defaultPermission);
                }

            }

            if (count($newPermissions) > 0) {
                DB::table('core_permissions')->insert($newPermissions);
            }
        } else {
            DB::table('core_permissions')->insert($permissions);
        }

        echo "\n";
        echo "*****************************************************";
        echo "\n";
        echo "** Finished Running Default Core Permission Seeder **";
        echo "\n";
        echo "*****************************************************";
        echo "\n";

    }
}
