<?php

namespace App\Response;

class CustomResponse
{
    public function responseSuccess($response, $responseMessage)
    {
        $responseMessage = json_encode(["success" => true, "response" => $responseMessage]);

        $response->getBody()->write($responseMessage);

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

    public function responseUnprocessable($response, $responseMessage)
    {
        $responseMessage = json_encode(["success" => false, "response" => $responseMessage]);

        $response->getBody()->write($responseMessage);

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(422);
    }

    public function responseBadRequest($response, $responseMessage)
    {
        $responseMessage = json_encode(["success" => false, "response" => $responseMessage]);
        $response->getBody()->write($responseMessage);
        return $response->withHeader("Content-Type", "application/json")
            ->withStatus(400);
    }

    public function respondInternalError($response, $responseMessage)
    {
        $responseMessage = json_encode(["success" => false, "response" => $responseMessage]);

        $response->getBody()->write($responseMessage);

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(500);
    }

    public function respondNotFound($response, $responseMessage)
    {
        $responseMessage = json_encode(["success" => false, "response" => $responseMessage]);

        $response->getBody()->write($responseMessage);

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(404);
    }
}
