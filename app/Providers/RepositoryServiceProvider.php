<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Core\Role\RoleRepositoryInterface','App\Core\Role\RoleRepository');
        $this->app->bind('App\Core\Permission\PermissionRepositoryInterface','App\Core\Permission\PermissionRepository');
        $this->app->bind('App\Core\Config\ConfigRepositoryInterface','App\Core\Config\ConfigRepository');
        $this->app->bind('App\Core\User\UserRepositoryInterface','App\Core\User\UserRepository');
        $this->app->bind('App\Setup\Customer\CustomerRepositoryInterface','App\Setup\Customer\CustomerRepository');

        //Backend
        $this->app->bind('App\Setup\Country\CountryRepositoryInterface','App\Setup\Country\CountryRepository');
        $this->app->bind('App\Setup\Township\TownshipRepositoryInterface','App\Setup\Township\TownshipRepository');
        $this->app->bind('App\Setup\City\CityRepositoryInterface','App\Setup\City\CityRepository');        
        $this->app->bind('App\Setup\Autocomplete\AutocompleteRepositoryInterface','App\Setup\Autocomplete\AutocompleteRepository');
        $this->app->bind('App\Setup\Customer\CustomerRepositoryInterface','App\Setup\Customer\CustomerRepository');
        $this->app->bind('App\Setup\Report\ReportRepositoryInterface','App\Setup\Report\ReportRepository');        
        $this->app->bind('App\Setup\Slider\SliderRepositoryInterface','App\Setup\Slider\SliderRepository');
        $this->app->bind('App\Setup\Page\PageRepositoryInterface','App\Setup\Page\PageRepository');        
        $this->app->bind('App\Setup\CsvImport\CsvImportRepositoryInterface','App\Setup\CsvImport\CsvImportRepository');
        $this->app->bind('App\Navigation\PermissionGroup\PermissionGroupRepositoryInterface','App\Navigation\PermissionGroup\PermissionGroupRepository');

        $this->app->bind('App\Setup\Organization\OrganizationRepositoryInterface','App\Setup\Organization\OrganizationRepository');
        $this->app->bind('App\Setup\Project\ProjectRepositoryInterface','App\Setup\Project\ProjectRepository');
        $this->app->bind('App\Setup\Location\LocationRepositoryInterface','App\Setup\Location\LocationRepository');
        $this->app->bind('App\Setup\Document\DocumentRepositoryInterface','App\Setup\Document\DocumentRepository');
        $this->app->bind('App\Setup\Checklistquestion\ChecklistquestionRepositoryInterface','App\Setup\Checklistquestion\ChecklistquestionRepository');
        $this->app->bind('App\Setup\Checklistupload\ChecklistuploadRepositoryInterface','App\Setup\Checklistupload\ChecklistuploadRepository');

        $this->app->bind('App\Setup\Team\TeamRepositoryInterface','App\Setup\Team\TeamRepository');
        $this->app->bind('App\Setup\Product\ProductRepositoryInterface','App\Setup\Product\ProductRepository');
        $this->app->bind('App\Setup\Gallery\GalleryRepositoryInterface','App\Setup\Gallery\GalleryRepository');
        $this->app->bind('App\Setup\GalleryImage\GalleryImageRepositoryInterface','App\Setup\GalleryImage\GalleryImageRepository');
        $this->app->bind('App\Setup\Article\ArticleRepositoryInterface','App\Setup\Article\ArticleRepository');
        $this->app->bind('App\Setup\ArticleImage\ArticleImageRepositoryInterface','App\Setup\ArticleImage\ArticleImageRepository');

        $this->app->bind('App\Setup\Service\ServiceRepositoryInterface','App\Setup\Service\ServiceRepository');
        $this->app->bind('App\Setup\Team\TeamRepositoryInterface','App\Setup\Team\TeamRepository');
        $this->app->bind('App\Setup\Item\ItemRepositoryInterface','App\Setup\Item\ItemRepository');
        $this->app->bind('App\Setup\Category\CategoryRepositoryInterface','App\Setup\Category\CategoryRepository');
        $this->app->bind('App\Setup\ContactUs\ContactUsRepositoryInterface','App\Setup\ContactUs\ContactUsRepository');

        $this->app->bind('App\Setup\Brand\BrandRepositoryInterface','App\Setup\Brand\BrandRepository');
        $this->app->bind('App\Setup\FaqInformation\FaqInformationRepositoryInterface','App\Setup\FaqInformation\FaqInformationRepository');

        $this->app->bind('App\Setup\TransactionOrder\TransactionOrderRepositoryInterface','App\Setup\TransactionOrder\TransactionOrderRepository');

        $this->app->bind('App\Setup\Transaction\TransactionRepositoryInterface','App\Setup\Transaction\TransactionRepository');
        $this->app->bind('App\Setup\TransactionPayment\TransactionPaymentRepositoryInterface','App\Setup\TransactionPayment\TransactionPaymentRepository');

        $this->app->bind('App\Setup\Expense\ExpenseRepositoryInterface','App\Setup\Expense\ExpenseRepository');
        $this->app->bind('App\Setup\ExpenseType\ExpenseTypeRepositoryInterface','App\Setup\ExpenseType\ExpenseTypeRepository');
        
    }
}