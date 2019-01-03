<?php
session_start();
include_once 'dbConfig.php';
$username = $_SESSION['username'];
$query = "SELECT folder_name FROM users WHERE username='$username'";
$results = mysqli_query($db, $query);
$row = mysqli_fetch_assoc($results);
$dir = implode($row);

error_reporting(0);
if(isset($_POST['submit'])){
    // Include the database configuration file
    include_once 'dbConfig.php';
    
    // File upload configuration
    $targetDir = "$dir/";
    $allowTypes = array('jpg','png','jpeg','gif');
    
    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';
    if(!empty(array_filter($_FILES['files']['name']))){
        foreach($_FILES['files']['name'] as $key=>$val){
            // File upload path
            $fileName = basename($_FILES['files']['name'][$key]);
            $targetFilePath = $targetDir . $fileName;
            
            // Check whether file type is valid
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
            if(in_array($fileType, $allowTypes)){
                // Upload file to server
                if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){
                    // Image db insert sql
                    $insertValuesSQL .= "('".$fileName."', NOW()),";
                }else{
                    $errorUpload .= $_FILES['files']['name'][$key].', ';
                }
            }else{
                $errorUploadType .= $_FILES['files']['name'][$key].', ';
            }
        }
        
        if(!empty($insertValuesSQL)){
            $insertValuesSQL = trim($insertValuesSQL,',');
            // Insert image file name into database
            $insert = $db->query("INSERT INTO $dir (file_name, uploaded_on) VALUES $insertValuesSQL");
            if($insert){
                $errorUpload = !empty($errorUpload)?'Upload Error: '.$errorUpload:'';
                $errorUploadType = !empty($errorUploadType)?'File Type Error: '.$errorUploadType:'';
                $errorMsg = !empty($errorUpload)?'<br/>'.$errorUpload.'<br/>'.$errorUploadType:'<br/>'.$errorUploadType;
                $statusMsg = "Files are uploaded successfully.".$errorMsg;
            }else{
                $statusMsg = "Sorry, there was an error uploading your file.";
            }
        }
    }else{
        $statusMsg = 'Please select a file to upload.';
    }
    
    // Display status message
    echo $statusMsg;
}


if(isset($_POST['filtr'])){
exec("python write.py $dir");
exec("python NIMA.py");

// Include the database configuration file
include_once 'dbConfig.php';

// Get images from the database
$query = $db->query("SELECT * FROM $dir ORDER BY AFTER DESC");

}

if (isset($_POST['wyloguj'])) {
		session_destroy();
		header("location: login.php");
	}

if( $_POST['rateButton'] ) {
        $keys = array_keys($_POST['rateButton']);
        $clicked = $keys[0];
		$query = "SELECT file_name FROM $dir WHERE AFTER=$clicked";
		$results = mysqli_query($db, $query);
		$row = mysqli_fetch_assoc($results);
		$ok = implode($row);
		unlink("$dir/$ok");	
        $query = $db->query ("DELETE FROM $dir WHERE $dir.AFTER=$clicked");	
		header("location: index2.php");

    }	
	
	
	
	
$query = $db->query("SELECT * FROM $dir ORDER BY AFTER DESC");
$i=1;
if($query->num_rows > 0){
	?>
	<div class="container">
	<div class="row">
	<div class="row">
<?php
    while($row = $query->fetch_assoc()){
        $imageURL = "$dir/".$row["file_name"];
		$point = $row["AFTER"];
		$std = $row["std"];
?>

	
		
            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title=""
                   data-image="<?php echo $imageURL; ?>"
                   data-target="#image-gallery">
                    <img class="img-thumbnail"
                         src="<?php echo $imageURL; ?>"
                         alt="Another alt text"
						 >
						 <div class="caption" >
							<h3>
							
				<?php echo $i?>.Wynik: <?php echo round($point,3);?>  
				
				</h3>
							<h3></h3>
					
							
						</div>
                </a>
					<form method="post">
				<input type="image" name="rateButton[<?php echo $point; ?>]" src="kosz.png" width="25" height="30" value="1" align="left">
				</form>	
			</div>
		
<?php $i=$i+1; }
?>	
	</div>			
			<div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="image-gallery-title">okej</h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img id="image-gallery-image" class="img-responsive col-md-12" src="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary float-left" id="show-previous-image"><i class="fa fa-arrow-left"></i>
                        </button>

                        <button type="button" id="show-next-image" class="btn btn-secondary float-right"><i class="fa fa-arrow-right"></i>
                        
						
                    </div>
					
					
					
                       
                      
                </div>
            </div>
        </div>
	</div>
</div>

<?php
}else{ ?>
    <p>No image(s) found...</p>
 
<?php }  
?>
    


