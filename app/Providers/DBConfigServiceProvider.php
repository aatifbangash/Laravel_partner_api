<?php

namespace App\Providers;

use App\Models\Partner;
use Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
/**
 * following is the custom service provider. Used to get partners config from the main database and load into the laravel 
 * configuration. Following service provider is register in the config/app.php 'providers' block/secton. 
 */
class DBConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services. is used to register bootstrap related config or settings
     */
    public function register(): void
    {
        // get all the databases settings from nl_partner table (maste db) and create configuration dynamically.
        // NOTE:- Elequent ORM is not working in the service provider. So, use the DB facade instead.
        $partners =  DB::table('nl_partner')->whereIn("partnerId", [181,182])->get();
        if(!empty($partners)) {
            $partners->each(function($item, $key){ // each is the Collection method, used to loop over collection items. 
                Config::set("database.connections.$item->partner_api_key", [
                    'driver' => 'mysql',
                    'host' => $item->hostname,
                    'port' => $item->port,
                    'database' => $item->dbname,
                    'username' => $item->username,
                    'password' => $item->pass,
                    'cultureid' => $item->cultureid,
                    'siteid' => $item->siteid
                ]);
            });
        }
    }

    /**
     * Bootstrap services. will execute once all the service providers register.
     */
    public function boot(): void
    {
        // We can fetch the Elquent Models in the boot() methods. It exceute when the complete application start/bootstrap.
    }
}
