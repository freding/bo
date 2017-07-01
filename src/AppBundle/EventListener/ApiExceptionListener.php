<?php

namespace AppBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Exception\ApiValidationException;
use AppBundle\Component\Response\Model\ApiErrorResponse;

/**
 * ApiExceptionListener
 * @author F.Bourbigot
 */
class ApiExceptionListener
{
    const API_REST_CONTROLLER_FOLDER = "ApiController";
    
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        if ($this->isApiController($event->getRequest())) {
            return $event->getException();
        }
        
        $response = $this->getApiFormatedResponse($event->getException());
        if ($response) {
            return $event->setResponse($response);
        }
    }
    
    /**
     * Check if Controller call is Api one
     * @param Request $request
     * @return bool
     */
    private function isApiController(Request $request)
    {
        return (strpos($request->get("_controller"), self::API_REST_CONTROLLER_FOLDER) === false);
    }
    
    /**
     * Return Formated Response for Api
     * @param \Exception $exception
     * @return Response|null
     */
    private function getApiFormatedResponse(\Exception $exception)
    {
        $apiErrorResponse = new ApiErrorResponse();
        if ($exception instanceof NotFoundHttpException) {
            $apiErrorResponse->setMessage("Ressource not found");
            return new JsonResponse($apiErrorResponse, Response::HTTP_NOT_FOUND);
        } elseif ($exception instanceof ApiValidationException) {
            $apiErrorResponse->setMessage($exception->getMessage());
            return new JsonResponse($apiErrorResponse, Response::HTTP_BAD_REQUEST);
        }
    }
}
