<?php

use App\Models\User;
use App\Models\Role;

function getRole($id = 0){
  if($id == 0){
    $social_media = Role::whereNotIn('id', [1])->get();
  }else{
    $social_media = Role::whereNotIn('id', [1])->where('id',$id)->first();
  }  
  return $social_media;
}

?>