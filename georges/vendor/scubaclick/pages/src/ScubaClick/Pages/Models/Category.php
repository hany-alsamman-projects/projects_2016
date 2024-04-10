<?php namespace ScubaClick\Pages\Models;

use Illuminate\Support\Str;

class Category extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * No timestamps for categories
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
        'parent',
    );

    /**
     * Holds all validation rules
     *
     * @var MessageBag
     */
	public static $rules = array(
        'title' => 'required|min:3',
        'slug'  => 'required|min:3|unique:categories,slug,{id}',
	);

   /**
     * Listen for save/delete event
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
            Page::where('category_id', $model->id)
                ->update(['category_id' => null]);
        });
    }

    /**
     * Connect the pages
     *
     * @return object
     */
    public function pages()
    {
        return $this->hasMany('\\ScubaClick\\Pages\\Models\\Page');
    }
}
