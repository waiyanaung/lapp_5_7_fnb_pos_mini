<?php
Route::group(['middleware' => 'frontendorbackend'], function () {
    // getting backend_url

    $backend_app    = \App\Core\Check::backendUrl();
    
    //Frontend
    Route::get('/', 'Frontend\HomeController@index');
    Route::get('/home', 'Frontend\HomeController@index')->name('home');
    Route::get('/home2', 'Frontend\HomeController@index2')->name('home2');
    Route::get('coming', array('as' => '/coming', 'uses' => 'Frontend\HomeController@comingsoon'));

    Route::any('login','Frontend\LoginController@doLogin');
    Route::get('logout','Frontend\LoginController@logout');

    //Display About Us Information
    Route::get('about_us', array('as' => '/about_us', 'uses' => 'Frontend\AboutUsController@index'));

    Route::get('gallery', array('as' => '/gallery', 'uses' => 'Frontend\GalleryController@index'));
    Route::get('gallery_detail/{id}', array('as' => '/gallery_detail/{id}', 'uses' => 'Frontend\GalleryController@gallery_detail'));
    Route::get('category', array('as' => '/category', 'uses' => 'Frontend\CategoryController@index'));
    Route::get('category_detail/{id}', array('as' => '/category_detail', 'uses' => 'Frontend\CategoryController@detail'));
    Route::get('item', array('as' => '/item', 'uses' => 'Frontend\ItemController@index'));
    Route::post('item', array('as' => '/item', 'uses' => 'Frontend\ItemController@index'));
    Route::get('item_detail/{id}', array('as' => '/item_detail', 'uses' => 'Frontend\ItemDetailController@index'));
    Route::get('article', array('as' => '/article', 'uses' => 'Frontend\ArticleController@index'));
    Route::get('article_detail/{id}', array('as' => '/article_detail/{id}', 'uses' => 'Frontend\ArticleController@article_detail'));
    Route::get('service', array('as' => '/service', 'uses' => 'Frontend\ServiceController@index'));
    Route::get('service_detail/{id}', array('as' => '/service_detail', 'uses' => 'Frontend\ServiceController@detail'));
    Route::get('brand', array('as' => '/item', 'uses' => 'Frontend\BrandController@index'));
    Route::get('brand_detail/{id}', array('as' => '/brand_detail', 'uses' => 'Frontend\BrandController@detail'));

    //Display Contact Us Informmation
    Route::get('contact_us', array('as' => '/contact_us', 'uses' => 'Frontend\ContactUsController@index'));
    Route::post('contact_us', array('as' => '/contact_us', 'uses' => 'Frontend\ContactUsController@store'));

    //Display FAQ Information
    Route::get('faq_information', array('as' => '/faq_information', 'uses' => 'Frontend\FaqInformationController@index'));

    // Display terms and condition information
    Route::get('terms_and_conditions', array('as' => '/terms_and_conditions', 'uses' => 'Frontend\TermAndConditionController@index'));

    //Fronted Language
    Route::get('lang/{lang}', 'FrontendLanguage\FrontendLanguageController@getLanguage');
    Route::post('frontend/language', ['as' => 'frontend/language', 'uses' => 'FrontendLanguage\FrontendLanguageController@changeLanguage']);

    // Password Reset Routes...
    Route::get('password/reset/{token?}', ['as' => 'auth.password.reset', 'uses' => 'Auth\PasswordController@showResetForm']);
    Route::post('password/email', ['as' => 'auth.password.email', 'uses' => 'Auth\PasswordController@sendResetLinkEmail']);
    Route::post('password/reset', ['as' => 'auth.password.reset', 'uses' => 'Auth\PasswordController@reset']);

    // User(Customer Registration)
    Route::get('register','Frontend\UserRegistrationController@create');    
    Route::post('register', 'Frontend\UserRegistrationController@store');
    Route::get('register/check_email', ['as' => 'register/check_email', 'uses' => 'Frontend\UserRegistrationController@check_email']);

    Route::get('register/verify/{confirmationCode}', 'Frontend\UserRegistrationController@verify');
    Route::get('userAuth', array('as' => 'backend_app/userAuth', 'uses' => 'Core\UserController@getAuthUser'));

    Route::post('order', 'Frontend\CartController@order');

    //Frontend After Login
    Route::group(['middleware' => 'web'], function () {
    
        // User(Customer Registration)
        Route::get('cart','Frontend\CartController@create');    
        Route::post('cart', 'Frontend\CartController@store');

    });

    //Backend
    Route::group(['prefix' => 'backend_app'], function () {

        Route::get('/', 'Auth\AuthController@showLogin');
        Route::get('login', array('as' => 'backend_app/login', 'uses' => 'Auth\AuthController@showLogin'));
        Route::post('login', array('as' => 'backend_app/login', 'uses' => 'Auth\AuthController@doLogin'));
        Route::get('logout', array('as' => 'backend_app/logout', 'uses' => 'Auth\AuthController@doLogout'));
        Route::get('dashboard', array('as' => 'backend_app/dashboard', 'uses' => 'Core\DashboardController@dashboard'));
        Route::get('/errors/{errorId}', array('as' => 'backend_app//errors/{errorId}', 'uses' => 'Core\ErrorController@index'));
        Route::get('/unauthorize', array('as' => 'backend_app/unauthorize', 'uses' => 'Core\ErrorController@unauthorize'));

        // Password Reset Routes...
        Route::get('password/reset', ['as' => 'auth.password.reset', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);
        Route::post('password/email', ['as' => 'auth.password.email', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
        Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('password/reset', ['as' => 'auth.password.reset', 'uses' => 'Auth\ResetPasswordController@reset']);

        //User(Customer Registration)
        //    Route::get('register','Frontend\UserRegistrationController@create');
        Route::any('register', 'Frontend\UserRegistrationController@store');
        Route::get('register/check_email', ['as' => 'register/check_email', 'uses' => 'Frontend\UserRegistrationController@check_email']);
        Route::get('register/verify/{confirmationCode}', 'Frontend\UserRegistrationController@verify');
        Route::get('userAuth', array('as' => 'backend_app/userAuth', 'uses' => 'Core\UserController@getAuthUser'));

        // Sample Routes for developers
        Route::get('sample/dynamic_form', array('as' => 'backend_app/sample/dynamic_form', 'uses' => 'Sample\SamplesController@addMore'));
        Route::post('sample/dynamic_form', array('as' => 'backend_app/sample/dynamic_form', 'uses' => 'Sample\SamplesController@addMorePost'));

        Route::get('sample/dynamic_form2/create', array('as' => 'backend_app/sample/dynamic_form2/create', 'uses' => 'Sample\SamplesController@create'));
        Route::post('sample/dynamic_form2/store', array('as' => 'backend_app/sample/dynamic_form2/store', 'uses' => 'Sample\SamplesController@store'));

        Route::post('api/items', array('as' => 'backend_app/api/items', 'uses' => 'Api\ApiItemController@getItems'));
        
        Route::post('api/brands_by_category', array('as' => 'backend_app/api/brands_by_category', 'uses' => 'Api\ApiItemController@getBrandsbyCategory'));
        Route::post('api/item', array('as' => 'backend_app/api/item', 'uses' => 'Api\ApiItemController@getItem'));


    });

    Route::group(['middleware' => 'right'], function () {

        // Backend
        Route::group(['prefix' => 'backend_app'], function () {

            /* Start Config */
            Route::get('config', array('as' => 'backend_app/config', 'uses' => 'Core\ConfigController@edit'));
            Route::post('config', array('as' => 'backend_app/config', 'uses' => 'Core\ConfigController@update'));
            /* End Config */

             /* Start System Reference */
             Route::get('reference', array('as' => 'backend_app/reference', 'uses' => 'Backend\SystemReferenceController@index'));
             /* End ConfSystem Referenceig */

            /* Start Role */
            Route::get('role', array('as' => 'backend_app/role', 'uses' => 'Core\RoleController@index'));
            Route::get('role/create', array('as' => 'backend_app/role/create', 'uses' => 'Core\RoleController@create'));
            Route::post('role/store', array('as' => 'backend_app/role/store', 'uses' => 'Core\RoleController@store'));
            Route::get('role/edit/{id}', array('as' => 'backend_app/role/edit', 'uses' => 'Core\RoleController@edit'));
            Route::post('role/update', array('as' => 'backend_app/role/update', 'uses' => 'Core\RoleController@update'));
            Route::post('role/destroy', array('as' => 'backend_app/role/destroy', 'uses' => 'Core\RoleController@destroy'));
            Route::get('rolePermission/{roleId}', array('as' => 'backend_app/rolePermission', 'uses' => 'Core\RoleController@rolePermission'));
            Route::post('rolePermissionAssign/{id}', array('as' => 'backend_app/rolePermissionAssign', 'uses' => 'Core\RoleController@rolePermissionAssign'));
            Route::post('role/enable', array('as' => 'backend_app/role/enable', 'uses' => 'Core\RoleController@enable'));
            /* End Role */

            /* Start Menu Group */
            Route::get('menu', array('as' => 'backend_app/menu', 'uses' => 'Navigation\PermissionGroupController@index'));
            Route::get('menu/create', array('as' => 'backend_app/menu/create', 'uses' => 'Navigation\PermissionGroupController@create'));
            Route::post('menu/store', array('as' => 'backend_app/menu/store', 'uses' => 'Navigation\PermissionGroupController@store'));
            Route::get('menu/edit/{id}', array('as' => 'backend_app/menu/edit', 'uses' => 'Navigation\PermissionGroupController@edit'));
            Route::post('menu/update', array('as' => 'backend_app/menu/update', 'uses' => 'Navigation\PermissionGroupController@update'));
            Route::post('menu/destroy', array('as' => 'backend_app/menu/destroy', 'uses' => 'Navigation\PermissionGroupController@destroy'));
            /* End Menu Group */

            /* Start Permission */
            Route::get('permission', array('as' => 'backend_app/permission', 'uses' => 'Core\PermissionController@index'));
            Route::get('permission/create', array('as' => 'backend_app/permission/create', 'uses' => 'Core\PermissionController@create'));
            Route::post('permission/store', array('as' => 'backend_app/permission/store', 'uses' => 'Core\PermissionController@store'));
            Route::get('permission/edit/{id}', array('as' => 'backend_app/permission/edit', 'uses' => 'Core\PermissionController@edit'));
            Route::post('permission/update', array('as' => 'backend_app/permission/update', 'uses' => 'Core\PermissionController@update'));
            Route::post('permission/destroy', array('as' => 'backend_app/permission/destroy', 'uses' => 'Core\PermissionController@destroy'));
            /* End Permission */

            /* Start User */
            Route::get('user', array('as' => 'backend_app/user', 'uses' => 'Core\UserController@index'));
            Route::get('user/create', array('as' => 'backend_app/user/create', 'uses' => 'Core\UserController@create'));
            Route::post('user/store', array('as' => 'backend_app/user/store', 'uses' => 'Core\UserController@store'));
            Route::get('user/edit/{id}', array('as' => 'backend_app/user/edit', 'uses' => 'Core\UserController@edit'));
            Route::post('user/update', array('as' => 'backend_app/user/update', 'uses' => 'Core\UserController@update'));
            Route::post('user/destroy', array('as' => 'backend_app/user/destroy', 'uses' => 'Core\UserController@destroy'));
            Route::get('user/profile/{id}', array('as' => 'backend_app/user/profile', 'uses' => 'Core\UserController@profile'));
            Route::get('user/password/{id}', array('as' => 'backend_app/user/password', 'uses' => 'Core\UserController@passwordEdit'));
            Route::post('user/password/{id}', array('as' => 'backend_app/user/password', 'uses' => 'Core\UserController@passwordUpdate'));
            
            Route::get('user/{status}/{id}', array('as' => 'backend_app/user/status', 'uses' => 'Core\UserController@status_change'));
            /* End User */

            //User disable/enable
            Route::post('user/disable', array('as' => 'backend_app/user/disable', 'uses' => 'Core\UserController@disable'));
            Route::post('user/enable', array('as' => 'backend_app/user/enable', 'uses' => 'Core\UserController@enable'));
            Route::get('user/disabled_users', array('as' => 'backend_app/user/disabled_users', 'uses' => 'Core\UserController@disabledUsers'));
            Route::post('user/multipleenable', array('as' => 'backend_app/user/multipleenable', 'uses' => 'Core\UserController@multipleEnable'));

            //Country
            Route::get('country', array('as' => 'backend_app/country', 'uses' => 'Setup\Country\CountryController@index'));
            Route::get('country/create', array('as' => 'backend_app/country/create', 'uses' => 'Setup\Country\CountryController@create'));
            Route::post('country/store', array('as' => 'backend_app/country/store', 'uses' => 'Setup\Country\CountryController@store'));
            Route::get('country/edit/{id}', array('as' => 'backend_app/country/edit', 'uses' => 'Setup\Country\CountryController@edit'));
            Route::post('country/update', array('as' => 'backend_app/country/update', 'uses' => 'Setup\Country\CountryController@update'));
            Route::post('country/destroy', array('as' => 'backend_app/country/destroy', 'uses' => 'Setup\Country\CountryController@destroy'));
            Route::get('country/check_country_name', array('as' => 'backend_app/country/check_country_name', 'uses' => 'Setup\Country\CountryController@check_country_name'));
            Route::post('country/enable', array('as' => 'backend_app/country/enable', 'uses' => 'Setup\Country\CountryController@enable'));

            //Township
            Route::get('township', array('as' => 'backend_app/township', 'uses' => 'Setup\Township\TownshipController@index'));
            Route::get('township/create', array('as' => 'backend_app/township/create', 'uses' => 'Setup\Township\TownshipController@create'));
            Route::post('township/store', array('as' => 'backend_app/township/store', 'uses' => 'Setup\Township\TownshipController@store'));
            Route::get('township/edit/{id}', array('as' => 'backend_app/township/edit', 'uses' => 'Setup\Township\TownshipController@edit'));
            Route::post('township/update', array('as' => 'backend_app/township/update', 'uses' => 'Setup\Township\TownshipController@update'));
            Route::post('township/destroy', array('as' => 'backend_app/township/destroy', 'uses' => 'Setup\Township\TownshipController@destroy'));
            Route::get('township/check_township_name', array('as' => 'backend_app/township/check_township_name', 'uses' => 'Setup\Township\TownshipController@check_township_name'));
            Route::post('township/enable', array('as' => 'backend_app/township/enable', 'uses' => 'Setup\Township\TownshipController@enable'));

            //City
            Route::get('city', array('as' => 'backend_app/city', 'uses' => 'Setup\City\CityController@index'));
            Route::get('city/create', array('as' => 'backend_app/city/create', 'uses' => 'Setup\City\CityController@create'));
            Route::post('city/store', array('as' => 'backend_app/city/store', 'uses' => 'Setup\City\CityController@store'));
            Route::get('city/edit/{id}', array('as' => 'backend_app/city/edit', 'uses' => 'Setup\City\CityController@edit'));
            Route::post('city/update', array('as' => 'backend_app/city/update', 'uses' => 'Setup\City\CityController@update'));
            Route::post('city/destroy', array('as' => 'backend_app/city/destroy', 'uses' => 'Setup\City\CityController@destroy'));
            Route::get('city/check_city_name', array('as' => 'backend_app/city/check_city_name', 'uses' => 'Setup\City\CityController@check_city_name'));
            Route::post('city/enable', array('as' => 'backend_app/city/enable', 'uses' => 'Setup\City\CityController@enable'));

            //FAQ Information
            Route::get('faq_information', array('as' => 'backend_app/faq_information', 'uses' => 'Setup\FaqInformation\FaqInformationController@edit'));
            Route::post('faq_information', array('as' => 'backend_app/faq_information', 'uses' => 'Setup\FaqInformation\FaqInformationController@update'));

            //FAQ Information
            Route::get('faq_information', array('as' => 'backend_app/faq_information', 'uses' => 'Setup\FaqInformation\FaqInformationController@index'));
            Route::get('faq_information/create', array('as' => 'backend_app/faq_information/create', 'uses' => 'Setup\FaqInformation\FaqInformationController@create'));
            Route::post('faq_information/store', array('as' => 'backend_app/faq_information/store', 'uses' => 'Setup\FaqInformation\FaqInformationController@store'));
            Route::get('faq_information/edit/{id}', array('as' => 'backend_app/faq_information/edit', 'uses' => 'Setup\FaqInformation\FaqInformationController@edit'));
            Route::post('faq_information/update', array('as' => 'backend_app/faq_information/update', 'uses' => 'Setup\FaqInformation\FaqInformationController@update'));
            Route::post('faq_information/destroy', array('as' => 'backend_app/faq_information/destroy', 'uses' => 'Setup\FaqInformation\FaqInformationController@destroy'));
            Route::post('faq_information/enable', array('as' => 'backend_app/faq_information/enable', 'uses' => 'Setup\FaqInformation\FaqInformationController@enable'));

            //About Us Information
            Route::get('about_us', array('as' => 'backend_app/about_us', 'uses' => 'Setup\AboutUs\AboutUsController@edit'));
            Route::post('about_us', array('as' => 'backend_app/about_us', 'uses' => 'Setup\AboutUs\AboutUsController@update'));

            // Contact Us Information
            Route::get('contact_us', array('as' => 'backend_app/contact_us', 'uses' => 'Setup\ContactUs\ContactUsController@index'));
            Route::get('contact_us/edit/{id}', array('as' => 'backend_app/contact_us/edit', 'uses' => 'Setup\ContactUs\ContactUsController@edit'));
            Route::post('contact_us/update', array('as' => 'backend_app/contact_us/update', 'uses' => 'Setup\ContactUs\ContactUsController@update'));
            
            // contact us address information
            Route::get('contact_us/address', array('as' => 'backend_app/contact_us/address', 'uses' => 'Setup\ContactUs\ContactUsController@edit_address'));
            Route::post('contact_us/address', array('as' => 'backend_app/contact_us/address', 'uses' => 'Setup\ContactUs\ContactUsController@update_address'));

            //Terms and Condition Information
            Route::get('terms_and_conditions', array('as' => 'backend_app/terms_and_conditions', 'uses' => 'Setup\TermsAndCondition\TermsAndConditionController@edit'));
            Route::post('terms_and_conditions', array('as' => 'backend_app/terms_and_conditions', 'uses' => 'Setup\TermsAndCondition\TermsAndConditionController@update'));

            //Activities
            Route::get('activities', array('as' => 'backend_app/activities', 'uses' => 'Setup\Activities\ActivitiesController@index'));

            //Organizations
            Route::get('organization', array('as' => 'backend_app/organization', 'uses' => 'Setup\Organization\OrganizationController@index'));
            Route::get('organization/create', array('as' => 'backend_app/organization/create', 'uses' => 'Setup\Organization\OrganizationController@create'));
            Route::post('organization/store', array('as' => 'backend_app/organization/store', 'uses' => 'Setup\Organization\OrganizationController@store'));
            Route::get('organization/edit/{id}', array('as' => 'backend_app/organization/edit', 'uses' => 'Setup\Organization\OrganizationController@edit'));
            Route::post('organization/update', array('as' => 'backend_app/organization/update', 'uses' => 'Setup\Organization\OrganizationController@update'));
            Route::post('organization/destroy', array('as' => 'backend_app/organization/destroy', 'uses' => 'Setup\Organization\OrganizationController@destroy'));

            //Projects
            Route::get('project', array('as' => 'backend_app/project', 'uses' => 'Setup\Project\ProjectController@index'));
            Route::get('project/create', array('as' => 'backend_app/project/create', 'uses' => 'Setup\Project\ProjectController@create'));
            Route::post('project/store', array('as' => 'backend_app/project/store', 'uses' => 'Setup\Project\ProjectController@store'));
            Route::get('project/edit/{id}', array('as' => 'backend_app/project/edit', 'uses' => 'Setup\Project\ProjectController@edit'));
            Route::post('project/update', array('as' => 'backend_app/project/update', 'uses' => 'Setup\Project\ProjectController@update'));
            Route::post('project/destroy', array('as' => 'backend_app/project/destroy', 'uses' => 'Setup\Project\ProjectController@destroy'));

            //Locations
            Route::get('location', array('as' => 'backend_app/location', 'uses' => 'Setup\Location\LocationController@index'));
            Route::get('location/create', array('as' => 'backend_app/location/create', 'uses' => 'Setup\Location\LocationController@create'));
            Route::post('location/store', array('as' => 'backend_app/location/store', 'uses' => 'Setup\Location\LocationController@store'));
            Route::get('location/edit/{id}', array('as' => 'backend_app/location/edit', 'uses' => 'Setup\Location\LocationController@edit'));
            Route::post('location/update', array('as' => 'backend_app/location/update', 'uses' => 'Setup\Location\LocationController@update'));
            Route::post('location/destroy', array('as' => 'backend_app/location/destroy', 'uses' => 'Setup\Location\LocationController@destroy'));

            //Documents
            Route::get('document', array('as' => 'backend_app/document', 'uses' => 'Setup\Document\DocumentController@index'));
            Route::get('document/create', array('as' => 'backend_app/document/create', 'uses' => 'Setup\Document\DocumentController@create'));
            Route::post('document/store', array('as' => 'backend_app/document/store', 'uses' => 'Setup\Document\DocumentController@store'));
            Route::get('document/edit/{id}', array('as' => 'backend_app/document/edit', 'uses' => 'Setup\Document\DocumentController@edit'));
            Route::post('document/update', array('as' => 'backend_app/document/update', 'uses' => 'Setup\Document\DocumentController@update'));
            Route::post('document/destroy', array('as' => 'backend_app/document/destroy', 'uses' => 'Setup\Document\DocumentController@destroy'));

            //Checklistquestions
            Route::get('checklistquestion', array('as' => 'backend_app/checklistquestion', 'uses' => 'Setup\Checklistquestion\ChecklistquestionController@index'));
            Route::get('checklistquestion/create', array('as' => 'backend_app/checklistquestion/create', 'uses' => 'Setup\Checklistquestion\ChecklistquestionController@create'));
            Route::post('checklistquestion/store', array('as' => 'backend_app/checklistquestion/store', 'uses' => 'Setup\Checklistquestion\ChecklistquestionController@store'));
            Route::get('checklistquestion/edit/{id}', array('as' => 'backend_app/checklistquestion/edit', 'uses' => 'Setup\Checklistquestion\ChecklistquestionController@edit'));
            Route::post('checklistquestion/update', array('as' => 'backend_app/checklistquestion/update', 'uses' => 'Setup\Checklistquestion\ChecklistquestionController@update'));
            Route::post('checklistquestion/destroy', array('as' => 'backend_app/checklistquestion/destroy', 'uses' => 'Setup\Checklistquestion\ChecklistquestionController@destroy'));

            //Checklistuploads
            Route::get('checklistupload', array('as' => 'backend_app/checklistupload', 'uses' => 'Setup\Checklistupload\ChecklistuploadController@index'));
            Route::get('checklistupload/create', array('as' => 'backend_app/checklistupload/create', 'uses' => 'Setup\Checklistupload\ChecklistuploadController@create'));
            Route::post('checklistupload/store', array('as' => 'backend_app/checklistupload/store', 'uses' => 'Setup\Checklistupload\ChecklistuploadController@store'));
            Route::get('checklistupload/edit/{id}', array('as' => 'backend_app/checklistupload/edit', 'uses' => 'Setup\Checklistupload\ChecklistuploadController@edit'));
            Route::post('checklistupload/update', array('as' => 'backend_app/checklistupload/update', 'uses' => 'Setup\Checklistupload\ChecklistuploadController@update'));
            Route::post('checklistupload/destroy', array('as' => 'backend_app/checklistupload/destroy', 'uses' => 'Setup\Checklistupload\ChecklistuploadController@destroy'));

            //Team
            Route::get('team', array('as' => 'backend_app/team', 'uses' => 'Setup\Team\TeamController@index'));
            Route::get('team/create', array('as' => 'backend_app/team/create', 'uses' => 'Setup\Team\TeamController@create'));
            Route::post('team/store', array('as' => 'backend_app/team/store', 'uses' => 'Setup\Team\TeamController@store'));
            Route::get('team/edit/{id}', array('as' => 'backend_app/team/edit', 'uses' => 'Setup\Team\TeamController@edit'));
            Route::post('team/update', array('as' => 'backend_app/team/update', 'uses' => 'Setup\Team\TeamController@update'));
            Route::post('team/destroy', array('as' => 'backend_app/team/destroy', 'uses' => 'Setup\Team\TeamController@destroy'));
            Route::post('team/enable', array('as' => 'backend_app/team/enable', 'uses' => 'Setup\Team\TeamController@enable'));

            //Product
            Route::get('product', array('as' => 'backend_app/product', 'uses' => 'Setup\Product\ProductController@index'));
            Route::get('product/create', array('as' => 'backend_app/product/create', 'uses' => 'Setup\Product\ProductController@create'));
            Route::post('product/store', array('as' => 'backend_app/product/store', 'uses' => 'Setup\Product\ProductController@store'));
            Route::get('product/edit/{id}', array('as' => 'backend_app/product/edit', 'uses' => 'Setup\Product\ProductController@edit'));
            Route::post('product/update', array('as' => 'backend_app/product/update', 'uses' => 'Setup\Product\ProductController@update'));
            Route::post('product/destroy', array('as' => 'backend_app/product/destroy', 'uses' => 'Setup\Product\ProductController@destroy'));
            Route::post('product/enable', array('as' => 'backend_app/product/enable', 'uses' => 'Setup\Product\ProductController@enable'));

            //Article
            Route::get('article', array('as' => 'backend_app/article', 'uses' => 'Setup\Article\ArticleController@index'));
            Route::get('article/create', array('as' => 'backend_app/article/create', 'uses' => 'Setup\Article\ArticleController@create'));
            Route::post('article/store', array('as' => 'backend_app/article/store', 'uses' => 'Setup\Article\ArticleController@store'));
            Route::get('article/edit/{id}', array('as' => 'backend_app/article/edit', 'uses' => 'Setup\Article\ArticleController@edit'));
            Route::post('article/update', array('as' => 'backend_app/article/update', 'uses' => 'Setup\Article\ArticleController@update'));
            Route::post('article/destroy', array('as' => 'backend_app/article/destroy', 'uses' => 'Setup\Article\ArticleController@destroy'));
            Route::post('article/enable', array('as' => 'backend_app/article/enable', 'uses' => 'Setup\Article\ArticleController@enable'));

            //Articleimage
            Route::get('articleimage', array('as' => 'backend_app/articleimage', 'uses' => 'Setup\ArticleImage\ArticleImageController@index'));
            Route::get('articleimage/create', array('as' => 'backend_app/articleimage/create', 'uses' => 'Setup\ArticleImage\ArticleImageController@create'));
            Route::post('articleimage/store', array('as' => 'backend_app/articleimage/store', 'uses' => 'Setup\ArticleImage\ArticleImageController@store'));
            Route::get('articleimage/edit/{id}', array('as' => 'backend_app/articleimage/edit', 'uses' => 'Setup\ArticleImage\ArticleImageController@edit'));
            Route::post('articleimage/update', array('as' => 'backend_app/articleimage/update', 'uses' => 'Setup\ArticleImage\ArticleImageController@update'));
            Route::post('articleimage/destroy', array('as' => 'backend_app/articleimage/destroy', 'uses' => 'Setup\ArticleImage\ArticleImageController@destroy'));

            //Gallery
            Route::get('gallery', array('as' => 'backend_app/gallery', 'uses' => 'Setup\Gallery\GalleryController@index'));
            Route::get('gallery/create', array('as' => 'backend_app/gallery/create', 'uses' => 'Setup\Gallery\GalleryController@create'));
            Route::post('gallery/store', array('as' => 'backend_app/gallery/store', 'uses' => 'Setup\Gallery\GalleryController@store'));
            Route::get('gallery/edit/{id}', array('as' => 'backend_app/gallery/edit', 'uses' => 'Setup\Gallery\GalleryController@edit'));
            Route::post('gallery/update', array('as' => 'backend_app/gallery/update', 'uses' => 'Setup\Gallery\GalleryController@update'));
            Route::post('gallery/destroy', array('as' => 'backend_app/gallery/destroy', 'uses' => 'Setup\Gallery\GalleryController@destroy'));
            Route::post('gallery/enable', array('as' => 'backend_app/gallery/enable', 'uses' => 'Setup\Gallery\GalleryController@enable'));

            //Galleryimage
            Route::get('galleryimage', array('as' => 'backend_app/galleryimage', 'uses' => 'Setup\GalleryImage\GalleryImageController@index'));
            Route::get('galleryimage/create', array('as' => 'backend_app/galleryimage/create', 'uses' => 'Setup\GalleryImage\GalleryImageController@create'));
            Route::post('galleryimage/store', array('as' => 'backend_app/galleryimage/store', 'uses' => 'Setup\GalleryImage\GalleryImageController@store'));
            Route::get('galleryimage/edit/{id}', array('as' => 'backend_app/galleryimage/edit', 'uses' => 'Setup\GalleryImage\GalleryImageController@edit'));
            Route::post('galleryimage/update', array('as' => 'backend_app/galleryimage/update', 'uses' => 'Setup\GalleryImage\GalleryImageController@update'));
            Route::post('galleryimage/destroy', array('as' => 'backend_app/galleryimage/destroy', 'uses' => 'Setup\GalleryImage\GalleryImageController@destroy'));

            Route::get('galleryimage/add/{id}', array('as' => 'backend_app/galleryimage/add', 'uses' => 'Setup\GalleryImage\GalleryImageController@showAddImageForm'));

            //Service
            Route::get('service', array('as' => 'backend_app/service', 'uses' => 'Setup\Service\ServiceController@index'));
            Route::get('service/create', array('as' => 'backend_app/service/create', 'uses' => 'Setup\Service\ServiceController@create'));
            Route::post('service/store', array('as' => 'backend_app/service/store', 'uses' => 'Setup\Service\ServiceController@store'));
            Route::get('service/edit/{id}', array('as' => 'backend_app/service/edit', 'uses' => 'Setup\Service\ServiceController@edit'));
            Route::post('service/update', array('as' => 'backend_app/service/update', 'uses' => 'Setup\Service\ServiceController@update'));
            Route::post('service/destroy', array('as' => 'backend_app/service/destroy', 'uses' => 'Setup\Service\ServiceController@destroy'));
            Route::post('service/enable', array('as' => 'backend_app/service/enable', 'uses' => 'Setup\Service\ServiceController@enable'));

            //Item
            Route::get('item', array('as' => 'backend_app/item', 'uses' => 'Setup\Item\ItemController@index'));
            Route::get('item/create', array('as' => 'backend_app/item/create', 'uses' => 'Setup\Item\ItemController@create'));
            Route::post('item/store', array('as' => 'backend_app/item/store', 'uses' => 'Setup\Item\ItemController@store'));
            Route::get('item/edit/{id}', array('as' => 'backend_app/item/edit', 'uses' => 'Setup\Item\ItemController@edit'));
            Route::post('item/update', array('as' => 'backend_app/item/update', 'uses' => 'Setup\Item\ItemController@update'));
            Route::post('item/destroy', array('as' => 'backend_app/item/destroy', 'uses' => 'Setup\Item\ItemController@destroy'));
            Route::post('item/enable', array('as' => 'backend_app/item/enable', 'uses' => 'Setup\Item\ItemController@enable'));
            
            //Brand
            Route::get('brand', array('as' => 'backend_app/brand', 'uses' => 'Setup\Brand\BrandController@index'));
            Route::get('brand/create', array('as' => 'backend_app/brand/create', 'uses' => 'Setup\Brand\BrandController@create'));
            Route::post('brand/store', array('as' => 'backend_app/brand/store', 'uses' => 'Setup\Brand\BrandController@store'));
            Route::get('brand/edit/{id}', array('as' => 'backend_app/brand/edit', 'uses' => 'Setup\Brand\BrandController@edit'));
            Route::post('brand/update', array('as' => 'backend_app/brand/update', 'uses' => 'Setup\Brand\BrandController@update'));
            Route::post('brand/destroy', array('as' => 'backend_app/brand/destroy', 'uses' => 'Setup\Brand\BrandController@destroy'));
            Route::post('brand/enable', array('as' => 'backend_app/brand/enable', 'uses' => 'Setup\Brand\BrandController@enable'));

            //Category
            Route::get('category', array('as' => 'backend_app/category', 'uses' => 'Setup\Category\CategoryController@index'));
            Route::get('category/create', array('as' => 'backend_app/category/create', 'uses' => 'Setup\Category\CategoryController@create'));
            Route::post('category/store', array('as' => 'backend_app/category/store', 'uses' => 'Setup\Category\CategoryController@store'));
            Route::get('category/edit/{id}', array('as' => 'backend_app/category/edit', 'uses' => 'Setup\Category\CategoryController@edit'));
            Route::post('category/update', array('as' => 'backend_app/category/update', 'uses' => 'Setup\Category\CategoryController@update'));
            Route::post('category/destroy', array('as' => 'backend_app/category/destroy', 'uses' => 'Setup\Category\CategoryController@destroy'));
            Route::post('category/enable', array('as' => 'backend_app/category/enable', 'uses' => 'Setup\Category\CategoryController@enable'));

            //Slider
            Route::get('slider', array('as' => 'backend_app/slider', 'uses' => 'Setup\Slider\SliderController@index'));
            Route::get('slider/create', array('as' => 'backend_app/slider/create', 'uses' => 'Setup\Slider\SliderController@create'));
            Route::post('slider/store', array('as' => 'backend_app/slider/store', 'uses' => 'Setup\Slider\SliderController@store'));
            Route::get('slider/edit/{id}', array('as' => 'backend_app/slider/edit', 'uses' => 'Setup\Slider\SliderController@edit'));
            Route::post('slider/update', array('as' => 'backend_app/slider/update', 'uses' => 'Setup\Slider\SliderController@update'));
            Route::post('slider/destroy', array('as' => 'backend_app/slider/destroy', 'uses' => 'Setup\Slider\SliderController@destroy'));
            Route::post('slider/enable', array('as' => 'backend_app/slider/enable', 'uses' => 'Setup\Slider\SliderController@enable'));

            //Service
            Route::get('service', array('as' => 'backend_app/service', 'uses' => 'Setup\Service\ServiceController@index'));
            Route::get('service/create', array('as' => 'backend_app/service/create', 'uses' => 'Setup\Service\ServiceController@create'));
            Route::post('service/store', array('as' => 'backend_app/service/store', 'uses' => 'Setup\Service\ServiceController@store'));
            Route::get('service/edit/{id}', array('as' => 'backend_app/service/edit', 'uses' => 'Setup\Service\ServiceController@edit'));
            Route::post('service/update', array('as' => 'backend_app/service/update', 'uses' => 'Setup\Service\ServiceController@update'));
            Route::post('service/destroy', array('as' => 'backend_app/service/destroy', 'uses' => 'Setup\Service\ServiceController@destroy'));
            Route::post('service/enable', array('as' => 'backend_app/service/enable', 'uses' => 'Setup\Service\ServiceController@enable'));

            
            //TransactionOrder
            Route::get('transaction_order', array('as' => 'backend_app/transaction_order', 'uses' => 'Setup\TransactionOrder\TransactionOrderController@index'));
            Route::get('transaction_order/create', array('as' => 'backend_app/transaction_order/create', 'uses' => 'Setup\TransactionOrder\TransactionOrderController@create'));
            Route::post('transaction_order/store', array('as' => 'backend_app/transaction_order/store', 'uses' => 'Setup\TransactionOrder\TransactionOrderController@store'));
            Route::get('transaction_order/edit/{id}', array('as' => 'backend_app/transaction_order/edit', 'uses' => 'Setup\TransactionOrder\TransactionOrderController@edit'));
            Route::post('transaction_order/update', array('as' => 'backend_app/transaction_order/update', 'uses' => 'Setup\TransactionOrder\TransactionOrderController@update'));
            Route::post('transaction_order/destroy', array('as' => 'backend_app/transaction_order/destroy', 'uses' => 'Setup\TransactionOrder\TransactionOrderController@destroy'));
            Route::post('transaction_order/enable', array('as' => 'backend_app/transaction_order/enable', 'uses' => 'Setup\TransactionOrder\TransactionOrderController@enable'));

            //Transaction
            Route::get('transaction', array('as' => 'backend_app/transaction', 'uses' => 'Setup\Transaction\TransactionController@index'));
            Route::get('transaction/create', array('as' => 'backend_app/transaction/create', 'uses' => 'Setup\Transaction\TransactionController@create'));
            Route::post('transaction/store', array('as' => 'backend_app/transaction/store', 'uses' => 'Setup\Transaction\TransactionController@store'));
            Route::get('transaction/{id}/edit', array('as' => 'backend_app/transaction/edit', 'uses' => 'Setup\Transaction\TransactionController@edit'));
            Route::post('transaction/update', array('as' => 'backend_app/transaction/update', 'uses' => 'Setup\Transaction\TransactionController@update'));
            Route::post('transaction/destroy', array('as' => 'backend_app/transaction/destroy', 'uses' => 'Setup\Transaction\TransactionController@destroy'));
            Route::post('transaction/enable', array('as' => 'backend_app/transaction/enable', 'uses' => 'Setup\Transaction\TransactionController@enable'));
            Route::get('transaction/{id}', array('as' => 'backend_app/transaction/show', 'uses' => 'Setup\Transaction\TransactionController@show'));
            Route::post('transaction/payment/store', array('as' => 'backend_app/transaction/payment/store', 'uses' => 'Setup\Transaction\TransactionController@addPayment'));

            //ExpenseType
            Route::get('expense_type', array('as' => 'backend_app/expense_type', 'uses' => 'Setup\ExpenseType\ExpenseTypeController@index'));
            Route::get('expense_type/create', array('as' => 'backend_app/expense_type/create', 'uses' => 'Setup\ExpenseType\ExpenseTypeController@create'));
            Route::post('expense_type/store', array('as' => 'backend_app/expense_type/store', 'uses' => 'Setup\ExpenseType\ExpenseTypeController@store'));
            Route::get('expense_type/{id}/edit', array('as' => 'backend_app/expense_type/edit', 'uses' => 'Setup\ExpenseType\ExpenseTypeController@edit'));
            Route::post('expense_type/update', array('as' => 'backend_app/expense_type/update', 'uses' => 'Setup\ExpenseType\ExpenseTypeController@update'));
            Route::post('expense_type/destroy', array('as' => 'backend_app/expense_type/destroy', 'uses' => 'Setup\ExpenseType\ExpenseTypeController@destroy'));
            Route::post('expense_type/enable', array('as' => 'backend_app/expense_type/enable', 'uses' => 'Setup\ExpenseType\ExpenseTypeController@enable'));
            Route::get('expense_type/{id}', array('as' => 'backend_app/expense_type/show', 'uses' => 'Setup\ExpenseType\ExpenseTypeController@show'));

            //Expense
            Route::get('expense', array('as' => 'backend_app/expense', 'uses' => 'Setup\Expense\ExpenseController@index'));
            Route::get('expense/create', array('as' => 'backend_app/expense/create', 'uses' => 'Setup\Expense\ExpenseController@create'));
            Route::post('expense/store', array('as' => 'backend_app/expense/store', 'uses' => 'Setup\Expense\ExpenseController@store'));
            Route::get('expense/{id}/edit', array('as' => 'backend_app/expense/edit', 'uses' => 'Setup\Expense\ExpenseController@edit'));
            Route::post('expense/update', array('as' => 'backend_app/expense/update', 'uses' => 'Setup\Expense\ExpenseController@update'));
            Route::post('expense/destroy', array('as' => 'backend_app/expense/destroy', 'uses' => 'Setup\Expense\ExpenseController@destroy'));
            Route::post('expense/enable', array('as' => 'backend_app/expense/enable', 'uses' => 'Setup\Expense\ExpenseController@enable'));
            Route::get('expense/{id}', array('as' => 'backend_app/expense/show', 'uses' => 'Setup\Expense\ExpenseController@show'));  
            
            //SaleSummary Report
            Route::get('salesummaryreport',array(
                'as'=>'backend_app/salesummaryreport',
                'uses'=>'Report\SaleSummaryReportController@index'
            ));
            Route::get('salesummaryreport/search/{type?}/{from?}/{to?}',
                array(
                    'as'=>'backend_app/salesummaryreport/search/{type?}/{from?}/{to?}',
                    'uses'=>'Report\SaleSummaryReportController@search'
                ));
            Route::get('salesummaryreport/exportexcel/{type?}/{from?}/{to?}',
                array(
                    'as'=>'backend_app/salesummaryreport/exportexcel/{type?}/{from?}/{to?}',
                    'uses'=>'Report\SaleSummaryReportController@excel'
                ));
            

            //Expense Report
            Route::get('report/expense',array(
                'as'=>'backend_app/report/expense',
                'uses'=>'Report\ExpenseReportController@index'
            ));

            //Expense Report
            Route::post('report/expense',array(
                'as'=>'backend_app/report/expense',
                'uses'=>'Report\ExpenseReportController@view'
            ));

        });
            
    });

});
