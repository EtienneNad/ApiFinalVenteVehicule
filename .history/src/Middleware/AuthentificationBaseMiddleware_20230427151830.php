<?php

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use App\Domain\Vehicule\Service\AuthentificationBaseValidation;

class AuthentificationBaseMiddleware
{

    /**
     * @var ResponseFactoryInterface
     */
    private $responseFactory;

    /**
     * @var AuthentificationBaseValidation
     */
    private $AuthentificationBaseValidation;

    /**
     * The constructor.
     *
     * @param ResponseFactoryInterface $responseFactory The response factory
     */
    public function __construct(ResponseFactoryInterface $responseFactory,
    AuthentificationBaseValidation $AuthentificationBaseValidation) {
        $this->responseFactory = $responseFactory;
        $this->AuthentificationBaseValidation = $AuthentificationBaseValidation;
    }
    
    /**
     *
     * @param  Request  $request PSR-7 request
     * @param  RequestHandler $handler PSR-15 request handler
     *
     * @return ResponseInterface
     */
    public function __invoke(
        Request $request, 
        RequestHandler $handler): ResponseInterface
    {        
        // Extract encode token from header
        $token = explode(' ', $request->getHeaderLine('Authorization'))[1] ?? '';

        if (!$this->AuthentificationBaseValidation->TokenEstValide($token)) {
            // If the token is not valid, return empty response qith status code 401
            return $this->responseFactory->createResponse()
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(401, 'Unauthorized');
        }
       
        // Otherwise return unmodified response.
        return $handler->handle($request);
    }
}
