<?php

namespace App\Controller;

use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{

    /**
     * @Route("admin/index" , name="admin_index")
     */

    public function index(): Response
    {
        return $this->render('admin/index.html.twig');
    }

    /**
     * @Route("admin/removeCache" , name="removeLiipImagineCache")
     */

    public function LiipImagineCacheRemove(CacheManager $cacheManager): Response
    {
        $cacheManager->remove();
        return $this->redirectToRoute('admin_index', [], Response::HTTP_SEE_OTHER);
    }
}
