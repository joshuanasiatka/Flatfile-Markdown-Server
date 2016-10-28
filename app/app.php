<?php
require 'app/functions.php';
?>
<!DOCTYPE html>
<html>

<?php
generate_title($conf);
buildMenu();
render_markdown();
?>

<!-- Strapdown (http://strapdownjs.com/) -->
<script src="../../src/js/strapdown.js"></script>
<!-- Strapdown Topbar (https://github.com/joedf/strapdown-topbar) -->
<script src="../../src/js/strapdown-topbar.js"></script>
</html>
