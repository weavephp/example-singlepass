<?php
declare(strict_types = 1);
/**
 * Weave example app Middleware.
 */

namespace App\Middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * Weave example app Middleware.
 *
 * All this middleware does is uppercase the 'owner' attribute. Take a look in the
 * App class to see how this comes from the url by using a Router route config and
 * then take a look at the Hello Controller to see how it is used.
 *
 * Note that in this example app we are using Middleman, a single-pass middleware pipeline
 * so we have a single-pass invoke signature. In a double-pass middleware you would need
 * to provide a Response parameter as well. Also note that different single-pass
 * middleware stacks may work differently - such as using a process() or handle()
 * method instead of just invoking $next.
 *
 * @param Request  $request The Request.
 * @param callable $next    A callable to pass execution on to the next middleware.
 *
 * @return Response
 */
class UppercaseOwner
{
	public function __invoke(Request $request, callable $next)
	{
		$owner = $request->getAttribute('owner');
		return $next($request->withAttribute('owner', strtoupper($owner)));
	}
}