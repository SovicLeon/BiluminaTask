<?php

class ad_controller
{
    public function index()
    {
        $ads = Ad::all();

        echo json_encode($ads);
    }
}