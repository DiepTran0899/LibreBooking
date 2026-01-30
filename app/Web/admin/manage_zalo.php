<?php

define('ROOT_DIR', '../../');
require_once(ROOT_DIR . 'Pages/Admin/ManageZaloPage.php');

$page = new AdminPageDecorator(new ManageZaloPage());
$page->PageLoad();

