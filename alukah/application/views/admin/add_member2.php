$image_name = $_FILES['book_image']['name'];
$upload_image = $structure . DS . basename($image_name);

$extra_name = $_FILES['book_extra']['name'];
$upload_extra = $structure . DS . basename($extra_name);

if (!move_uploaded_file($image_name, $upload_image))
$this->error[] = 'upload wrong file';

if (!move_uploaded_file($extra_name, $upload_extra))
$this->error[] = 'upload wrong file';