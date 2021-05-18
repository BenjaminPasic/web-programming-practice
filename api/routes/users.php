<?php

//Get user by id
Flight::route('GET /user/@id', function($id){
    Flight::json(Flight::usersService()->get_user_by_id($id));
});
