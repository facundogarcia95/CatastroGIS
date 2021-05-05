<?php


$proxy_url = env('PROXY_URL');
//dd($_SERVER['HTTP_HOST']);
if(!empty($proxy_url)) {
  URL::forceRootUrl($proxy_url);
}
