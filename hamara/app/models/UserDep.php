<?php

class UserDep extends Eloquent {

    protected $table = 'users_dependents';

    function user() {
        return $this->belongsTo('User', 'id');
    }

}
