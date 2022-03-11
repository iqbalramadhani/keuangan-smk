<?php

if (!function_exists('get_hash')) {

  function get_hash($PlainPassword)
  {

    $option = [
      'cost' => 5, // proses hash sebanyak: 2^5 = 32x
    ];
    return password_hash($PlainPassword, PASSWORD_DEFAULT, $option);
  }
}

if (!function_exists('hash_verified')) {

  function hash_verified($PlainPassword, $HashPassword)
  {

    return password_verify($PlainPassword, $HashPassword) ? true : false;
  }
}

if (!function_exists('get_url')) {

  function get_url($tipe, $segment = null)
  {
    if ($tipe == "current")
      return get_instance()->uri->uri_string();
    else if ($tipe == "class")
      return get_instance()->router->fetch_class();
    else if ($tipe == "segment")
      return get_instance()->uri->segment($segment);
  }
}
