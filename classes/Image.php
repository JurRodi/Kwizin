<?php 

    class image{

        public static function upload($meal_id, $user_id){
            $conn = Db::getConnection();
            $statusMsg = '';
            $targetDir = "images/";

                if(!empty($_FILES["image"]["name"])){
                    $fileName = basename($_FILES["image"]["name"]);
                    $targetFilePath = $targetDir . $fileName;
                    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                    $allowTypes = array('jpg','png','jpeg','gif');

                    if(in_array($fileType, $allowTypes)){
                        if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)){
                            if(isset($_POST['mealUpload'])){
                                $stmt = $conn->prepare("UPDATE meals SET image = :image WHERE id = :id");
                                $stmt->bindValue(":image", $fileName);
                                $stmt->bindValue(":id", $meal_id);
                                $stmt->execute();
                                $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
                            }elseif(isset($_POST['avatar'])){
                                $insert = $conn->prepare("UPDATE users SET avatar = :avatar WHERE id = :id");
                                $insert->bindValue(':avatar', $fileName);
                                $insert->bindValue(':id', $user_id);
                                $insert->execute();
                                $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
                            }else{
                                $statusMsg = "File upload failed, please try again.";
                            }
                        }else{
                            $statusMsg = "Sorry, there was an error uploading your file.";
                        }
                    }else{
                        $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.';
                    }
                }else{
                    $statusMsg = 'Please select a file to upload.';
                }
            return $statusMsg;
        }
    }