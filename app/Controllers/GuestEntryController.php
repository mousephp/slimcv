<?php

namespace App\Controllers;

use App\Requests\CustomRequestHandler;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\GuestEntry;
use Respect\Validation\Validator as v;
use App\Validation\Validator;
use Respect\Validation\Exceptions\NestedValidationException;
use App\Response\CustomResponse;

/**
 * @OA\Info(title="PDO PHP REST API", version="1.0")
 */
class GuestEntryController
{
    protected $validator;

    protected $guestsEntry;

    protected $customResponse;

    protected $cors;

    public function __construct()
    {
        $this->validator = new Validator();

        $this->guestsEntry = new GuestEntry();

        $this->customResponse = new CustomResponse();
    }

    public function createGuest(Request $request, Response $response)
    {
        $this->validator->validate($request, [
            "name" => v::notEmpty(),
            "email" => v::notEmpty()->email(),
            "comments" => v::notEmpty(),
        ]);

        if ($this->validator->failed()) {
            $responseMessage = $this->validator->errors;

            return  $this->customResponse->responseUnprocessable($response, $responseMessage);
        }

        $this->guestsEntry->create([
            'full_name' => CustomRequestHandler::getParam($request, 'name'),
            'email' => CustomRequestHandler::getParam($request, 'email'),
            'comment' => CustomRequestHandler::getParam($request, 'comments')
        ]);

        $responseMessage = "guest entry data created successfully";

        return $this->customResponse->responseSuccess($response, $responseMessage);
    }

    /**
     * @OA\Get(
     *     path="/_slim/slimcv/api/documentation/view-guests.php",
     *     summary="Gets all guests",
     *     tags={"Guests"},
     *     @OA\Response(response="200", description="An example resource")
     *     @OA\Response(response="404", description="Not Found")
     * )
     */
    public function viewGuests(Response $response)
    {
        $guestEntries = $this->guestsEntry->get();

        return $this->customResponse->responseSuccess($response, $guestEntries);
    }


    public function getSingleGuest(Response $response, $id)
    {
        $getSingleGuestEntry = $this->guestsEntry->where(["id" => $id])->get();

        return $this->customResponse->responseSuccess($response, $getSingleGuestEntry);
    }

    public function editGuest(Request $request, Response $response, $id)
    {
        $this->validator->validate($request, [
            "name" => v::notEmpty(),
            "email" => v::notEmpty()->email(),
            "comments" => v::notEmpty(),
        ]);

        if ($this->validator->failed()) {
            $responseMessage = $this->validator->errors;

            return  $this->customResponse->responseUnprocessable($response, $responseMessage);
        }

        $this->guestsEntry->where(["id" => $id])->update([
            'full_name' => CustomRequestHandler::getParam($request, 'name'),
            'email' => CustomRequestHandler::getParam($request, 'email'),
            'comment' => CustomRequestHandler::getParam($request, 'comments')
        ]);

        $responseMessage = "guest entry data updated successfully";

        return $this->customResponse->responseSuccess($response, $responseMessage);
    }


    public function deleteGuest(Response $response, $id)
    {
        $this->guestsEntry->where(["id" => $id])->delete();

        $responseMessage = "guest entry data deleted successfully";

        return $this->customResponse->responseSuccess($response, $responseMessage);
    }

    public function countGuests(Response $response)
    {
        $guestCount = $this->guestsEntry->count();

        return $this->customResponse->responseSuccess($response, $guestCount);
    }
}
