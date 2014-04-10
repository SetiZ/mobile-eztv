<!doctype html>
<html>
<head>
	<meta name="viewport" content="width=device-width, user-scalable=no">
	<meta charset="utf-8">
	<title>daddy likes series</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	<!-- Optional theme -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
	<style type="text/css">
	body {
		margin-left: 10px;
	}
	</style>
</head>
<body>
	<h1>daddy likes series</h1>
	<?php
	$dom = new domDocument();
	$html = "http://www.eztv.it/";
	@$dom->loadHTMLFile($html);
	$dom -> encoding = "utf-8";
	$select = $dom->getElementsByTagName('select');
	$options = $select->item(0)->getElementsByTagName('option');
	?>
	<form action="" method="post" name="search" id="search">
		<select name="SearchString" onchange="this.form.submit()" style="width: 90%;">
			<?php
			$array_options= array();

			foreach($options as $option) {
				echo "<option value='";
				echo $option->getAttribute('value');
				echo "'>";
				echo $option->nodeValue;
				echo '</option>';
				$array_options[$option->getAttribute('value')] = $option->nodeValue;
			}
			?>
		</select>
	</form>

	<?php 
	echo "<h2>" . $array_options[$_POST['SearchString']] . "</h2>"; 
	?>
	<div id="retour">
		<?php
		if (isset($_POST['SearchString'])) {
			$dom2 = new domDocument();
			$html2 = "http://www.eztv.it/shows/" . $_POST['SearchString'] . "/";
			@$dom2->loadHTMLFile($html2);
			$dom2 -> encoding = "utf-8";

			$tables = $dom2->getElementsByTagName('table');

			$table = $tables->item(6);
			$rows = $table->getElementsByTagName('tr');
			$i = 0;

			foreach ($rows as $row) {
				$tds = $row->getElementsByTagName('td');
				$i++;
				if ($i>2) {
					$name = $tds->item(1)->nodeValue;
					$urls = $tds->item(2)->getElementsByTagName('a');
					$magnet = $urls->item(0);
					echo "<a href='" . $magnet->getAttribute('href') ."'>";
					echo $name;
					echo "</a>";
					echo "<br><br>";
				}
			}
		}
		?>
	</div>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</body>
</html>
