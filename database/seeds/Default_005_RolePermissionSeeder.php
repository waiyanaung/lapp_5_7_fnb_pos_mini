<?php
/**
 * Created by Visual Studio Code.
 * Author: william
 * Date: 11/2/2016
 * Time: 2:19 PM
 */

use Illuminate\Database\Seeder;

class Default_005_RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('core_permission_role')->delete();
        $today = date('Y-m-d H:i:s');
        $roles = array(

            // Role Permissions for the Role 1 - Start 
            // Roles
            ['role_id'=>1, 'permission_id'=>1,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>2,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>3,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>4,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>5,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>6,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>7,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>8,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>9,'created_by'=>1,'created_at'=>$today],
            
            // Users
            ['role_id'=>1, 'permission_id'=>11,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>12,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>13,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>14,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>15,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>16,'created_by'=>1,'created_at'=>$today],
            // ['role_id'=>1, 'permission_id'=>17,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>18,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>19,'created_by'=>1,'created_at'=>$today],

            // user disable/enable
            ['role_id'=>1, 'permission_id'=>21,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>22,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>23,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>24,'created_by'=>1,'created_at'=>$today],

            // Permissions
            ['role_id'=>1, 'permission_id'=>31,'created_by'=>1,'created_at'=>$today],
            // ['role_id'=>1, 'permission_id'=>32,'created_by'=>1,'created_at'=>$today],
            // ['role_id'=>1, 'permission_id'=>33,'created_by'=>1,'created_at'=>$today],
            // ['role_id'=>1, 'permission_id'=>34,'created_by'=>1,'created_at'=>$today],
            // ['role_id'=>1, 'permission_id'=>35,'created_by'=>1,'created_at'=>$today],
            // ['role_id'=>1, 'permission_id'=>36,'created_by'=>1,'created_at'=>$today],
            
            // Country
            ['role_id'=>1, 'permission_id'=>41,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>42,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>43,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>44,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>45,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>46,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>47,'created_by'=>1,'created_at'=>$today],

            // Township
            ['role_id'=>1, 'permission_id'=>51,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>52,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>53,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>54,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>55,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>56,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>57,'created_by'=>1,'created_at'=>$today],

            // City
            ['role_id'=>1, 'permission_id'=>61,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>62,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>63,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>64,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>65,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>66,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>67,'created_by'=>1,'created_at'=>$today],

            // Ajax Country and City
            ['role_id'=>1, 'permission_id'=>71,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>72,'created_by'=>1,'created_at'=>$today],

             // System Config
            ['role_id'=>1, 'permission_id'=>81,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>82,'created_by'=>1,'created_at'=>$today],

             // System Reference
             ['role_id'=>1, 'permission_id'=>83,'created_by'=>1,'created_at'=>$today],

            // Page
            ['role_id'=>1, 'permission_id'=>91,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>92,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>93,'created_by'=>1,'created_at'=>$today],

            //Activity Log 
            ['role_id'=>1, 'permission_id'=>101,'created_by'=>1,'created_at'=>$today],

            //Faq Information
            ['role_id'=>1, 'permission_id'=>102,'created_by'=>1,'created_at'=>$today],

            //About Us Information
            ['role_id'=>1, 'permission_id'=>103,'created_by'=>1,'created_at'=>$today],

            //Contact Us Information
            ['role_id'=>1, 'permission_id'=>104,'created_by'=>1,'created_at'=>$today],

            //Terms and Condition
            ['role_id'=>1, 'permission_id'=>105,'created_by'=>1,'created_at'=>$today],

            //Organization
            ['role_id'=>1, 'permission_id'=>121,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>122,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>123,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>124,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>125,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>126,'created_by'=>1,'created_at'=>$today],

            //Project
            ['role_id'=>1, 'permission_id'=>131,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>132,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>133,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>134,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>135,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>136,'created_by'=>1,'created_at'=>$today],

            //Location
            ['role_id'=>1, 'permission_id'=>141,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>142,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>143,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>144,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>145,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>146,'created_by'=>1,'created_at'=>$today],

            //Document
            ['role_id'=>1, 'permission_id'=>151,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>152,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>153,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>154,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>155,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>156,'created_by'=>1,'created_at'=>$today],

            //Checklistquestion
            ['role_id'=>1, 'permission_id'=>161,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>162,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>163,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>164,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>165,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>166,'created_by'=>1,'created_at'=>$today],

            //Checklistupload
            ['role_id'=>1, 'permission_id'=>171,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>172,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>173,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>174,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>175,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>176,'created_by'=>1,'created_at'=>$today],

            //Article
            ['role_id'=>1, 'permission_id'=>181,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>182,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>183,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>184,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>185,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>186,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>187,'created_by'=>1,'created_at'=>$today],

            //Article Image
            ['role_id'=>1, 'permission_id'=>191,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>192,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>193,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>194,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>195,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>196,'created_by'=>1,'created_at'=>$today],

            //Gallery
            ['role_id'=>1, 'permission_id'=>201,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>202,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>203,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>204,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>205,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>206,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>207,'created_by'=>1,'created_at'=>$today],

            //Gallery Image
            ['role_id'=>1, 'permission_id'=>211,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>212,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>213,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>214,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>215,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>216,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>217,'created_by'=>1,'created_at'=>$today],

            //Product
            ['role_id'=>1, 'permission_id'=>221,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>222,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>223,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>224,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>225,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>226,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>227,'created_by'=>1,'created_at'=>$today],

            //Team
            ['role_id'=>1, 'permission_id'=>231,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>232,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>233,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>234,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>235,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>236,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>237,'created_by'=>1,'created_at'=>$today],

            //Service
            ['role_id'=>1, 'permission_id'=>241,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>242,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>243,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>244,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>245,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>246,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>247,'created_by'=>1,'created_at'=>$today],

            //Item
            ['role_id'=>1, 'permission_id'=>251,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>252,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>253,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>254,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>255,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>256,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>257,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>258,'created_by'=>1,'created_at'=>$today],

            //Slider
            ['role_id'=>1, 'permission_id'=>261,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>262,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>263,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>264,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>265,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>266,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>267,'created_by'=>1,'created_at'=>$today],

            //Category
            ['role_id'=>1, 'permission_id'=>271,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>272,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>273,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>274,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>275,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>276,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>277,'created_by'=>1,'created_at'=>$today],

            //Contact Us
            ['role_id'=>1, 'permission_id'=>281,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>282,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>283,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>284,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>285,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>286,'created_by'=>1,'created_at'=>$today],

            //Brand
            ['role_id'=>1, 'permission_id'=>291,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>292,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>293,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>294,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>295,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>296,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>297,'created_by'=>1,'created_at'=>$today],

            //faq_information
            ['role_id'=>1, 'permission_id'=>301,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>302,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>303,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>304,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>305,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>306,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>307,'created_by'=>1,'created_at'=>$today],
            
            //transaction_order
            ['role_id'=>1, 'permission_id'=>361,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>362,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>363,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>364,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>365,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>366,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>367,'created_by'=>1,'created_at'=>$today],

            //transaction
            ['role_id'=>1, 'permission_id'=>371,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>372,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>373,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>374,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>375,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>376,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>377,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>1, 'permission_id'=>378,'created_by'=>1,'created_at'=>$today],

            // Role Permissions for the Role 1 - End

                       
            
            // Role Permissions for the Role 2 - Start 
            // Roles
            ['role_id'=>2, 'permission_id'=>1,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>4,'created_by'=>1,'created_at'=>$today],
            
            // Users
            ['role_id'=>2, 'permission_id'=>11,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>14,'created_by'=>1,'created_at'=>$today],
            // ['role_id'=>2, 'permission_id'=>17,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>18,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>19,'created_by'=>1,'created_at'=>$today],

            // Permissions
            ['role_id'=>2, 'permission_id'=>31,'created_by'=>1,'created_at'=>$today],
            
            // Country
            ['role_id'=>2, 'permission_id'=>41,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>44,'created_by'=>1,'created_at'=>$today],

            // Township
            ['role_id'=>2, 'permission_id'=>51,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>54,'created_by'=>1,'created_at'=>$today],

            // City
            ['role_id'=>2, 'permission_id'=>61,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>64,'created_by'=>1,'created_at'=>$today],

            // Ajax Country and City
            ['role_id'=>2, 'permission_id'=>71,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>72,'created_by'=>1,'created_at'=>$today],

             // System Config
            ['role_id'=>2, 'permission_id'=>81,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>82,'created_by'=>1,'created_at'=>$today],

            // Page
            ['role_id'=>2, 'permission_id'=>91,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>92,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>93,'created_by'=>1,'created_at'=>$today],

            //Activity Log 
            ['role_id'=>2, 'permission_id'=>101,'created_by'=>1,'created_at'=>$today],

            //Faq Information
            ['role_id'=>2, 'permission_id'=>102,'created_by'=>1,'created_at'=>$today],

            //About Us Information
            ['role_id'=>2, 'permission_id'=>103,'created_by'=>1,'created_at'=>$today],

            //Contact Us Information
            ['role_id'=>2, 'permission_id'=>104,'created_by'=>1,'created_at'=>$today],

            //Terms and Condition
            ['role_id'=>2, 'permission_id'=>105,'created_by'=>1,'created_at'=>$today],


            //Organization
            ['role_id'=>2, 'permission_id'=>121,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>122,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>123,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>124,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>125,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>126,'created_by'=>1,'created_at'=>$today],

            //Project
            ['role_id'=>2, 'permission_id'=>131,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>132,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>133,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>134,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>135,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>136,'created_by'=>1,'created_at'=>$today],

            //Location
            ['role_id'=>2, 'permission_id'=>141,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>142,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>143,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>144,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>145,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>146,'created_by'=>1,'created_at'=>$today],

            //Document
            ['role_id'=>2, 'permission_id'=>151,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>152,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>153,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>154,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>155,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>156,'created_by'=>1,'created_at'=>$today],

            //Checklistquestion
            ['role_id'=>2, 'permission_id'=>161,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>162,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>163,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>164,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>165,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>166,'created_by'=>1,'created_at'=>$today],

            //Checklistupload
            ['role_id'=>2, 'permission_id'=>171,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>172,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>173,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>174,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>175,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>176,'created_by'=>1,'created_at'=>$today],

            //Item
            ['role_id'=>2, 'permission_id'=>251,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>252,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>253,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>254,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>255,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>256,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>257,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>258,'created_by'=>1,'created_at'=>$today],

            //Slider
            ['role_id'=>2, 'permission_id'=>261,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>262,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>263,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>264,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>265,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>266,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>267,'created_by'=>1,'created_at'=>$today],

            //Category
            ['role_id'=>2, 'permission_id'=>271,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>272,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>273,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>274,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>275,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>276,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>277,'created_by'=>1,'created_at'=>$today],

            //Contact Us
            ['role_id'=>2, 'permission_id'=>281,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>282,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>283,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>284,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>285,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>286,'created_by'=>1,'created_at'=>$today],


            //Brand
            ['role_id'=>2, 'permission_id'=>291,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>292,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>293,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>294,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>295,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>296,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>297,'created_by'=>1,'created_at'=>$today],

            //faq_information
            ['role_id'=>2, 'permission_id'=>301,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>302,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>303,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>304,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>305,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>306,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>307,'created_by'=>1,'created_at'=>$today],

             //transaction_order
             ['role_id'=>2, 'permission_id'=>361,'created_by'=>1,'created_at'=>$today],
             ['role_id'=>2, 'permission_id'=>362,'created_by'=>1,'created_at'=>$today],
             ['role_id'=>2, 'permission_id'=>363,'created_by'=>1,'created_at'=>$today],
             ['role_id'=>2, 'permission_id'=>364,'created_by'=>1,'created_at'=>$today],
             ['role_id'=>2, 'permission_id'=>365,'created_by'=>1,'created_at'=>$today],
             ['role_id'=>2, 'permission_id'=>366,'created_by'=>1,'created_at'=>$today],
             ['role_id'=>2, 'permission_id'=>367,'created_by'=>1,'created_at'=>$today],

            //transaction
            ['role_id'=>2, 'permission_id'=>371,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>372,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>373,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>374,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>375,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>376,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>377,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>2, 'permission_id'=>378,'created_by'=>1,'created_at'=>$today],

            // Role Permissions for the Role 2 - End
            
            // Role Permissions for the Role 3 - Start
            // Roles
            ['role_id'=>3, 'permission_id'=>1,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>3, 'permission_id'=>4,'created_by'=>1,'created_at'=>$today],
            
            // Users
            ['role_id'=>3, 'permission_id'=>11,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>3, 'permission_id'=>14,'created_by'=>1,'created_at'=>$today],
            // ['role_id'=>3, 'permission_id'=>17,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>3, 'permission_id'=>18,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>3, 'permission_id'=>19,'created_by'=>1,'created_at'=>$today],

            // Permissions
            ['role_id'=>3, 'permission_id'=>31,'created_by'=>1,'created_at'=>$today],
            
            // Country
            ['role_id'=>3, 'permission_id'=>41,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>3, 'permission_id'=>44,'created_by'=>1,'created_at'=>$today],

            // Township
            ['role_id'=>3, 'permission_id'=>51,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>3, 'permission_id'=>54,'created_by'=>1,'created_at'=>$today],

            // City
            ['role_id'=>3, 'permission_id'=>61,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>3, 'permission_id'=>64,'created_by'=>1,'created_at'=>$today],

            //Organization
            ['role_id'=>3, 'permission_id'=>121,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>3, 'permission_id'=>122,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>3, 'permission_id'=>123,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>3, 'permission_id'=>124,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>3, 'permission_id'=>125,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>3, 'permission_id'=>126,'created_by'=>1,'created_at'=>$today],

            //Project
            ['role_id'=>3, 'permission_id'=>131,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>3, 'permission_id'=>132,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>3, 'permission_id'=>133,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>3, 'permission_id'=>134,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>3, 'permission_id'=>135,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>3, 'permission_id'=>136,'created_by'=>1,'created_at'=>$today],

            //Location
            ['role_id'=>3, 'permission_id'=>141,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>3, 'permission_id'=>142,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>3, 'permission_id'=>143,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>3, 'permission_id'=>144,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>3, 'permission_id'=>145,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>3, 'permission_id'=>146,'created_by'=>1,'created_at'=>$today],

            //Document
            ['role_id'=>3, 'permission_id'=>151,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>3, 'permission_id'=>152,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>3, 'permission_id'=>153,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>3, 'permission_id'=>154,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>3, 'permission_id'=>155,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>3, 'permission_id'=>156,'created_by'=>1,'created_at'=>$today],

            //Checklistquestion
            ['role_id'=>3, 'permission_id'=>161,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>3, 'permission_id'=>162,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>3, 'permission_id'=>163,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>3, 'permission_id'=>164,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>3, 'permission_id'=>165,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>3, 'permission_id'=>166,'created_by'=>1,'created_at'=>$today],

            //Checklistupload
            ['role_id'=>3, 'permission_id'=>171,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>3, 'permission_id'=>172,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>3, 'permission_id'=>173,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>3, 'permission_id'=>174,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>3, 'permission_id'=>175,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>3, 'permission_id'=>176,'created_by'=>1,'created_at'=>$today],

            //transaction
            ['role_id'=>3, 'permission_id'=>371,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>3, 'permission_id'=>372,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>3, 'permission_id'=>373,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>3, 'permission_id'=>374,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>3, 'permission_id'=>375,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>3, 'permission_id'=>376,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>3, 'permission_id'=>377,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>3, 'permission_id'=>378,'created_by'=>1,'created_at'=>$today],
            // Role Permissions for the Role 3 - End


            // Role Permissions for the Role 4 - Start
            // Roles
            ['role_id'=>4, 'permission_id'=>1,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>4, 'permission_id'=>4,'created_by'=>1,'created_at'=>$today],
            
            // Users
            ['role_id'=>4, 'permission_id'=>11,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>4, 'permission_id'=>14,'created_by'=>1,'created_at'=>$today],
            // ['role_id'=>4, 'permission_id'=>17,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>4, 'permission_id'=>18,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>4, 'permission_id'=>19,'created_by'=>1,'created_at'=>$today],

            // Permissions
            ['role_id'=>4, 'permission_id'=>31,'created_by'=>1,'created_at'=>$today],
            
            // Country
            ['role_id'=>4, 'permission_id'=>41,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>4, 'permission_id'=>44,'created_by'=>1,'created_at'=>$today],

            // Township
            ['role_id'=>4, 'permission_id'=>51,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>4, 'permission_id'=>54,'created_by'=>1,'created_at'=>$today],

            // City
            ['role_id'=>4, 'permission_id'=>61,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>4, 'permission_id'=>64,'created_by'=>1,'created_at'=>$today],

            //Organization
            ['role_id'=>4, 'permission_id'=>121,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>4, 'permission_id'=>122,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>4, 'permission_id'=>123,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>4, 'permission_id'=>124,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>4, 'permission_id'=>125,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>4, 'permission_id'=>126,'created_by'=>1,'created_at'=>$today],

            //Project
            ['role_id'=>4, 'permission_id'=>131,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>4, 'permission_id'=>132,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>4, 'permission_id'=>133,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>4, 'permission_id'=>134,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>4, 'permission_id'=>135,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>4, 'permission_id'=>136,'created_by'=>1,'created_at'=>$today],

            //Location
            ['role_id'=>4, 'permission_id'=>141,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>4, 'permission_id'=>142,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>4, 'permission_id'=>143,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>4, 'permission_id'=>144,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>4, 'permission_id'=>145,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>4, 'permission_id'=>146,'created_by'=>1,'created_at'=>$today],

            //Document
            ['role_id'=>4, 'permission_id'=>151,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>4, 'permission_id'=>152,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>4, 'permission_id'=>153,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>4, 'permission_id'=>154,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>4, 'permission_id'=>155,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>4, 'permission_id'=>156,'created_by'=>1,'created_at'=>$today],

            //Checklistquestion
            ['role_id'=>4, 'permission_id'=>161,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>4, 'permission_id'=>162,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>4, 'permission_id'=>163,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>4, 'permission_id'=>164,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>4, 'permission_id'=>165,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>4, 'permission_id'=>166,'created_by'=>1,'created_at'=>$today],

            //Checklistupload
            ['role_id'=>4, 'permission_id'=>171,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>4, 'permission_id'=>172,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>4, 'permission_id'=>173,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>4, 'permission_id'=>174,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>4, 'permission_id'=>175,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>4, 'permission_id'=>176,'created_by'=>1,'created_at'=>$today],
            // Role Permissions for the Role 4 - End

             // Role Permissions for the Role 5 - Start
             // Roles
            ['role_id'=>5, 'permission_id'=>1,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>5, 'permission_id'=>4,'created_by'=>1,'created_at'=>$today],
            
            // Users
            ['role_id'=>5, 'permission_id'=>11,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>5, 'permission_id'=>14,'created_by'=>1,'created_at'=>$today],
            // ['role_id'=>5, 'permission_id'=>17,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>5, 'permission_id'=>18,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>5, 'permission_id'=>19,'created_by'=>1,'created_at'=>$today],

            // Permissions
            ['role_id'=>5, 'permission_id'=>31,'created_by'=>1,'created_at'=>$today],
            
            // Country
            ['role_id'=>5, 'permission_id'=>41,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>5, 'permission_id'=>44,'created_by'=>1,'created_at'=>$today],

            // Township
            ['role_id'=>5, 'permission_id'=>51,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>5, 'permission_id'=>54,'created_by'=>1,'created_at'=>$today],

            // City
            ['role_id'=>5, 'permission_id'=>61,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>5, 'permission_id'=>64,'created_by'=>1,'created_at'=>$today],

            //Organization
            ['role_id'=>5, 'permission_id'=>121,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>5, 'permission_id'=>122,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>5, 'permission_id'=>123,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>5, 'permission_id'=>124,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>5, 'permission_id'=>125,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>5, 'permission_id'=>126,'created_by'=>1,'created_at'=>$today],

            //Project
            ['role_id'=>5, 'permission_id'=>131,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>5, 'permission_id'=>132,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>5, 'permission_id'=>133,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>5, 'permission_id'=>134,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>5, 'permission_id'=>135,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>5, 'permission_id'=>136,'created_by'=>1,'created_at'=>$today],

            //Location
            ['role_id'=>5, 'permission_id'=>141,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>5, 'permission_id'=>142,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>5, 'permission_id'=>143,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>5, 'permission_id'=>144,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>5, 'permission_id'=>145,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>5, 'permission_id'=>146,'created_by'=>1,'created_at'=>$today],

            //Document
            ['role_id'=>5, 'permission_id'=>151,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>5, 'permission_id'=>152,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>5, 'permission_id'=>153,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>5, 'permission_id'=>154,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>5, 'permission_id'=>155,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>5, 'permission_id'=>156,'created_by'=>1,'created_at'=>$today],

            //Checklistquestion
            ['role_id'=>5, 'permission_id'=>161,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>5, 'permission_id'=>162,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>5, 'permission_id'=>163,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>5, 'permission_id'=>164,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>5, 'permission_id'=>165,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>5, 'permission_id'=>166,'created_by'=>1,'created_at'=>$today],

            //Checklistupload
            ['role_id'=>5, 'permission_id'=>171,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>5, 'permission_id'=>172,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>5, 'permission_id'=>173,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>5, 'permission_id'=>174,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>5, 'permission_id'=>175,'created_by'=>1,'created_at'=>$today],
            ['role_id'=>5, 'permission_id'=>176,'created_by'=>1,'created_at'=>$today],
            // Role Permissions for the Role 5 - End
        );

        DB::table('core_permission_role')->insert($roles);
    }
}
