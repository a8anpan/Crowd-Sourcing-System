<?php

// Resume the previous session
session_start();

// If the user is not logged in redirect to the login page
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit();
}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Upload Data</title>
		<link href="style_.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<!-- Load leaflet.js -->
		<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
				integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
				crossorigin=""/>
		<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
				integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
				crossorigin=""></script>
		<!-- Load the draw plugin -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/0.4.2/leaflet.draw.css"/>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/0.4.2/leaflet.draw.js"></script>

	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>CrowdScope</h1>

				<!-- Navigation Bar -->
				<a href="user.php"><i class="fas fa-user"></i>Dashboard</a>
				<a href="user_stats.php"><i class="fas fa-chart-line"></i>Stats</a>
				<a href="user_upload.php"><i class="selected fas fa-cloud-upload-alt"></i>Upload</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>

			</div>
		</nav>

		<div class="content">
			<h2>Upload Data</h2>
			<p>Select the location history file you downloaded from Google in JSON format.
			Note that before uploading, you can exclude sensitive regions by highlighting them on the map using the toolbar located at the top right.
			</p>

			<div id="mapid"></div>

			<!-- <form action="upload.php" method="post" enctype="multipart/form-data">
				Filename:
				<input type="file" name="file" id="file">
				<input type="hidden" name="areas" id="areas" value="[]">
				<input type="submit" name="submit" value="Submit">
			</form> -->

			<input type="file" id="files" name="file" /> Read bytes:
            <span class="readBytesButtons">

              <button>entire file</button>
            </span>
            <div id="byte_range"></div>
            <p id="byte_content"></p>

            <script>
              function readBlob(opt_startByte, opt_stopByte) {

                var files = document.getElementById('files').files;
                if (!files.length) {
                  alert('Please select a file!');
                  return;
                }

                var file = files[0];
                var start = parseInt(opt_startByte) || 0;
                var stop = parseInt(opt_stopByte) || file.size - 1;

                var reader = new FileReader();

                // If we use onloadend, we need to check the readyState.
                reader.onloadend = function(evt) {
                  if (evt.target.readyState == FileReader.DONE) { // DONE == 2

                    document.getElementById('byte_range').textContent =
                        ['Read bytes: ', start + 1, ' - ', stop + 1,
                         ' of ', file.size, ' byte file'].join('');
                  }


            // FIND serverIPAddress *****************************************
            const regexp = new RegExp('serverIPAddress": "+[0-9].+[0-9].+[0-9].+[0-9]','g');
            const str = evt.target.result;
            let match;
            let mystring = '';
            while ((match = regexp.exec(str)) !== null) {
              console.log(`Found ${match[0]} start=${match.index} end=${regexp.lastIndex}.`);
              mystring = mystring.concat(match[0])
            }

            // FIND wait **************************************
            const regexp2 = new RegExp('"wait": +[0-9].+[0-9]','g');

            let match2;

            while ((match2 = regexp2.exec(str)) !== null) {
              console.log(`Found ${match2[0]} start=${match2.index} end=${regexp2.lastIndex}.`);
              mystring = mystring.concat(match2[0]);
            }



            //let my_string = match2.toString();
            console.log(typeof regexp2.exec(str));
            console.log(typeof match2);

            //console.log(my_string);

            // FIND staredDateTime *****************************
            //"startedDateTime": "2020-11-22T13:53:43.299Z"
            const regexp3 = new RegExp('"startedDateTime": "[0-9]+-[0-9]+-[a-zA-Z0-9]+:[0-9]+:[0-9]+.[a-zA-Z0-9]+','g');

            let match3;

            while ((match3 = regexp3.exec(str)) !== null) {
              console.log(`Found ${match3[0]} start=${match3.index} end=${regexp3.lastIndex}.`);
            mystring = mystring.concat(match3[0]);
            }

             // FIND method *****************************
               const regexp4 = new RegExp('"method": "[a-zA-Z0-9]+"','g');

                        let match4;

                        while ((match4 = regexp4.exec(str)) !== null) {
                          console.log(`Found ${match4[0]} start=${match4.index} end=${regexp4.lastIndex}.`);
                        mystring = mystring.concat(match4[0]);
                        }

              // FIND status *****************************
               const regexp5 = new RegExp('"status": [0-9]+','g');

                let match5;

                  while ((match5 = regexp5.exec(str)) !== null) {
                    console.log(`Found ${match5[0]} start=${match5.index} end=${regexp5.lastIndex}.`);
                    mystring = mystring.concat(match5[0]);
                           }

               // FIND statusText *****************************
                const regexp6 = new RegExp('"statusText": "(\s)|[a-zA-Z]+"','g');

               let match6;

                while ((match6 = regexp6.exec(str)) !== null) {
                console.log(`Found ${match6[0]} start=${match6.index} end=${regexp6.lastIndex}.`);
                mystring = mystring.concat(match6[0]);
                                                      }

            console.log('TEST!!!');
            console.log(mystring);

                };

                var blob = file.slice(start, stop + 1);
                reader.readAsBinaryString(blob);
              }

              document.querySelector('.readBytesButtons').addEventListener('click', function(evt) {
                if (evt.target.tagName.toLowerCase() == 'button') {
                  var startByte = evt.target.getAttribute('data-startbyte');
                  var endByte = evt.target.getAttribute('data-endbyte');
                  readBlob(startByte, endByte);
                }
              }, false);
            </script>
			<p>When uploading big JSON files it will take a while to process all the locations. Please be patient.</p>

		</div>

		<!-- Load the map -->
		<script src="upload_map.js"></script>
	</body>
</html>