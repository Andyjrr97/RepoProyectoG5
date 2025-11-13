<?php
namespace Ext\Core;

final class Request {
  public array $get;
  public array $post;
  public function __construct(){ $this->get=$_GET; $this->post=$_POST; }
  public function q($k,$def=null){ return $this->get[$k] ?? $def; }
  public function f($k,$def=null){ return $this->post[$k] ?? $def; }
}
