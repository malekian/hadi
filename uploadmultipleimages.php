<?php
$db_host="localhost";
$db_user="root";
$db_pass="";
$db_name="realestate";
$db_table="upload";
$connect = mysqli_connect("$db_host", "$db_user", "$db_pass", "$db_name");
mysqli_query($connect,"SET NAMES 'utf8'");
mysqli_query($connect,"SET character_set_connection='utf8'");
if(mysqli_connect_errno()){
	die("unable to connect".mysqli_connect_errno());
}
include('function.php');

// settings
$max_file_size = 10240*2000; // 200kb
$valid_exts = array('jpeg', 'jpg', 'png', 'gif');
// thumbnail sizes
$sizes = array( 600 => 600);

if (!file_exists('tmp/')) {
    mkdir('tmp/', 0777, true);
}
if (!file_exists('photo/')) {
    mkdir('photo/', 0777, true);
}

function base64_to_jpeg($base64_string, $output_file) {
    $ifp = fopen($output_file, "wb"); 

    $data = explode(',', $base64_string);

    fwrite($ifp, base64_decode($data[1])); 
    fclose($ifp); 

    return $output_file; 
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if(isset($_POST['image_data'])) {
		$image_data_list = json_decode($_POST['image_data'], true);
		
		$msg = "OK";
		foreach($image_data_list as $index => $image_data) {
			$image_name = $image_data['name'];
			$image_size = $image_data['size'];
			$image_type = $image_data['type'];
			$image_base64 = $image_data['base64'];
			
			$image_path = base64_to_jpeg($image_base64, "tmp/" . $image_name);
			
			if ($image_size < $max_file_size) {
				$image[] = addslashes($image_name);
				$ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
				if (in_array($ext, $valid_exts)) {
					// resize image
					$files = resize($image_name, $image_path, $image_type, 600, 600);
				} else {
					$msg = 'Unsupported file';
				}
			} else {
				$msg = 'Please upload image smaller than 200KB';
			}
			
			unlink($image_path);
		}
		
		if ($stmt = mysqli_prepare($connect, "INSERT INTO $db_table VALUES ('', ?)")) {
			// bind parameters for markers
			$image_names = implode($image, ",");
			mysqli_stmt_bind_param($stmt, "s", $image_names);
			// execute query
			if(mysqli_stmt_execute($stmt))
			{	
				$response = Array("status" => $msg);
			}
			else
			{
				$response = Array("status" => "error", "error" => mysqli_error($connect));
			}
			echo json_encode($response);

			// close statement
			mysqli_stmt_close($stmt);
		}
	}
	
	if(isset($_POST['form_data'])) {
		$form_data = json_decode($_POST['form_data'], true);
		
		$fname = $form_data['fname'];
		$case1 = $form_data['case1'];
		
		echo $fname, $case1;
	}
} else {

?>

<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>upload multiple image</title>
  <style>
    #result-container-template {
      display: none;
    }
    
    .button-style::-webkit-file-upload-button {
      visibility: hidden;
    }
    
    .button-style {
      display: inline-block;
      background: -webkit-linear-gradient(top, #f9f9f9, #e3e3e3);
      border: 1px solid #999;
      border-radius: 3px;
      padding: 5px 8px;
      outline: none;
      white-space: nowrap;
      -webkit-user-select: none;
      cursor: pointer;
      text-shadow: 1px 1px #fff;
      font-weight: 700;
      font-size: 10pt;
    }
    
    .button-style:hover {
      border-color: black;
    }
    
    .button-style:active {
      background: -webkit-linear-gradient(top, #e3e3e3, #f9f9f9);
    }
    
    #choose-file {
      display: none;
    }
    
    #result-container {
      display: inline-block;
      width: 150px;
      height: 172px;
      margin: 1px;
    }
    
    #image-container {
      width: 100%;
      height: 150px;
    }
    
    #image-container img {
      width: 100%;
      height: 100%;
      border-radius: 0px 0px 3px 3px;
    }
    
    #result-container button {
      width: 100%;
      height: 22px;
      border: transparent;
      background-color: red;
      color: white;
      border-radius: 3px 3px 0px 0px;
    }
	
	#note {
		color: green;
	}
  </style>
  <script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
</head>

