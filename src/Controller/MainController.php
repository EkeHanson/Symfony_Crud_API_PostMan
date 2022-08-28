<?php

namespace App\Controller;
use App\Entity\Curd;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
     * @Route("/main", name="main.")
     */
class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to my new World of  APIs!',
            'path' => 'src/Controller/MainController.php',
        ]);
    }
    /**
     * @Route("/post", name="post")
     */
    public function post(Request $request): JsonResponse
    {
        $crud = new Curd();
        $parameter = json_decode($request->getContent(), true);
        $crud->setContent($parameter['content']);
        $crud->setTitle($parameter['title']);
       

        $em = $this->getDoctrine()->getManager();
        $em->persist($crud);
        $em->flush();
       // dd($parameter);


        return $this->json(['Insertion completed successfully' ]);
    }
    
    
    /**
     * @Route("/put/{id}", name="put")
     */
    public function put(Request $request, $id): JsonResponse
    {
        $data = $this->getDoctrine()->getRepository(curd::class)->find($id);
        $parameter = json_decode($request->getContent(), true);
        //dd($data);
        $data->setTitle($parameter['title']);
        $data->setContent($parameter['content']);
       
        $em = $this->getDoctrine()->getManager();
        $em->persist($data);
        $em->flush();
       // dd($parameter);


        return $this->json(['Updating completed successfully' ]);
    }
}
