<?php

namespace App\Http\Controllers\Api;

use App\Models\Blog;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;
use App\Repositories\BlogRepository;
use App\Http\Requests\Blog\BlogCreateRequest;
use App\Http\Requests\Blog\BlogUpdateRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BlogController extends Controller
{
    use ApiResponse;

    private $repository;

    public function __construct(BlogRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        try {
            $blogs = $this->repository->getAllBlogs();
        } catch (\Exception $e) {
            return $this->errorRes([], 'Oops some errors occured', 500);
        }
        return $this->collectionResponse('App\Http\Resources\BlogResource', $blogs, 'Blog List', 200);
    }

    public function store(BlogCreateRequest $request)
    {
        DB::beginTransaction();
        try {
            $blog = $this->repository->create($request->validated());
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return $this->errorRes([], 'Oops some errors occured', 500);
        }
        return $this->resourceResponse('App\Http\Resources\BlogResource', $blog, 'Blog Created Successfully', 201);
    }

    public function edit(int $id)
    {
        try {
            $blog = $this->repository->getById($id);
        } catch (ModelNotFoundException $e) {
            return $this->errorRes([], $e->getMessage(), 404);
        } catch (\Exception $e) {
            return $this->errorRes([], 'Oops some errors occured', 500);
        }
        return $this->resourceResponse('App\Http\Resources\BlogResource', $blog, 'Blog Edit Details', 200);
    }

    public function update(BlogUpdateRequest $request, int $id)
    {
        DB::beginTransaction();
        try {
            $blog = $this->repository->update($request->validated(), $id);
            DB::commit();
        } catch (ModelNotFoundException $e) {
            DB::rollback();
            return $this->errorRes([], $e->getMessage(), 404);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->errorRes([], 'Oops some errors occured', 500);
        }
        return $this->resourceResponse('App\Http\Resources\BlogResource', $blog->refresh(), 'Blog Edited Successfully', 200);
    }

    public function delete(int $id)
    {
        DB::beginTransaction();
        try {
            $this->repository->delete($id);
            DB::commit();
        } catch (ModelNotFoundException $e) {
            DB::rollback();
            return $this->errorRes([], $e->getMessage(), 404);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->errorRes([], 'Oops some errors occured', 500);
        }
        return $this->successRes([], 'Deleted Successfully', Response::HTTP_OK);
    }
}