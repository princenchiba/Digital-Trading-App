<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Filters;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Controllers\BaseController;
class CheckLogin implements FilterInterface {
    //put your code here
    public function before(RequestInterface $request, $arguments = null)
    {   

        if(!session()->has('isLogIn') || !session()->has('isAdmin')){

            return redirect()->route('admin');
        }
    }
     
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}