<?php

class ad_controller
{
    public function index($sort = null)
    {
        $ads = Ad::all($sort);

        echo json_encode($ads);
    }
}