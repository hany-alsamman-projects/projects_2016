<?php

class UserPets extends Eloquent {

    protected $table = 'users_pets';

    function user() {
        return $this->belongsTo('User', 'id');
    }

}
