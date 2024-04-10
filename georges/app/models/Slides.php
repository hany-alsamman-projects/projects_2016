<?php

class Slides extends Eloquent {


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sliders';

    protected $fillable = array('title', 'description', 'position', 'img_id');

}