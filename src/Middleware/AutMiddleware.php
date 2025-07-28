<?php 

namespace App\Middleware;

use App\Domain\Models\User;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as Handler;
use Slim\Exception\HttpUnauthorizedException;
use Slim\Psr7\Response as SlimResponse;

class AutMiddleware {
    public function __construct() {}

    public function __invoke(Request $request, Handler $handler): Response
    {
        $auth = $request->getHeaderLine('Authorization'); //Basic YWRyaWFucnVpejFAZ21haWwuY29tOjFhZHJpYW4kOTkw

        if (!$auth || !str_starts_with($auth, 'Basic ')) {
            throw new HttpUnauthorizedException($request);
        }

        $decoded = base64_decode(substr($auth, 6));
        [$email, $password] = explode(':', $decoded); //adrian@gmail.com:12345

        //Cambiar al repositorio encargado....
        $user = User::where('email', $email)->first();

        //Validamos contrasena
        if (!$user || !password_verify($password, $user->password)) {
            throw new HttpUnauthorizedException($request);
        }

        $request = $request->withAttribute('user', $user);

        return $handler->handle($request);
    }
}


?>