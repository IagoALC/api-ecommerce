<?php

namespace App\Traits;
use \App\Models\User;

trait AsUser{

    protected function user($guard = null):? User
    {
      return auth($guard)->user();
    }


    protected function userId($guard = null):? int
    {
      return auth($guard)->id();
    }


    protected function check($guard = null): bool
    {
       return auth($guard)->check();
    }


}
