<?php

namespace CodeShopping\Http\Controllers\Api;

use CodeShopping\Common\OnlyTrashed;
use CodeShopping\Http\Resources\UserResource;
use CodeShopping\Models\User;
use CodeShopping\Http\Requests\UserRequest;
use CodeShopping\Http\Controllers\Controller;

class UserController extends Controller
{
    use OnlyTrashed;

    public function index()
    {
        $query = User::query();
        $users = User::paginate(10);
        return UserResource::collection($users);
    }

    public function store(UserRequest $request)
    {
        $user= User::create($request->all());
        return new UserResource($user);
    }

    public function show(User $user)
    {
        return new UserResource($user);
    }

    public function update(UserRequest $request, User $user)
    {
        $user->fill($request->all());
        $user->save();
        return new UserResource($user);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json([], 204);
    }

    public function restore(User $user)
    {
        $user->restore();
        return response()->json([],204);
    }
}
