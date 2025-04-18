<?php

/* Layout */

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
	    <meta charset="utf-8">
		<meta name="author" content="GIOdeBrito">
	    <meta name="description" content="Personal SQLite database editor">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <title><?php echo $title; ?> — SQLite Inspector</title>
		<script src="public/src/main.js" type="module"></script>
		<link rel="stylesheet" href="/public/style/master.css">
		<link rel="stylesheet" href="/public/style/components.css">
		<?php

		foreach($styles ?? [] as $style)
		{
			?>
			<link rel="stylesheet" href="/public/style/<?php echo $style ?>">
			<?php
		}

		?>
	</head>

	<body>
		<?php

		include "app/views/${view}.php";

		?>
	</body>
</html>