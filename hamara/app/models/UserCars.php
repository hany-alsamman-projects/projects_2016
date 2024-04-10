<?php

class UserCars extends Eloquent {

    protected $table = 'users_cars';

    function user() {
        return $this->belongsTo('User', 'id');
    }

}
