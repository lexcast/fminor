<?php
namespace App\Controller;

use Symfony\Component\HttpKernel\Exception\FlattenException;
use Fminor\Core\Controller\BaseController;

class ErrorController extends BaseController
{
    public function exceptionAction(FlattenException $exception)
    {
        return $this->render('error.php', array('exception' => $exception), $exception->getStatusCode());
    }
}
