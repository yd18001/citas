<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Schema\Builder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Builder::defaultStringLength(191);
        Schema::defaultStringLength(191);

       /* Blade::directive('spatiecan', function ($expression) {
            return "<?php if (auth('spatie')->check() && auth('spatie')->user()->can{$expression}): ?>";
        });
        
        Blade::directive('endspatiecan', function ($expression) {
            return '<?php endif; ?>';
        });
        */
    }
}
