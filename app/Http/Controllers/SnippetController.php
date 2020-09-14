<?php

/**
 * SnippetController.php
 *
 * @author Rich Jowett <rich@jowett.me>
 */

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\SnippetWrite;
use App\Snippet;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

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
        return Snippet::paginate();
    }

    /**
     * Show a specific Snippet
     *
     * @param Snippet $snippet
     * @return Snippet
     */
    public function show(Snippet $snippet): Snippet
    {
        return $snippet;
    }

    /**
     * Create a new Snippet
     *
     * @param SnippetWrite $snippetWrite
     * @return Snippet
     */
    public function store(SnippetWrite $snippetWrite): Snippet
    {
        $snippet = new Snippet($snippetWrite->validated());
        $snippet->save();

        return $snippet;
    }

    /**
     * Update an existing Snippet
     *
     * @param SnippetWrite $snippetWrite
     * @param Snippet $snippet
     * @return Snippet
     */
    public function update(SnippetWrite $snippetWrite, Snippet $snippet): Snippet
    {
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
        $snippet->delete();

        return response()->json([], 204);
    }
}
