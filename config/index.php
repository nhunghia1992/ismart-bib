<?php

$configFile = "config.json";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$fh = fopen($configFile, 'w') or die("can't open file");

	fwrite($fh, json_encode($_POST));

	fclose($fh);
}

$curentConfig = json_decode(file_get_contents($configFile), true);

?>

<form action="" method="POST">
	<table>
		<tr>
			<td>Google API Token</td>
			<td><input id="ggToken" name="ggToken" type="text" value="<?php if (isset($curentConfig['ggToken'])) {
																			echo $curentConfig['ggToken'];
																		} ?>" style="width: 300px;" /></td>
		</tr>
		<tr>
			<td>Sheet ID</td>
			<td><input id="sheetID" name="sheetID" type="text" value="<?php if (isset($curentConfig['sheetID'])) {
																			echo $curentConfig['sheetID'];
																		} ?>" style="width: 300px;" /></td>
		</tr>
		<tr>
			<td>Sheet Name</td>
			<td><textarea id="sheetName" name="sheetName" rows="8" style="width: 300px;"><?php if (isset($curentConfig['sheetName'])) {
																								echo $curentConfig['sheetName'];
																							} ?></textarea><br />
				<button type="button" id="get_sheet_name">Get sheet name</button>
			</td>
		</tr>
		<tr>
			<td>Student name column</td>
			<td><input name="studentname_col" type="number" value="<?php if (isset($curentConfig['studentname_col'])) {
																		echo $curentConfig['studentname_col'];
																	} ?>" style="width: 300px;" /></td>
		</tr>
		<tr>
			<td>Grade column</td>
			<td><input name="grade_col" type="number" value="<?php if (isset($curentConfig['grade_col'])) {
																	echo $curentConfig['grade_col'];
																} ?>" style="width: 300px;" /></td>
		</tr>
		<tr>
			<td>Parent name column</td>
			<td><input name="parentname_col" type="number" value="<?php if (isset($curentConfig['parentname_col'])) {
																		echo $curentConfig['parentname_col'];
																	} ?>" style="width: 300px;" /></td>
		</tr>
		<tr>
			<td>Parent phone column</td>
			<td><input name="parentphone_col" type="number" value="<?php if (isset($curentConfig['parentphone_col'])) {
																		echo $curentConfig['parentphone_col'];
																	} ?>" style="width: 300px;" /></td>
		</tr>
		<tr>
			<td>Parent email column</td>
			<td><input name="parentemail_col" type="number" value="<?php if (isset($curentConfig['parentemail_col'])) {
																		echo $curentConfig['parentemail_col'];
																	} ?>" style="width: 300px;" /></td>
		</tr>
		<tr>
			<td>BIB column</td>
			<td><input name="bib_col" type="number" value="<?php if (isset($curentConfig['bib_col'])) {
																echo $curentConfig['bib_col'];
															} ?>" style="width: 300px;" /></td>
		</tr>
		<tr>
			<td>File hướng dẫn</td>
			<td><input name="guide_file" type="checkbox" value="1" <?php if (isset($curentConfig['guide_file'])) {
																		echo 'checked';
																	} ?> /></td>
		</tr>
		<tr>
			<td>Hiện STT</td>
			<td><input name="show_index" type="checkbox" value="1" <?php if (isset($curentConfig['show_index'])) {
																		echo 'checked';
																	} ?> /></td>
		</tr>
	</table>
	<input type="submit" name="submit" value="Save" />
</form>
<script type="text/javascript">
	function addText(event) {
		var targ = event.target || event.srcElement;
		document.getElementById("sheetName").value += targ.textContent || targ.innerText;
	}
	var getJSON = function(url, callback) {
		var xhr = new XMLHttpRequest();
		xhr.open('GET', url, true);
		xhr.responseType = 'json';
		xhr.onload = function() {
			var status = xhr.status;
			if (status === 200) {
				callback(null, xhr.response);
			} else {
				callback(status, xhr.response);
			}
		};
		xhr.send();
	};
	document.getElementById("get_sheet_name").onclick = function() {
		var sheetID = document.getElementById("sheetID").value;
		var ggToken = document.getElementById("ggToken").value
		var url = 'https://sheets.googleapis.com/v4/spreadsheets/' + sheetID + '/?key=' + ggToken + '&fields=sheets.properties.title'
		getJSON(url, function(err, data) {
			if (err !== null) {
				alert('Something went wrong: ' + err);
			} else {
				if (data) {
					var sheetNames = [];
					for (var i = 0; i < data.sheets.length; i++) {
						sheetNames.push(data.sheets[i].properties.title);
					}
					document.getElementById("sheetName").value = sheetNames.join("\r\n");
				}
			}
		});
	};
</script>