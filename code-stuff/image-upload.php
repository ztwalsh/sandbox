function add_photo() {
  if($_POST) {
    $required_fields = array('image');
    $errors = required_fields($required_fields, $_POST);

    if(empty($errors)) {
      //$data = $_POST['image'];
      $data = $_FILES["review_image"]["tmp_name"];

      $image = \Cloudinary\Uploader::upload($data);

      if($image) {
        global $mysqli;

        $caption				= trim($_POST['caption']);

        $query = 	"INSERT INTO images (";
        $query .= 	"file_name, caption";
        $query .= 	") VALUES (";
        $query .= 	"'".$image['url']."', '".$caption."'";
        $query .= 	")";
        $mysqli->query($query);
        //return $query;
        $_SESSION['image_id'] = $mysqli->insert_id;
        header('Location: review.php');
      } else {
        return 'error_cant_process';
      }

      /* OLD WAY, STILL HANDY FOR SOME THINGS*/
      /*list($type, $data) = explode(';', $data);
      list(, $data)      = explode(',', $data);
      $data = base64_decode($data);

      $new_file_name = date('mdYgisu').'_'.rand().'.jpg';

      if(file_put_contents('images/reviews/'.$new_file_name, $data)) {
        global $mysqli;

        $caption				= trim($_POST['caption']);

        $query = 	"INSERT INTO images (";
        $query .= 	"file_name, caption";
        $query .= 	") VALUES (";
        $query .= 	"'".$new_file_name."', '".$caption."'";
        $query .= 	")";
        $mysqli->query($query);
        //return $query;
        $_SESSION['image_id'] = $mysqli->insert_id;
        header('Location: review.php');
      } else {
        return 'error_cant_process';
      }*/
    } else {
      return 'error_missing_fields';
      echo 'not done 2';
    }
  } else {
    return false;
  }
}
