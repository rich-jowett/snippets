<?php

/**
 * UserController.php
 *
 * @author Rich Jowett <rich@jowett.me>
 */

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UserCreate;
use App\Http\Requests\UserUpdate;
use App\Models\User;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Throwable;

/**
 * Class UserController
 *
 * @author Rich Jowett <rich@jowett.me>
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return User[]|Collection
     */
    public function index()
    {
        /** @var User $authenticatedUser */
        $authenticatedUser = Auth::user();
        if ($authenticatedUser->can('view_all_users')) {
            return User::paginate();
        }

        if ($authenticatedUser->allTeams()) {
            $teamIds = array_column(
                $authenticatedUser
                    ->allTeams()
                    ->toArray(),
                'id'
            );

            $allRelatedUsers = User::select('users.*')
                ->leftJoin('teams', 'users.id', '=', 'teams.user_id')
                ->leftJoin('team_user', 'users.id', '=', 'team_user.user_id')
                ->whereIn('teams.id', $teamIds)
                ->orWhereIn('team_user.team_id', $teamIds);

            return $allRelatedUsers->paginate();
        }

        return User::where('id', '=', $authenticatedUser->id)->paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserCreate $userCreate
     * @return User
     * @throws Throwable
     */
    public function store(UserCreate $userCreate): User
    {
        $this->authorize('create', [ Auth::user() ]);

        $userFields = $userCreate->validated();
        $userFields['password'] = bcrypt($userFields['password']);

        $user = new User($userFields);
        $user->saveOrFail();

        return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return User
     * @throws AuthorizationException
     */
    public function show(User $user): User
    {
        $this->authorize('view', [ $user ]);

        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserUpdate $userUpdate
     * @param User $user
     * @return User
     * @throws AuthorizationException
     */
    public function update(UserUpdate $userUpdate, User $user): User
    {
        $this->authorize('update', [ $user ]);

        $user->update($userUpdate->validated());

        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws Exception
     */
    public function destroy(User $user): JsonResponse
    {
        $this->authorize('delete', [ $user ]);

        $user->delete();
        return response()->json([], 204);
    }
}
