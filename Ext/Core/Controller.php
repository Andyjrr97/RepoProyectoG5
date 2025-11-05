<?php
namespace Ext\Core;

abstract class Controller {
  protected Request $req;
  public function __construct(Request $r){ $this->req = $r; }
  protected function render(string $view, array $data=[]): void {
    View::render($view,$data);
  }
}
