<?php namespace ScubaClick\Pages\Models;

use DB;
use Illuminate\Support\Str;

class Tag extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tags';

    /**
     * No timestamps for meta data
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Defining fillable attributes on the model
     *
     * @var array
     */
    protected $fillable = array(
        'title',
        'slug',
    );

    /**
     * Holds all validation rules
     *
     * @var MessageBag
     */
	public static $rules = array(
        'title' => 'required|min:3',
        'slug'  => 'required|min:3|unique:tags,slug,{id}',
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
            $model->slug = !empty($model->slug) ? Str::slug($model->slug) : Str::slug($model->title);

            return $model->validate();
        });

        static::deleted(function($model)
        {
            DB::table('page_tag')->where('tag_id', $model->id)->delete();
        });
    }

    /**
     * Connect the pages
     *
     * @return object
     */
    public function pages()
    {
        return $this->belongsToMany('\\ScubaClick\\Pages\\Models\\Page');
    }
}
