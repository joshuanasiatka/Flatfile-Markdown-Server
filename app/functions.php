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

function buildMenu() {
  add_item("<topbar style='display:none;'>
    <item><a href='/'>Home</a></item>
    <item><a href='?page=about.md'>About</a></item>");
  //path to directory to scan
  $directory = "markdown/*";

  //get all files in specified directory
  $files = glob($directory . "*");

  //print each file name
  foreach($files as $file) {
    if(is_dir($file)) {
      $folder_name = basename($file);
      $folder_name = str_replace('_', ' ', $folder_name);
      add_item("<menu name='$folder_name'>");
      $subfiles = glob("$file/" . "*");
      foreach($subfiles as $subfile) {
        $file_name = basename($subfile, ".md");
        $file_name = str_replace('_', ' ', $file_name);
        $file_path = after('markdown/', $subfile);
        add_item("<item><a href='?page=/$file_path'>$file_name</a></item>");
      }
      add_item("</menu>");
    }
  }
  add_item("
    <toc>Page Nav</toc>
    <item><a target='_blank' href='https://github.com/joshuanasiatka/programmer-dictionary'>Contribute on GitHub</a></item>
  </topbar>");
  // echo  $menu;
}

function render_markdown() {
  add_item("<xmp theme='simplex' style='display:none;'>");
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
