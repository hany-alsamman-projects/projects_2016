<?php namespace ScubaClick\Pages\Models;

use DB;
use URL;
use Auth;
use Config;
use Purifier;
use Illuminate\Support\Str;
use ScubaClick\Feeder\Contracts\FeedInterface;

class Page extends Model implements FeedInterface
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pages';

    /**
     * Enables model trashing/restoring
     *
     * @var bool
     */
    protected $softDelete = true;

    /**
     * Defining fillable attributes on the model
     *
     * @var array
     */
    protected $fillable = array(
        'user_id',
    	'status',
        'slug',
    	'title',
    	'content',
        'seo_title',
        'description',
        'category_id',
        'static',
        'front',
        'lang_id'
    );

    /**
     * Holds all validation rules
     *
     * @var MessageBag
     */
	public static $rules = array(
        'user_id'     => 'required|exists:users,id',
        'status'      => 'required|in:published,draft',
        'title'       => 'required|min:3',
        'content'     => 'required|min:8',
        'seo_title'   => 'max:70',
        'description' => 'max:156',
        'slug'        => 'required|min:3|unique:pages,slug,{id}',
        //'category_id' => 'exists:categories,id',
        'lang_id'     => 'exists:languages,id',
        'static'      => 'between:0,1',
        'front'       => 'between:0,1',
	);

   /**
     * Listen for save event
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function($model)
        {
            $model->user_id     = empty($model->user_id) ? Cartalyst\Sentry\Sentry::getUser()->id : $model->user_id;
            $model->description = strip_tags($model->description);
            //http://stackoverflow.com/questions/19173055/htmlpurifier-doesnt-work-properly-with-laravel-4
            //$model->content     = Purifier::clean($model->content);
            $model->content     = $model->content;
            $model->front       = !isset($model->front) ? 0 : $model->front;

            $oldTitle = $model->getOriginal('title');
            $newTitle = $model->getAttribute('title');

            if($newTitle != $oldTitle) {
                $model->setAttribute('slug', $model->getUniqueSlug($newTitle));
            }

            return $model->validate();
        });

        static::saved(function($model)
        {
            /**
            if($model->front == 1) {
                Page::where('front', 1)
                    ->where('id', '!=', $model->id)
                    ->update([
                        'front' => 0,
                    ]);
            }
            */
        });
    }

    /**
     * Get the front page
     *
     * @return int
     */
    public static function front()
    {
        return static::with('category','tags')
            ->where('front', 1)
            ->where('static', 1)
            ->where('status', 'published')
            ->first();
    }

    /**
     * Get a page
     *
     * @param string $slug
     * @return int
     */
    public static function entry($slug)
    {
        return static::with('category','tags', 'comments')
            ->where('slug', $slug)
            ->where('status', 'published')
            ->first();
    }

    /**
     * Get the search query
     *
     * @param object $query
     * @param string $serch
     * @return int
     */
    public function scopeSearch($query, $search)
    {
        $search = urldecode($search);

        return $query->with('category','tags')
            ->where('title', 'like', "%$search%")
            ->orWhere('description', 'like', "%$search%");
    }

    /**
     * Get the seo title
     *
     * @return string
     */
    public function getSeoTitle()
    {
        return empty($this->seo_title) ? Str::limit(strip_tags($this->title), 70) : $this->seo_title;
    }

    /**
     * Get the seo description
     *
     * @return string
     */
    public function getSeoDescription()
    {
        return empty($this->description) ? Str::limit(strip_tags($this->content), 157) : $this->description;
    }

    /**
     * Connect the categories
     *
     * @return object
     */
    public function category()
    {
        return $this->belongsTo('\\ScubaClick\\Pages\\Models\\Category');
    }

    /**
     * Connect the tags
     *
     * @return object
     */
    public function tags()
    {
        return $this->belongsToMany('\\ScubaClick\\Pages\\Models\\Tag');
    }

    /**
     * Connect the comments
     *
     * @return object
     */
    public function comments($filter = true)
    {
        $query = $this->hasMany('\\ScubaClick\\Pages\\Models\\Comment');

        if($filter === true) {
            $query->where('approved', 1)
                ->where('spam', 0);
        }

        return $query;
    }

    /**
     * Connect the creator
     *
     * @return object
     */
    public function user()
    {
        return $this->belongsTo(Config::get('auth.model'));
    }

    /**
     * Check if the page can be viewed
     *
     * @return boolean
     */
    public function isViewable()
    {
        return $this->status == 'published';
    }

    /**
     * Check if the page has comments
     *
     * @return boolean
     */
    public function hasComments()
    {
        return $this->comments->count() > 0;
    }
    /**
     * Check if the page has a category
     *
     * @return boolean
     */
    public function hasCategory()
    {
        return !empty($this->category);
    }

    /**
     * Check if the page has tags
     *
     * @return boolean
     */
    public function hasTags()
    {
        return !empty($this->tags);
    }

    /**
     * Get the link to the page
     *
     * @return string
     */
    public function getLink()
    {
        if($this->front) {
            return URL::to('/');
        }

        $category = $this->category;

        $cat = '';
        if(!empty($category)) {
            $cat = $category->slug .'/';
        }

        return URL::to($this->getPrefix() . $cat . $this->slug);
    }

    /**
     * Get the page/post prefix
     *
     * @return string
     */
    protected function getPrefix()
    {
        $type   = $this->static ? 'page' : 'post';
        $prefix = Config::get('pages::prefix.'. $type);

        if(is_callable($prefix)) {
            $prefix = $prefix();
        }

        return ! empty($prefix) ? '/' . trim($prefix, '/') .'/' : '';
    }

    /**
     * Get the link to the page
     *
     * @return string
     */
    public function getCategory()
    {
        if(empty($this->category)) {
            return null;
        }

        return $this->category->title;
    }

    /**
     * Save any tags
     *
     * @param mixed $tags
     * @return void
     */
    public function attachTags($tags)
    {
        if($this->static) {
            return false;
        }

        if(!is_array($tags)) {
            $tags = explode(',', $tags);
        }

        $tags = array_filter(array_map('trim', $tags));

        // remove all exiting tags if any
        if(count($tags) <= 0) {
            $this->tags()->sync([]);
            return;
        }

        $tagIds = array();
        foreach($tags as $title) {
            $tag = Tag::where('title', $title)->first();

            if(!$tag) {
                $tag = Tag::create([
                    'title' => $title,
                    'slug'  => Str::slug($title)
                ]);

                if(!$tag->isSaved()) {
                    continue;
                }
            }

            $tagIds[] = $tag->id;
        }

        // sync all existing tags
        if(count($tagIds) > 0) {
            $this->tags()->sync($tagIds);
        }
    }

    /**
     * Create a unique slug
     *
     * @param string $title
     * @return void
     */
    public function getUniqueSlug($title)
    {
        $slug  = Str::slug($title);
        $table = $this->getTable();

        $row = DB::table($table)->where('slug', $slug)->first();

        if ($row) {
            $num = 2;
            while ($row) {
                $newSlug = $slug .'-'. $num;

                $row = DB::table($table)->where('slug', $newSlug)->first();
                $num++;
            }

            $slug = $newSlug;
        }

        return $slug;
    }

    /**
     * Get a Twitter Bootstrap compatible status
     *
     * @return void
     */
    public function getFormattedStatus()
    {
        $type = $this->status == 'published' ? 'success' : 'warning';

        return '<span class="label label-'. $type .'">'. ucfirst($this->status) .'</label>';
    }

    /**
     * Get an extract from the content
     *
     * We'll then use HTML Purifier to close all open tags
     *
     * @return string
     */
    public function getExtract($words = 200)
    {
        return Purifier::clean(Str::words($this->content, $words));
    }

    /**
     * {@inherit}
     */
    public function getFeedItem()
    {
        if($this->static) {
            return false;
        }

        return array(
            'title'       => $this->title,
            'author'      => $this->user->full_name,
            'link'        => $this->getLink(),
            'pubDate'     => $this->created_at,
            'description' => $this->content,
        );
    }
}
