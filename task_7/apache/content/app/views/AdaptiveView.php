<?php

?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Леруру Мерлеле</title>
    <link href="<?php echo $data["themeStyleSheet"]; ?>" rel="stylesheet" id="theme-link">
</head>
<?php if ($data["lang"] == "ru"):
    include "adaptiveView/AdaptiveViewRu.php"
    ?>
<?php else:
    include "adaptiveView/AdaptiveViewEn.php"
    ?>
<?php endif ?>
<script src="resources/js/cookies.js"></script>
</html>
