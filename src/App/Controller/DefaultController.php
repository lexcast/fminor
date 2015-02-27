<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Fminor\Core\Controller\BaseController;

class DefaultController extends BaseController
{
	public function indexAction(Request $request, $name)
	{
		return $this->render('hello.php', array('name'=>$name));	
	}
}
