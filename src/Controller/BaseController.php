<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class BaseController extends Controller
{

    /**
     * @param mixed $data the object to serialize
     * @param int $statusCode
     * @return JsonResponse
     */
    protected function createJsonResponse($data, $statusCode = 200)
    {
        $json = $this->get('serializer')
            ->serialize($data, 'json');

        return new JsonResponse($json, $statusCode, [], true);
    }


}
