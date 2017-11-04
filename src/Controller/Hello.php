<?php
declare(strict_types = 1);
/**
 * Weave example app Hello Controller.
 */

namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * Weave example app Hello Controller.
 */
class Hello
{
	/**
	 * The message string provided on init.
	 *
	 * Look in App\Config to see how this is provided from the app config.
	 *
	 * @var string
	 */
	protected $_message;

	/**
	 * The factory for creating PSR7 response objects.
	 */
	protected $_responseFactory;

	/**
	 * Constructor.
	 *
	 * As this is a single-pass middleware based app, no Response
	 * is provided when calling the Controller method. Instead, a
	 * response must be created when needed. Weave provides an interface
	 * for this which the DIC should resolve for you.
	 *
	 * @param string $message The message value from the app config.
	 */
	public function __construct(
		$message,
		\Weave\Http\ResponseFactoryInterface $responseFactory
	) {
		$this->_message = $message;
		$this->_responseFactory = $responseFactory;
	}

	/**
	 * The Hello contoller method.
	 *
	 * In this app we are using a single-pass middleware stack so
	 * only a Request is provided. In a double-pass stack
	 * you would also receive a Response object.
	 *
	 * @param Request $request The Request.
	 *
	 * @return Response
	 */
	public function hello(Request $request)
	{
		$response = $this->_responseFactory->newResponse();
		$owner = $request->getAttribute('owner');
		$response->getBody()->write($this->_message . ", " . $owner . "\n");
		return $response->withHeader('Content-Type', 'text/plain');
	}
}