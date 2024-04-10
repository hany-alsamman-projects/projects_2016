<?php

class UserData extends Eloquent {

    protected $table = 'users_data';

    function user() {
        return $this->belongsTo('User', 'id');
    }

}
