<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Article;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ArticleResource;
use Illuminate\Http\JsonResponse;

class ArticleAPIController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        $articles = Article::all();

        return $this->sendResponse(
            ArticleResource::collection($articles),
            'Articles retrieved successfully.'
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required',
            'user_id' => 'required',
            'file_path' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $article = Article::create($input);

        return $this->sendResponse(
            new ArticleResource($article),
            'Article created successfully.'
        );
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id): JsonResponse
    {
        $article = Article::find($id);

        if (is_null($article)) {
            return $this->sendError('Article not found.');
        }

        return $this->sendResponse(
            new ArticleResource($article),
            'Article retrieved successfully.'
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Article $article
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Article $article): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required',
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $article->title = $input['title'];
        $article->content = $input['content'];
        $article->category_id = $input['category_id'];
        $article->user_id = $input['user_id'];
        $article->save();

        return $this->sendResponse(
            new ArticleResource($article),
            'Article updated successfully.'
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Article $article
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Article $article): JsonResponse
    {
        $article->delete();

        return $this->sendResponse([], 'Article deleted successfully.');
    }
}
