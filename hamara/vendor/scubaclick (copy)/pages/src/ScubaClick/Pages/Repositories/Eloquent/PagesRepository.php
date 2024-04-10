<?php namespace ScubaClick\Pages\Repositories\Eloquent;

use App;
use Input;
use Config;
use ScubaClick\Pages\Models\Page;
use ScubaClick\Pages\Contracts\PagesInterface;

class PagesRepository implements PagesInterface
{
    /**
     * {@inheritdoc}
     */
	public function get($static = 1, $perPage = 12)
	{
        return Page::with('category','tags')
            ->where('static', (int) $static)
            ->paginate($perPage);
	}

    /**
     * {@inheritdoc}
     */
    public function index($perPage = 12, $feed = false)
    {
        $query = Page::with('category','tags')
            ->where('static', 0)
            ->where('status', 'published')
            ->orderBy('created_at', 'desc');

        if(!$feed) {
            return $query->paginate($perPage);
        } else {
            return $query->take($perPage)->get();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthor($username)
    {
        $userClass = Config::get('auth.model');

        return $userClass::where('username', $username)
            ->remember(5)
            ->first();
    }

    /**
     * {@inheritdoc}
     */
    public function authorPages($author, $perPage = 12, $feed = false)
    {
        $query = Page::with('category','tags')
            ->where('static', 0)
            ->where('user_id', $author->id)
            ->where('status', 'published')
            ->orderBy('created_at', 'desc');

        if(!$feed) {
            return $query->paginate($perPage);
        } else {
            return $query->take($perPage)->get();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getComments($post, $perPage = 20)
    {
        return $post->comments()
            ->where('approved', 1)
            ->where('spam', 0)
            ->orderBy('created_at', 'desc')
            ->take($perPage)
            ->get();
    }

    /**
     * {@inheritdoc}
     */
    public function getFront()
    {
        if(!$page = Page::front()) {
            App::abort(404);
        }

        return $page;
    }

    /**
     * {@inheritdoc}
     */
    public function getPage($slug, $category = null)
    {
        $page = Page::entry($slug);

        if(!$page || $category && !$page->hasCategory()) {
            App::abort(404);
        }

        return $page;
    }

    /**
     * {@inheritdoc}
     */
	public function search($search, $static = 1, $perPage = 12)
	{
        return Page::search($search)
            ->where('static', (int) $static)
            ->paginate($perPage);
	}

    /**
     * {@inheritdoc}
     */
	public function trashed($static = 1, $perPage = 12)
	{
        return Page::onlyTrashed()
            ->where('static', (int) $static)
            ->paginate($perPage);
    }

    /**
     * {@inheritdoc}
     */
	public function forceDelete($id)
	{
        $page = Page::withTrashed()
            ->where('id', $id)
            ->first();

        $page->forceDelete();

        return !$page->exists;
	}

    /**
     * {@inheritdoc}
     */
	public function restore($id)
	{
        $page = Page::withTrashed()
            ->where('id', $id)
            ->first();

        $page->restore();
        
        return $page->isSaved() ? true : $page->getErrors();
	}

    /**
     * {@inheritdoc}
     */
	public function emptyTrash($static = 1)
	{
        return Page::onlyTrashed()
            ->where('static', (int) $static)
            ->forceDelete();
	}

    /**
     * {@inheritdoc}
     */
	public function create($input, $tags = '')
	{
        $page = Page::create($input);

        if($page->isSaved() && $tags) {
            $page->attachTags($tags);
        }

        return $page;
	}

    /**
     * {@inheritdoc}
     */
	public function findOrFail($id)
	{
        return Page::findOrFail($id);
	}

    /**
     * {@inheritdoc}
     */
	public function update($id, $tags = '')
	{
        $input = Input::except('tags');

        $page = Page::find($id);
        $page->update($input);

        if($tags) {
            $page->attachTags($tags);
        }

        return $page;
	}

    /**
     * {@inheritdoc}
     */
	public function delete($id)
	{
        return Page::find($id)->delete();
	}

    /**
     * {@inheritdoc}
     */
    public function addComment($id)
    {
        $post = Page::find($id);

        if($post->static) {
            return false;
        }

        return $post->comments(false)->create(Input::except('_token'));
    }
}
