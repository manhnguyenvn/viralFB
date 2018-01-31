<?php namespace viralfb\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	 
	 
	private $openRoutes = ['generate'];

	public function handle($request, Closure $next)
	{
		
		foreach($this->openRoutes as $route) {
             if ($request->is($route)) {
             return $next($request);
            }
         }
		
		
		return parent::handle($request, $next);
	}

}
