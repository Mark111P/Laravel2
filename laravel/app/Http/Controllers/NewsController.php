<?php

namespace App\Http\Controllers;

//use Egulias\EmailValidator\Parser\Comment;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\News;
use App\Models\Login;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $allNews = News::all();
        $selected_category = null;
        $sort_name = null;
        if ($request->sort == 'name' && strlen($request->name) > 0) {
            $sort_name = $request->name;
            $like = '%' . $sort_name . '%';
            $allNews = News::query()->where('summary', 'LIKE', $like)->get();
        }
        else if ($request->sort == 'category' && $request->category_id != 'all'){
            $selected_category = $request->get("category_id");
            $allNews = News::all()->where('category_id', '==', $selected_category == 'null' ? '' : $selected_category);
        }
        $categories = Category::all();
        return view('news.index', compact('allNews', 'categories', 'selected_category', 'sort_name'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $news = "empty";
        $categories = Category::all();
        return view('news.create', compact('news', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $news = new News();
        $news->summary = $request->get('summary');
        $news->short_description = $request->get('short_description');
        $news->full_text = $request->get('full_text');
        $news->image = $request->get('image');
        $news->category_id = $request->get('category_id');
        $news->save();
        return redirect()->route('news.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $news = News::where('id', $id)->first();
        $comments = Comment::where('news_id', $id)->get();
        return view('news.more', compact('news', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $news = News::where('id', $id)->first();
        $categories = Category::all();
        return view('news.create', compact('news', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $c_id = $request->get('category_id') == 'null' ? null : $request->get('category_id');
        News::where('id',$id)->update(['summary'=>$request->get('summary'), "short_description"=>$request->get('short_description'),
            "full_text"=>$request->get('full_text'), "image"=>$request->get('image'), "category_id"=>$c_id]);
        return redirect()->route('news.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function logout()
    {
        setcookie('email', '', time() - 3600, "/");
        return redirect()->route('login.index');
    }

    public function comment(Request $request)
    {
        $email = $_COOKIE['email'];
        if (strlen($email) > 0) {
            $comment = new Comment();
            $comment->news_id = $request->get('news_id');
            $comment->user_id = Login::where('email', $email)->value('id');
            $comment->comment = $request->get('comment');
            $comment->save();
        }

        return redirect()->route('news.show', [$request->news_id]);
    }

    public function category()
    {
        return view('news.category');
    }
    public function add_category(Request $request)
    {
        if (count(Category::all()->where('name', $request->name)) == 0) {
            $category = new Category();
            $category->name = $request->get('name');
            $category->save();
        }
        return redirect()->route('news.index');
    }
}
