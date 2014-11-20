<?php

namespace Ema\RgementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function ajaxSynchronizeStudentsAndPromosAction()
    {
        return $this->render('EmaRgementBundle:Admin:ajaxSynchronizeStudentsAndPromos.html.twig', array(
                // ...
            ));    }

}
