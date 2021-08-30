<?php

namespace App\Http\Controllers\Blog\Admin;


//use App\Http\Requests\BlogCategoryCreateRequest;
use App\Http\Requests\BlogPostCreateRequest;
use App\Http\Requests\BlogPostUpdateRequest;

use App\Models\BlogPost;
use App\Repositories\BlogPostRepository;
use App\Repositories\BlogCategoryRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends BaseController
{

    /**
     * @var BlogPostRepository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    private $blogPostRepository;

    /**
     * @var BlogCategoryRepository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    private $blogCategoryRepository;

    public function __construct()
    {
        parent::__construct();

        $this->blogPostRepository = app( BlogPostRepository::class);
        $this->blogCategoryRepository = app( BlogCategoryRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginator = $this->blogPostRepository->getAllWithPaginate();
        return view('blog.admin.posts.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = new BlogPost();
        //$categoryList = BlogCategory::all();
        $categoryList = $this->blogCategoryRepository->getForComboBox();

        //dd($categoryList);

        return view('blog.admin.posts.edit', compact('item', 'categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogPostCreateRequest $request)
    {
        $data = $request->input();
        $item = (new BlogPost())->create($data);

        if($item->exists) {
            return redirect()
                ->route('blog.admin.posts.edit', $item->id)
                ->with(['success' => 'Успешно сохранено']);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения"])
                ->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = $this->blogPostRepository->getEdit($id);
        if(empty($item)){
            abort(404);
        }
        $categoryList = $this->blogCategoryRepository->getForComboBox();


        return view('blog.admin.posts.edit', compact( 'item', 'categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogPostUpdateRequest $request, $id)
    {
        $item = $this->blogPostRepository->getEdit($id);

        if(empty($item)){
            return back()
                ->withErrors(['msg' => "Запись id=[{$id}] не найдена"])
                ->withInput();
        }

        $data = $request->all();
        $result = $item->update($data);

        if($result) {
            return redirect()
                ->route('blog.admin.posts.edit', $item->id)
                ->with(['success' => 'Успешно сохранено']);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка сохранения"])
                ->withInput();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //dd(__METHOD__, $id);

        $result = BlogPost::destroy($id);

        //полное удаление из бд
        //$result = BlogPost::find($id)->forceDelete();

        if($result) {
            return redirect()
                ->route('blog.admin.posts.index')
                ->with(['success' => "Запись id[$id] удалена", 'id' => $id]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка удаления"]);
        }


    }

    public function restore($id)
    {
        $result = BlogPost::withTrashed()
            ->where('id', $id)
            ->restore();

        if($result) {
            return redirect()
                ->route('blog.admin.posts.edit', $id)
                ->with(['success' => "Запись id[$id] восстановлена", 'id' => $id, 'restore' => true]);
        } else {
            return back()
                ->withErrors(['msg' => "Ошибка удаления"]);
        }

        //dd(__METHOD__);
    }
}
