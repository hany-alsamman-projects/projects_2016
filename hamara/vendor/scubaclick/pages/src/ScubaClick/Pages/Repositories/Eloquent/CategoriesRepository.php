<?php namespace ScubaClick\Pages\Repositories\Eloquent;

use App;
use Input;
use ScubaClick\Pages\Models\Page;
use ScubaClick\Pages\Models\Category;
use ScubaClick\Pages\Contracts\CategoriesInterface;

class CategoriesRepository implements CategoriesInterface
{
    /**
     * {@inheritdoc}
     */
	public function all()
	{
		return Category::all();
	}

    /**
     * {@inheritdoc}
     */
    public function findOrFail($slug)
    {
        $category = Category::where('slug', $slug)
            ->remember(5)
            ->first();

        if(!$category) {
            App::abort(404);
        }

        return $category;
    }

    /**
     * {@inheritdoc}
     */
    public function getPages($category, $perPage = 12, $feed = false)
    {
        $query = Page::with('category','tags')
            ->where('category_id', $category->id)
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
	public function create($input)
	{
        return Category::create($input);
	}

    /**
     * {@inheritdoc}
     */
	public function update($id)
	{
        $category = Category::find($id);
        $category->update(Input::except('_token'));

        return $category;
	}

    /**
     * {@inheritdoc}
     */
	public function delete($id)
	{
        $category = Category::find($id);
        $category->delete();

        return !$category->exists;
	}
}
