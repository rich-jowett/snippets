<?php

/**
 * SnippetController.php
 *
 * @author Rich Jowett <rich@jowett.me>
 */

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\SnippetWrite;
use App\Models\Snippet;
use App\Models\User;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

/**
 * Class SnippetController
 *
 * @author Rich Jowett <rich@jowett.me>
 * @package App\Http\Controllers
 */
class SnippetController extends Controller
{
    /**
     * List all Snippets
     *
     * @return Snippet[]|Collection
     */
    public function index()
    {
        /** @var User $authenticatedUser */
        $authenticatedUser = Auth::user();
        if ($authenticatedUser->can('view_all_snippets')) {
            return Snippet::paginate();
        }

        if ($authenticatedUser->allTeams()) {
            $teamIds = array_column(
                $authenticatedUser
                    ->allTeams()
                    ->toArray(),
                'id'
            );

            $snippetsForRelatedUsers = Snippet::select('snippets.*')
                ->join('users', 'snippets.created_by', '=', 'users.id')
                ->leftJoin('teams', 'users.id', '=', 'teams.user_id')
                ->leftJoin('team_user', 'users.id', '=', 'team_user.user_id')
                ->whereIn('teams.id', $teamIds)
                ->orWhereIn('team_user.team_id', $teamIds);

            return $snippetsForRelatedUsers->paginate();
        }

        return Snippet::where('created_by', '=', $authenticatedUser->id)->paginate();
    }

    /**
     * Show a specific Snippet
     *
     * @param Snippet $snippet
     * @return Snippet
     * @throws AuthorizationException
     */
    public function show(Snippet $snippet): Snippet
    {
        $this->authorize('view', [ $snippet ]);

        return $snippet;
    }

    /**
     * Create a new Snippet
     *
     * @param SnippetWrite $snippetWrite
     * @return Snippet
     * @throws AuthorizationException
     */
    public function store(SnippetWrite $snippetWrite): Snippet
    {
        $this->authorize('create', [ Auth::user() ]);

        $snippetFields = $snippetWrite->validated();
        $snippetFields['created_by'] = (Auth::user())->id;

        $snippet = new Snippet($snippetFields);
        $snippet->save();

        return $snippet;
    }

    /**
     * Update an existing Snippet
     *
     * @param SnippetWrite $snippetWrite
     * @param Snippet $snippet
     * @return Snippet
     * @throws AuthorizationException
     */
    public function update(SnippetWrite $snippetWrite, Snippet $snippet): Snippet
    {
        $this->authorize('create', [ $snippet ]);
        $snippet->update($snippetWrite->validated());

        return $snippet;
    }

    /**
     * Destroy an existing Snippet
     *
     * @param Snippet $snippet
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Snippet $snippet): JsonResponse
    {
        $this->authorize('create', [ $snippet ]);
        $snippet->delete();

        return response()->json([], 204);
    }
}
