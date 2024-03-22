<?php

namespace App\Http;

/**
 * implement response in json for implements api
 */
class JsonResponse
{
    private array $body;

    private int $status;

    /**
     * create JsonResponse object to build a json response
     *
     * @params array $body
     * @params int $status
     */
    private function __construct(array $body, int $status = 200)
    {
        $this->body = $body;
        $this->status = $status;
    }

    /**
     * create a json response with staus code 200
     *
     * @params array $body
     *
     * @return JsonResponse object
     */
    public static function ok(array $body): JsonResponse
    {
        $JsonResponse = new JsonResponse($body);

        return $JsonResponse;
    }

    /**
     * create a json response with status code 404
     *
     * @params array $body
     *
     * @return JsonResponse object
     */
    public static function notFound(array $body): JsonResponse
    {
        $JsonResponse = new JsonResponse($body, 404);

        return $JsonResponse;
    }

    /**
     * create a json response with status code 201
     *
     * @params array $body
     *
     * @return JsonResponse object
     */
    public static function created(array $body): JsonResponse
    {
        $JsonResponse = new JsonResponse($body, 201);

        return $JsonResponse;
    }

    /**
     * build the response and send json
     *
     * @return void
     */
    public function send()
    {
        http_response_code($this->status);
        header('Content-Type: application/json');
        echo json_encode($this->body);
    }
}
