<?php
require 'app/functions.php';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"/>
  <link rel="stylesheet" href="../../bower/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../bower/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" type="test/css" href="../../src/css/app.css">
  <?= generate_title($conf); ?>
</head>

<body>
    <!-- Navigation -->
    <?php make_menu($conf) ?>
    <div class="container">
      <div id="content" class="push-down"></div>
    </div>
    <?php
    render_markdown();
    formulate_footer($conf);
    ?>
</body>

<!-- JQuery -->
<script src="../../bower/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../../bower/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Prettify -->
<script src="../../src/js/prettify.min.js"></script>
<!-- Marked.js (https://github.com/chjj/marked) -->
<script src="../../node_modules/marked/marked.min.js"></script>
<!-- Strapdown (http://strapdownjs.com/) -->
<script src="../../src/js/strapdown.js"></script>

<script>
  // Markdown Usage
  markdownEl = document.getElementsByTagName('xmp').innerHTML;
  document.getElementById('content').innerHTML =
    marked(markdownEl);

  // Submenu toggles
  $(document).ready(function(){
    $('.dropdown-submenu a.test').on("click", function(e){
      $(this).next('ul').toggle();
      e.stopPropagation();
      e.preventDefault();
    });
  });
</script>

</html>
