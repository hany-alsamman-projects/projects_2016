<?php namespace ScubaClick\Pages\Repositories\Eloquent;

use App;
use Input;
use ScubaClick\Pages\Models\Tag;
use ScubaClick\Pages\Contracts\TagsInterface;

class TagsRepository implements TagsInterface
{
    /**
     * {@inheritdoc}
     */
    public function get($perPage = 20)
    {
		return Tag::paginate($perPage);
    }

    /**
     * {@inheritdoc}
     */
    public function findOrFail($slug)
    {
        $tag = Tag::where('slug', $slug)->remember(5)->first();

        if(!$tag) {
            App::abort(404);
        }

        return $tag;
    }

    /**
     * {@inheritdoc}
     */
    public function getPages($tag, $perPage = 12, $feed = false)
    {
        $query = $tag->pages()
            ->with('category','tags')
            ->where('status', 'published')
            ->where('static', 0)
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
	public function toJson()
	{
		return json_encode(Tag::lists('title'));
	}

    /**
     * {@inheritdoc}
     */
	public function create($input)
	{
        return Tag::create($input);
	}

    /**
     * {@inheritdoc}
     */
	public function update($id)
	{
        $tag = Tag::find($id);
        $tag->update(Input::except('_token'));

        return $tag;
	}

    /**
     * {@inheritdoc}
     */
	public function delete($id)
	{
        $tag = Tag::find($id);
        $tag->delete();

        return !$tag->exists;
	}
}
