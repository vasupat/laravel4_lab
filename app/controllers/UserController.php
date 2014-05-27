<?php

class UserController extends BaseController {

    public function getIndex()
    {
        return 'getIndex';
    }

    public function postProfile($userId)
    {
        return 'postProfile : '. $userId;
    }

    public function getContent()
    {
    	return '<div>Tum</div><div>Enjoy</div><div>Vasupat</div><div>Chantakeaw</div><div>Vasupat</div>';
    }

    public function getList()
    {
        //$posts = $post->all();
        $name = 'data defaule';
        return $name;
    }

}
