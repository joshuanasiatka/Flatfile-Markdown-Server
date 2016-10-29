<?php
if (file_exists("/opt/md2html_jn/cache/config.ini")) {
  $conf = parse_ini_file("/opt/md2html_jn/cache/config.ini");
} else {
  $conf = parse_ini_file("config.sample.ini");
}

function add_item($item) {
  echo $item;
}

function after($this, $inthat) {
  if (!is_bool(strpos($inthat, $this)))
  return substr($inthat, strpos($inthat,$this)+strlen($this));
}

function generate_title($conf) {
  echo "<title>" . $conf['app_name'] . "</title>";
}

function make_menu($conf) {
  add_item("
  <nav class='navbar navbar-" . $conf['theme_mode'] . " navbar-static-top' role='navigation'>
      <div class='container'>
          <div class='navbar-header'>
          <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='#navigation'>
            <span class='icon-bar'></span>
            <span class='icon-bar'></span>
            <span class='icon-bar'></span>
          </button>
          <a class='navbar-brand' href='?'>" . $conf['app_name'] . "</a>
      </div>
  ");
  add_item("
  <div class='collapse navbar-collapse' id='#navigation'>
      <ul class='nav navbar-nav'>
          <li><a href='?'>Home</a></li>
          <li><a href='?page=about.md'>About</a></li>");
  //path to directory to scan
  $directory = "markdown/*";

  //get all files in specified directory
  $files = glob($directory . "*");

  //print each file name
  foreach($files as $file) {
    if(is_dir($file)) {
      $folder_name = basename($file);
      $folder_name = str_replace('_', ' ', $folder_name);
      add_item("
      <li class='dropdown'>
          <a class='dropdown-toggle' data-toggle='dropdown' href='#'>$folder_name
          <span class='caret'></span></a>
          <ul class='dropdown-menu'>
      ");
      $subfiles = glob("$file/" . "*");
      foreach($subfiles as $subfile) {
        nav_header($subfile);
        // sub_tree($subfile);
        // $file_name = basename($subfile, ".md");
        // $file_name = str_replace('_', ' ', $file_name);
        // $file_path = after('markdown/', $subfile);
        // add_item("\t\t<li><a href='?page=/$file_path'>$file_name</a></li>\r\n");
      }
      add_item("\t</ul>\r\n</li>");
    }
  }
  add_item("
      </ul>
      <ul class='nav navbar-nav navbar-right'>
        <li class='contribute'><a target='_blank' href='https://github.com/joshuanasiatka/programmer-dictionary'><i class='fa fa-github'></i> Contribute on GitHub</a></li>
      </ul>
  </div>
  <!-- /.navbar-collapse -->
  </div>
  <!-- /.container -->
  </nav>
  ");
}

function nav_header($file) {
  if(is_dir($file)) {
    $folder_name = basename($file);
    $folder_name = str_replace('_', ' ', $folder_name);
    add_item("
      <li class='divider'></li>
      <li class='nav-header'>" . $folder_name . "</li>"
    );
    $subfiles = glob("$file/" . "*");
    foreach($subfiles as $subfile) {
      nav_header($subfile);
    }
  } else {
    $file_name = basename($file, ".md");
    $file_name = str_replace('_', ' ', $file_name);
    $file_path = after('markdown/', $file);
    add_item("\t\t<li><a href='?page=/$file_path'>$file_name</a></li>\r\n");
  }
}

function sub_tree($file) {
  if(is_dir($file)) {
    $folder_name = basename($file);
    $folder_name = str_replace('_', ' ', $folder_name);
    add_item("
    <li class='dropdown-submenu'>
        <a class='dropdown-toggle' href='#'>$folder_name
        <span class='caret'></span></a>
        <ul class='dropdown'>
    ");
    $subfiles = glob("$file/" . "*");
    foreach($subfiles as $subfile) {
      sub_tree($subfile);
    }
    add_item("\t</ul>\r\n</li>");
  } else {
    $file_name = basename($file, ".md");
    $file_name = str_replace('_', ' ', $file_name);
    $file_path = after('markdown/', $file);
    add_item("\t\t<li><a href='?page=/$file_path'>$file_name</a></li>\r\n");
  }
}

function render_markdown() {
  add_item("<xmp style='display:none;'>");
  $page = $_GET['page'];
  if (!isset($_GET['page']) || !file_exists("markdown/$page")) {
    include 'markdown/home.md';
  } else if ($page == "") {
    header("Location: /index.php");
  } else {
    include_once "markdown/$page";
  }
  add_item("</xmp>");
}

function formulate_footer($conf) {
  add_item("
  <footer>
    <div class='container'>
      <hr>
      <p class='muted pull-left'>&copy; ".$conf['copyright_yr']." ".$conf['company_name'].". All rights reserved</p>
      <p class='muted pull-right'>powered by <a href='http://strapdownjs.com/'>Strapdown.js</a></p>
    </div>
  </footer>");
}
