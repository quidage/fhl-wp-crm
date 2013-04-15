<?php

require_once 'lib/loader.php';
actionLoader();

?>			
<!DOCTYPE html>
<html>
	
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" href="css/screen.css" />
		<script src="js/main.js"></script>
        <title>Übersicht</title>
    </head>

    <body>
		<div id="wrapper">
			<div class="outer">
				<div class="inner">		
					
					<div id="ergebnis" class="test noch mehr klassen"></div>

					<table id="tabelle">
						<thead>
							<tr>
								<th>ID</th>
								<th>Name</th>
								<th>Adresse</th>
								<th></th>
							</tr>				
						</thead>
						<tbody>					
							<?php foreach ($customers as $customer): ?>
								<tr>
									<td><?php echo $customer['id']; ?></td>
									<td><?php echo $customer['name']; ?></td>
									<td><?php echo $customer['street'] . "<br>" . $customer['zip'] . " " . $customer['city']; ?></td>
									<td><a href="index.php?controller=customer&action=edit&customer=<?php echo $customer['id']; ?>">bearbeiten</a></td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>


				</div>
			</div>
		</div>
    </body>
</html>
