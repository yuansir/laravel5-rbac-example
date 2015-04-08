<?php namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;


class BaseController extends Controller {
    const PER_PAGE_NUM = 20;
    public function __construct()
    {
        $this->middleware('auth.admin');
    }
}