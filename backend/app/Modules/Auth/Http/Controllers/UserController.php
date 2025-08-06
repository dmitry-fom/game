<?php

namespace App\Modules\Auth\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Modules\Auth\DTO\User as UserDTO;
use App\Modules\Auth\Actions\RegisterUserAction;
use App\Modules\Auth\Actions\DeactivateMagicLink;
use App\Modules\Auth\Actions\RegenerateMagicLink;
use App\Modules\Auth\Http\Requests\RegisterUserData;
use App\Modules\Share\Http\Controllers\BaseController;

class UserController extends BaseController
{
    public function register(
        RegisterUserData   $data,
        RegisterUserAction $registerUserAction,
    ): JsonResponse
    {
        $registerDTO = $registerUserAction($data);

        return response()->json($registerDTO, 201);
    }

    public function deactivate(
        DeactivateMagicLink $deactivateLinkAction,
    ): Response
    {
        $deactivateLinkAction($this->getUser());

        return response()->noContent();
    }

    public function regenerate(
        RegenerateMagicLink $deactivateLinkAction,
    ): JsonResponse
    {
        $magicLinkDTO = $deactivateLinkAction($this->getUser());

        return response()->json($magicLinkDTO, 201);
    }

    public function me(): JsonResponse
    {
        $user = $this->getUser();

        return response()->json(
            new UserDTO(
                id: $user->id,
                username: $user->username,
                phone: $user->phone->value()
            )
        );
    }
}