<body>
  <div>
    <fieldset>
      <div id="result">
        <div id="result-container-template">
          <button class="remove_pict">remove</button>
          <div id="image-container">
            <img class="thumbnail" src="" title="undefined">
          </div>
        </div>
      </div>
      <legend>Upload your image</legend><br><br><br><br>
      <p dir="rtl"><label class="button-style" for="choose-file">Add images</label>
        <input id="choose-file" type="file" name="image[]" multiple=""><br><br>
      </p>
    </fieldset>
  </div>
  <form action="" method="POST" enctype="multipart/form-data" name="contactform" id="contactform" autocomplete="on">
    <div>
      <fieldset>
        <p dir="rtl"><input class="button-style submit" name="submit" type="submit" id="submit" value="Upload"></p>
      </fieldset>
    </div>
	    First name: <input type="text" name="fname"><br>
	case1
<select name="case1">
  <option value="">please select</option>
  <option value="volvo">Volvo</option>
  <option value="saab">Saab</option>
  <option value="mercedes">Mercedes</option>
  <option value="audi">Audi</option>
</select>
  </form>
  <div id="note">
  </div>
  <script>
  $.fn.serializeObject = function()
{
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};
    window.onload = function () {
		
		var image_data = [];
		
		$("#submit").click(function( event ) {
		  event.preventDefault();
		  $.ajax({
			  type: "POST",
			  url: window.location.href,
			  data: {
				  'image_data': JSON.stringify(image_data),
				  'form_data': JSON.stringify($("form").serializeObject)
			  },
			  success: (data) => {
				  var response;
				  if (data) {
					  console.log(data);
					  try {
						response = JSON.parse(data);
						$("#result").empty();
					  image_data = [];
					  $("#note").text(response["status"]);
					}
					catch(err) {
						$("#note").text("An error occured. " + err);
					}
				  } else {
					  console.log("Got empty response.")
					  $("#note").text("Image too big to process. Please upload images < 200kb.");
				  }
				  
			  }
			});
		});

      var template_div = document.querySelector("#result-container-template");

      //Check File API support
      if (window.File && window.FileList && window.FileReader) {
        var filesInput = document.querySelector("input[type=file]");

        filesInput.addEventListener("change", function (event) {

          var files = event.target.files; //FileList object
          var output = document.getElementById("result");

          for (var i = 0; i < files.length; i++) {
            var file = files[i];

            //Only pics
            if (!file.type.match('image'))
              continue;

            var picReader = new FileReader();

            picReader.addEventListener("load", function (file) {
				return function (event) {
					image_data.push({
						'name': file.name,
						'size': file.size,
						'type': file.type,
						'base64': event.target.result
					});
					
				  var picFile = event.target;
				  var div = template_div.cloneNode(true);
				  div.id = "result-container";

				  var img_elem = div.querySelector("img");
				  img_elem.src = picFile.result;
				  img_elem.title = picFile.name;

				  output.insertBefore(div, null);
				  div.querySelector("button")
					.addEventListener("click", function (event) {
						for (var i = 0; i < image_data.length; i++) {
							if ($(div).find("img").attr("src") == image_data[i]["base64"]) {
								image_data.splice(i, 1);
							}
						}
						
					  div.parentNode.removeChild(div);
					});

				};
			}(file));

            //Read the image
            picReader.readAsDataURL(file);
          }

          //filesInput.value = "";
        });
      }
      else {
        console.log("Your browser does not support File API");
      }
    }

  </script>
</body>

</html>

<?php

}

/*
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if(isset($_FILES['image'])) {
		foreach($_FILES['image']['name'] as $index => $image_name) {
			$image_size = $_FILES['image']['size'][$index];
			$image_path = $_FILES['image']['tmp_name'][$index];
			
			if ($image_size < $max_file_size) {
				$image[] = addslashes($image_name);
				$ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
				if (in_array($ext, $valid_exts)) {
					// resize image
					$files = resize($index, 600, 600);
				} else {
					$msg = 'Unsupported file';
				}
			} else {
				$msg = 'Please upload image smaller than 200KB';
			}
		}
	} else {
		$msg = 'Image too big to fetch.';
	}
}

if(isset($_POST['submit'])){ 
//insert to database
if ($stmt = mysqli_prepare($connect, "INSERT INTO $db_table VALUES ('', ?)"))
{
	// bind parameters for markers
	$image_names = implode($image, ",");
    mysqli_stmt_bind_param($stmt, "s", $image_names);
    // execute query
    if(mysqli_stmt_execute($stmt))
    {
echo"your image has been send successfully";
    }
    else
    {
        echo "Error occurred: " . mysqli_error($connect);
    }

    // close statement
    mysqli_stmt_close($stmt);
}
}
*/
?>
