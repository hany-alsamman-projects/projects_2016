<?php namespace ScubaClick\Pages\Models;

use Auth;
use Config;
use Request;
use Purifier;
use Illuminate\Support\Str;
use ScubaClick\Feeder\Contracts\FeedInterface;

class Comment extends Model implements FeedInterface
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'comments';

    /**
     * Automatically update the parent page
     *
     * @var array
     */
    protected $touches = array('page');

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
    	'content',
        'name',
        'email',
        'website',
    );

    /**
     * Holds all validation rules
     *
     * @var MessageBag
     */
	public static $rules = array(
        'user_id'  => 'exists:users,id',
        'content'  => 'required|min:8',
        'name'     => 'required',
        'email'    => 'required|email',
        'website'  => 'url',
        'ip'       => 'required|ip',
        'approved' => 'between:0,1',
        'spam'     => 'between:0,1',
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
            if(Auth::check()) {
                $user = Auth::user();

                $model->user_id  = empty($model->user_id) ? $user->id            : $model->user_id;
                $model->name     = empty($model->name   ) ? $user->full_name : $model->name;
                $model->email    = empty($model->email  ) ? $user->email         : $model->email;
                $model->website  = empty($model->website) ? $user->website       : $model->website;
                $model->approved = 1;
            }

            if(!empty($model->website) && !Str::startsWith($model->website, ['http://', 'https://'])) {
                $model->website = 'http://'. $model->website;
            }

            $model->ip      = empty($model->ip) ? Request::getClientIp() : $model->ip;
            $model->content = Purifier::clean($model->content);

            return $model->validate();
        });
    }

    /**
     * Connect the page
     *
     * @return object
     */
    public function page()
    {
        return $this->belongsTo('\\ScubaClick\\Pages\\Models\\Page');
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
     * Get the gravatar url
     *
     * @return string
     */
    public function getAvatarUrl($size = 64)
    {
        $url  = 'https://secure.gravatar.com/avatar/';
        $url .= md5(strtolower(trim($this->email)));
        $url .= "?d=mm&s=". $size;

        return $url;
    }

    /**
     * Get the comment clases
     *
     * @return string
     */
    public function getClasses()
    {
        static $count = 1;

        $classes = array('media', 'comment');

        if($count % 2 == 0) {
            $classes[] = 'even';
        } else {
            $classes[] = 'odd';
        }

        if($this->user_id == $this->page->user->id) {
            $classes[] = 'author';
        }

        $count++;

        return implode(' ', $classes);
    }

    /**
     * {@inherit}
     */
    public function getFeedItem()
    {
        return array(
            'title'       => sprintf('Comment by %s', $this->name),
            'author'      => $this->name,
            'link'        => $this->page->getLink() .'#comment-'. $this->id,
            'pubDate'     => $this->created_at,
            'description' => $this->content,
        );
    }
}
