<?php namespace viralfb\Providers;

use Illuminate\Support\ServiceProvider;
use Request;
use viralfb\Option;
use DB;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (file_exists(storage_path('installed'))) {

            //Site settings
            $json_cu_variabile = DB::table('configs')
                ->where('nume', 'basic')
                ->pluck('valoare');

            $json_cu_variabile = json_decode($json_cu_variabile, true);

            //Site colors
            $json_cu_culori = DB::table('configs')
                ->where('nume', 'colors')
                ->pluck('valoare');

            $json_cu_culori = json_decode($json_cu_culori, true);

            view()->share('colors', $json_cu_culori);
            view()->share('json_cu_variabile', $json_cu_variabile);

            //Languages
            $languages = DB::table('configs')->where('nume', 'languages')->pluck('valoare');
            $languages = json_decode($languages, true);
            $active = $languages['active'];
            $lang = $languages[$active];

            view()->share('lang', $lang);

            //Widgets
            $widgets = DB::table('configs')->where('nume', 'widgets')->pluck('valoare');
            $orig = ['[site-domain]', '[year]', '[url]'];
            $new = [Request::server('SERVER_NAME'), date('Y'), url()];
            $widgets = str_replace($orig, $new, $widgets);
            $allwidgets = json_decode($widgets, true);
            $widgets_on = [];
            foreach ($allwidgets['under-header'] as $under_h_w) {
                if ($under_h_w['activeapps'] == 'on') {
                    array_push($widgets_on, 1);
                }
            }
            $widgets_on = count($widgets_on);
            view()->share(compact('allwidgets', 'widgets_on'));
        }
    }

    /**
     * Register any application services.
     *
     * This service provider is a great spot to register your various container
     * bindings with the application. As you can see, we are registering our
     * "Registrar" implementation here. You can add your own bindings too!
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'Illuminate\Contracts\Auth\Registrar',
            'viralfb\Services\Registrar'
        );
    }

}
