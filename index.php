<?php
if (!file_exists("/opt/md2html_jn/cache/config.ini")) {
  echo "<p>Please run the setup. No config found.</p>";
} else {
  require_once 'app/app.php';
}
