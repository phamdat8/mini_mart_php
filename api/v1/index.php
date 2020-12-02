<?php
  $route = $_SERVER["REQUEST_URI"];
  $route = substr($route, 8);
  $url_components = parse_url($route);
  parse_str($url_components['query'], $params);
  $route = $url_components['path'];


  $method = $_SERVER['REQUEST_METHOD'];
  switch ($route) {
    case 'check_exist_user':
      switch ($method){
        case 'GET':
          $controllerName = 'userController';
          $action = 'check_exist_user';
          break;
        default:
          // code...
          break;
      }
      break;
    default:
      // code...
      break;
  }
  require "src/controller/".$controllerName.".php";
  $p = new $controllerName;
  $p -> $action($params);
?>