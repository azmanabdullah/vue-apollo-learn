<?php
namespace App\GraphQL\Execution;

use Closure;
use GraphQL\Error\Error;
use Nuwave\Lighthouse\Execution\ErrorHandler;
use Illuminate\Auth\AuthenticationException;
use Nuwave\Lighthouse\Exceptions\AuthenticationException as GraphQLAuthenticationException;


class AuthenticationErrorHandler implements ErrorHandler
{

    public static function handle(Error $error, Closure $next): array
    {
        $underlyingException = $error->getPrevious();

        if($underlyingException instanceof AuthenticationException)
        {
            $authError = new GraphQLAuthenticationException();

            $error = new Error(
                $error->message,
                null,
                $error->getSource(),
                null,
                $error->getPath(),
                $authError,
                $authError->extensionsContent()
            );
        }

        return $next($error);
    }

}
