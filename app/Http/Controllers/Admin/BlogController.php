<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Traits\Numbers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Str;
use Verta;

class BlogController extends Controller
{
    use Numbers;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::where('is_page',1)->orderBy('id', 'desc')->get();
        return view('admin.blog.list', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'slug' => 'required|unique:blogs',
            'description' => 'required',
            'img_cover' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'excerpt' => 'string|min:3|max:255',
        ]);

        if (isset($request->published_at)) {

            $published_at = $this->convertNumbers($request->published_at);
            $published_at = explode('/', $published_at);
            $published_at = Verta::getGregorian($published_at[0], $published_at[1], $published_at[2]);

            $published_at = $published_at[0] . "-" . $published_at[1] . "-" . $published_at[2];
            if (isset($request->publish_time)) {
                if (strlen($request->publish_time) == 5) {
                    $published_at .= " " . $request->publish_time . ":00";
                } else {
                    $published_at .= " " . $request->publish_time;
                }

            }
            $published_at = Carbon::createFromFormat('Y-m-d H:i:s', $published_at)->toDateTimeString();
        } else {

            $published_at = Carbon::now()->toDateTimeString();
        }

        if (request()->hasFile('img_cover')) {
            $img_cover = time() . '.' . request()->img_cover->getClientOriginalExtension();
            request()->img_cover->move(public_path('images/upload/blog/'), $img_cover);
        } else
            $img_cover = null;
        $blog = Blog::create([
            'title' => $request->title,
            'slug' => !empty($request->slug) ? preg_replace('/\s+/', '-', $request->slug) : Str::slug($request->title, '-'),
            'img_cover' => $img_cover,
            'description' => $request->description,
            'excerpt' => $request->excerpt ?? Str::limit($request->description->value, 50),
            'published_at' => $published_at,
            'is_page' => 1,
        ]);
        if (!empty($request->tags) && $blog) {
            $blog->attachTags( explode( ',', $request->tags ) );

        }
        return redirect(route('admin.blog.index'))->with(['store' => 'success']);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Blog $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        if (!empty($blog->published_at)) {
            $time = explode(' ', $blog->published_at);
            $time = $time[1];
            $date = $this->convertToJalaliDateAndTime($blog->published_at);
        } else {
            $time = '';
            $date = '';
        }



        return view('admin.blog.edit', compact('blog', 'date', 'time'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Blog $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        $this->validate($request, [
            'title' => 'required',
            'slug' => 'required|unique:blogs,slug,' . $blog->id,
            'description' => 'required',
            'img_cover' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'excerpt' => 'string|min:3|max:255',
        ]);

        if ($request->hasFile('img_cover')) {
            if ($blog->img_cover != null) {
                $blogImage = public_path("images/upload/blog/{$blog->img_cover}"); // get previous image from folder
                if (File::exists($blogImage)) { // unlink or remove previous image from folder
                    unlink($blogImage);
                }
            }
            $img_cover = time() . '.' . request()->img_cover->getClientOriginalExtension();
            request()->img_cover->move(public_path('images/upload/blog/'), $img_cover);
        } else
            $img_cover = null;


        if (isset($request->published_at)) {

            $published_at = $this->convertNumbers($request->published_at);
            $published_at = explode('/', $published_at);
            $published_at = Verta::getGregorian($published_at[0], $published_at[1], $published_at[2]);
            $published_at = $published_at[0] . "-" . $published_at[1] . "-" . $published_at[2];
            if (isset($request->publish_time)) {
                if (strlen($request->publish_time) == 5) {
                    $published_at .= " " . $request->publish_time . ":00";
                } else {
                    $published_at .= " " . $request->publish_time;
                }
            }
            $published_at = Carbon::createFromFormat('Y-m-d H:i:s', $published_at)->toDateTimeString();

        }

        $blog->update([
            'title' => $request->title,
            'slug' => !empty($request->slug) ? preg_replace('/\s+/', '-', $request->slug) : Str::slug($request->title, '-'),
            'img_cover' => $img_cover != null ? $img_cover : $blog->img_cover,
            'description' => $request->description,
            'excerpt' => $request->excerpt ?? Str::limit($request->description->value, 50),
            'published_at' => $published_at,
        ]);
        if (!empty($request->tags))
        $blog->syncTags( explode( ',', $request->tags ) );
        return redirect(route('admin.blog.index'))->with(['store' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Blog $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $tags = $blog->tags()->get();
        if (!empty($tags))
        $blog->detachTags($tags);
        $blog->delete();
        return redirect()->back()->with('delete','success');
    }



}
