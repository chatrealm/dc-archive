<?php

namespace Chatrealm\DCArchive\Http;

use App\Http\Middleware\Authenticate as MiddlewareAuthenticate;
use Chatrealm\DCArchive\Auth\Middleware\Authenticate;
use Chatrealm\DCArchive\Http\Middleware\CheckForMaintenanceMode;
use Chatrealm\DCArchive\Http\Middleware\EncryptCookies;
use Chatrealm\DCArchive\Http\Middleware\RedirectIfAuthenticated;
use Chatrealm\DCArchive\Http\Middleware\TrimStrings;
use Chatrealm\DCArchive\Http\Middleware\TrustProxies;
use Chatrealm\DCArchive\Http\Middleware\VerifyCsrfToken;
use Illuminate\Auth\Middleware\AuthenticateWithBasicAuth;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;
use Illuminate\Foundation\Http\Middleware\ValidatePostSize;
use Illuminate\Http\Middleware\SetCacheHeaders;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Routing\Middleware\ValidateSignature;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class Kernel extends HttpKernel {

	/**
	 * The application's global HTTP middleware stack.
	 *
	 * These middleware are run during every request to your application.
	 *
	 * @var array
	 */
	protected $middleware = [
		CheckForMaintenanceMode::class,
		ValidatePostSize::class,
		TrimStrings::class,
		ConvertEmptyStringsToNull::class,
		TrustProxies::class,
	];

	/**
	 * The application's route middleware groups.
	 *
	 * @var array
	 */
	protected $middlewareGroups = [
		'web' => [
			EncryptCookies::class,
			AddQueuedCookiesToResponse::class,
			StartSession::class,
			ShareErrorsFromSession::class,
			VerifyCsrfToken::class,
			SubstituteBindings::class,
		],

		'api' => [
			'throttle:60,1',
			'bindings',
		],
	];

	/**
	 * The application's route middleware.
	 *
	 * These middleware may be assigned to groups or used individually.
	 *
	 * @var array
	 */
	protected $routeMiddleware = [
		'auth' => Authenticate::class,
		'auth.basic' => AuthenticateWithBasicAuth::class,
		'bindings' => SubstituteBindings::class,
		'cache.headers' => SetCacheHeaders::class,
		'can' => Authorize::class,
		'guest' => RedirectIfAuthenticated::class,
		'signed' => ValidateSignature::class,
		'throttle' => ThrottleRequests::class,
		'verified' => EnsureEmailIsVerified::class,
	];

	/**
	 * The priority-sorted list of middleware.
	 *
	 * This forces the listed middleware to always be in the given order.
	 *
	 * @var array
	 */
	protected $middlewarePriority = [
		StartSession::class,
		ShareErrorsFromSession::class,
		MiddlewareAuthenticate::class,
		AuthenticateSession::class,
		SubstituteBindings::class,
		Authorize::class,
	];

}
