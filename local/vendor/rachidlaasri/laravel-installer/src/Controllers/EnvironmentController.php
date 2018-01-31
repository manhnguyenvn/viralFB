<?php

namespace RachidLaasri\LaravelInstaller\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use RachidLaasri\LaravelInstaller\Helpers\EnvironmentManager;
use RachidLaasri\LaravelInstaller\Repositories\EnvironmentRepository;
use DB;
use Artisan;
use MySQLi;

class EnvironmentController extends Controller
{

    /**
     * @var EnvironmentManager
     */
    protected $EnvironmentManager;

    /**
     * @param EnvironmentManager $environmentManager
     */
    public function __construct(EnvironmentManager $environmentManager)
    {
        $this->EnvironmentManager = $environmentManager;
    }

    /**
     * Display the Environment page.
     *
     * @return \Illuminate\View\View
     */
    public function environment()
    {
        //$envConfig = $this->EnvironmentManager->getEnvContent();

        $host = env('DB_HOST');
        $database = env('DB_DATABASE');
        $username = env('DB_USERNAME');
        $password = env('DB_PASSWORD');

        return view('vendor.installer.environment', compact('host', 'database', 'username', 'password'));
    }


    /**
     * Processes the newly saved environment configuration and redirects back.
     *
     * @param Request $input
     * @param Redirector $redirect
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Request $request, Redirector $redirect, EnvironmentRepository $environmentRepository)
    {
        //save .env
        $environmentRepository->SetDatabaseSetting($request);

        //Check DB Connection
        error_reporting(0);
        $mysqli_connection = new MySQLi($request->host, $request->username, $request->password, $request->dbname);
        if ($mysqli_connection->connect_error) {
             return back()->with('dberror', true);
        }
        else {
            // Generate new key in .env
            Artisan::call('key:generate');

            return $redirect->route('requirements');
        }

    }

}
