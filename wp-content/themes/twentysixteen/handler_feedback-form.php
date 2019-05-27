<?php
global $wpdb;

function clean($value = "") {
    $value = trim($value);
    $value = stripslashes($value);
    $value = strip_tags($value);
    $value = htmlspecialchars($value);

    return $value;
}

function check_length($value = "", $min, $max) {
    $result = (mb_strlen($value) < $min || mb_strlen($value) > $max);
    return !$result;
}


function getRandomFileName($path, $extension='')
{
	$extension = $extension ? '.' . $extension : '';
	$path = $path ? $path . '/' : '';
	do {
		$name = md5(microtime() . rand(0, 9999));
		$file = $path . $name . $extension;
	} while (file_exists($file));
	return $name . $extension;
}

function check_error($username = "", $email='', $message='', $photo=''){
    //username
    if(empty($username)){
        $error[] = "Заполните ФИО";
    }elseif(!check_length($username, 2,100)){
        $error[] = "ФИО должно иметь не меньше 2 и не больше 100 символов";
    }
    //email
    $email_validate = filter_var($email, FILTER_VALIDATE_EMAIL);
    if(empty($email)){
        $error[] = "Заполните поле EMAIL";
    }elseif(!$email_validate){
        $error[] = "Некорректный EMAIL";
    }
    //message
    if(empty($message)){
        $error[] = "Заполните поле сообщение";
    }elseif(!check_length($message, 2, 1000)){
        $error[] = "Сообщение должно иметь не меньше 2 и не больше 1000 символов";
    }
	//photo
	if(empty($photo)){
		$error[] = "Загрузите фото";
	}
	if($photo['size'] > 2500000){
		$error[] = "Максимальный размер фото - 2Мб";
	}
	if($photo['error'] < 0){
		$error[] = "Произошла ошибка при загрузке файла";
	}
	$type_img = substr($photo['name'], strrpos($photo['name'], '.')+1); // Получаем Расширение файла
	if($type_img != 'png' && $type_img != 'jpeg'){
		$error[] = "Допустимые форматы для фото - .jpeg .png";
	}

    if(empty($error)){
        return true;
    }else{
        return $error;
    }
}

$username = clean($_POST['username']);
$email = clean($_POST['email']);
$message = clean($_POST['message']);
$photo = $_FILES['photo'];

$result = check_error($username, $email, $message, $photo);
if($result === true){
	 $path = get_template_directory().'/images/';
	 $type_img = '.'.substr($photo['name'], strrpos($photo['name'], '.')+1); // Получаем Расширение файла
	 $img_name = getRandomFileName($path, $photo['name']);
	 move_uploaded_file($photo['tmp_name'], get_template_directory().'/images/'.$img_name);

	$date_create = time();
    $wpdb->query( $wpdb->prepare(
        "
		INSERT INTO wp_feedback_form
		( username, email, message, photo, date_create )
		VALUES ( %s, %s, %s, %s, %d)
		",
        $username,
        $email,
        $message,
        $img_name,
		$date_create
    ));
	$message_email = 'Имя - '.$username.'<br>E-mail - '.$email.'<br> Сообщение - '.$message; // верстка email
	mail(get_bloginfo('admin_email'), "Новое обращение на сайте", $message_email);
    $result = [];
    $result['result'] = true;
}else{
    $result['result'] = false;
}
echo json_encode($result);