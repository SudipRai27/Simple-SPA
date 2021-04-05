<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Repositories\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Category\CategoryStoreRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Services\PermissionService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryController extends Controller
{
    private $repository;

    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        if (!request()->user()->can('category_management_access')) {
            return response()->json(['data' => [], 'message' => 'Insufficient Permission'], Response::HTTP_FORBIDDEN);
        }
        $category = $this->repository->getAllCategory();
        return CategoryResource::collection($category)
            ->additional(['message' => 'Category Details'])
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }


    public function store(CategoryStoreRequest $request)
    {
        try {
            $category = $this->repository->create($request->validated());
        } catch (\Exception $e) {
            return response(['data' => [], 'message' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return (new CategoryResource($category))
            ->additional(['message' => 'Created Successfully'])
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function edit($id)
    {
        if (!request()->user()->can('category_edit')) {
            return response()->json(['data' => [], 'message' => 'Insufficient Permission'], Response::HTTP_FORBIDDEN);
        }
        try {
            $category = $this->repository->getCategoryById($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['data' => [], 'message' => $e->getMessage()], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['data' => [], 'message' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return response()->json(['data' => $category, 'message' => 'Category Details'], Response::HTTP_OK);
    }


    public function update(CategoryUpdateRequest $request, $id)
    {
        if (!request()->user()->can('category_edit')) {
            return response()->json(['data' => [], 'message' => 'Insufficient Permission'], Response::HTTP_FORBIDDEN);
        }
        try {
            $category = $this->repository->update($request->validated(), $id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['data' => [], 'message' => $e->getMessage()], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['data' => [], 'message' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return (new CategoryResource($category))
            ->additional(['message' => 'Updated Successfully'])
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    public function destroy($id)
    {
        if (!request()->user()->can('category_delete')) {
            return response()->json(['data' => [], 'message' => 'Insufficient Permission'], Response::HTTP_FORBIDDEN);
        }
        try {
            $category = $this->repository->getCategoryById($id);
            $category->delete();
        } catch (ModelNotFoundException $e) {
            return response()->json(['data' => [], 'message' => $e->getMessage()], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['data' => [], 'message' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return response()->json(['data' => [], 'message' => 'Category Deleted Successfully'], Response::HTTP_OK);
    }
}