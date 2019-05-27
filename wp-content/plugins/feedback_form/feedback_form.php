<?php
/*
	 * Plugin Name: Форма обратной связи
		Author: Михальчук Петро
		Description: 
		Plugin URI:
		Version: 0.0.1
	 */
function true_plugin_init() {
     wp_enqueue_style('styles_main', plugins_url('/css/main.css', __FILE__));
	  wp_enqueue_style('styles_bootsrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css');
	 
}
add_action( 'admin_init', 'true_plugin_init');

function add_feedback_form_menu() {
    add_menu_page(
        'Форма обратной связи', // имя в меню
        'Форма обратной связи', // title страницы
        'manage_options', // уровень доступа
        'feedback_form', // slug страницы
        'render_help_page', // функция, отображающая собственно страницу
        'dashicons-editor-help', // иконка
        '10' // позиция в меню
    );
}
add_action('admin_menu', 'add_feedback_form_menu');

function pagination($page_number){
		global $wpdb;
        $st =  $wpdb->get_results("SELECT COUNT(*) as count FROM wp_feedback_form");
        $total_rows = (array)$st;
        $num_pages = ceil( $total_rows[0]->count/15);
        return $num_pages;
}

function count_applications(){
		global $wpdb;
        $st =  $wpdb->get_results("SELECT COUNT(*) as count FROM wp_feedback_form");
        $total_rows = (array)$st;
        return $total_rows[0]->count;
}


function get_all_applications(){
	global $wpdb;
	if(!empty($_POST['id_delete'])){
		$id = $_POST['id_delete'];
		$name_img = $wpdb->get_results("SELECT photo FROM wp_feedback_form WHERE id=$id");
	$name_img = (array)$name_img;
	@unlink(get_template_directory_uri() ."/images/".$name_img[0]->photo);
	$wpdb->get_results("DELETE FROM wp_feedback_form WHERE id=$id");
	}
	$per_page=15;
	// получаем номер страницы
	if (isset($_GET['number'])) {
	   $page=$_GET['number']-1;
	}else{
		$page=0;
	}
	$start=abs($page*$per_page);
	return $wpdb->get_results("SELECT * FROM wp_feedback_form ORDER BY date_create DESC LIMIT $start,$per_page");
	
}
function render_help_page() {
	// echo "<pre>";
    // print_r(get_all_applications());
	// echo "</pre>";
	$result = get_all_applications();
	echo "<h1>Заявки</h1>";
	echo "<div class='feedback_form div-table'>";
		echo "<div class='div-table-row'>
					<div class='id_feedback div-table-col'>ID</div>
					<div class='username div-table-col'>ФИО</div>
					<div class='email_f div-table-col'>E-mail</div>
					<div class='message div-table-col'>Сообщение</div>
					<div class='photo div-table-col'>Фото</div>
					<div class='data_create div-table-col'>Дата создания</div>
					<div class='operation div-table-col'>Действия</div>					
				</div>";
		if(!empty($result)){
			foreach($result as $item){
				echo "<div class='div-table-row'>
					<div class='id_feedback div-table-col'>$item->id</div>
					<div class='username div-table-col'>$item->username</div>
					<div class='email_f div-table-col'>$item->email</div>
					<div class='message div-table-col'><textarea>$item->message</textarea></div>
					<div class='photo div-table-col'><img width='100px;' src='".get_template_directory_uri() ."/images/".$item->photo."'/></div>
					<div class='data_create div-table-col'>".date('d-m-Y H:i',$item->date_create)."</div>
					<div class='operation div-table-col'><form method='POST'><input type='hidden' name='id_delete' value='".$item->id."'/><button>Удалить</button></form></div>					
				</div>";
			}
		}
	echo "</div>";
	$count = pagination($_GET['number']);
	if(count_applications() >= 15){
		echo '<nav aria-label="Page navigation example">
			<ul class="pagination justify-content-center">';
			if(!empty($_GET['number']) && $_GET['number']-1>0){
			$prev = $_GET['number']-1;
			echo '<li class="page-item">
					<a class="page-link" href="/wp-admin/admin.php?page=feedback_form&number='.$prev.'" tabindex="-1">Попередня</a>
				</li>';
			}else{
			echo '<li class="page-item disabled">
					<a class="page-link" href="#" tabindex="-1">Попередня</a>
				</li>';
			}
			for($i=1;$i<=$count;$i++) {
				if ($i == $_GET['number']) {
				   echo '<li class="page-item page-item-active"><a class="page-link" href="/wp-admin/admin.php?page=feedback_form&number='.$i.'">'.$i."</a></li>";
				} else {
				  echo '<li class="page-item"><a class="page-link" href="/wp-admin/admin.php?page=feedback_form&number='.$i.'">'.$i."</a></li>";
				}
			}
			
			if(!empty($_GET['number']) && $_GET['number']+1<=$count){
			$next = $_GET['number']+1;
			echo '<li class="page-item">
					<a class="page-link" href="/wp-admin/admin.php?page=feedback_form&number='.$next.'" tabindex="-1">Наступна</a>
				</li>';
			}else{
			echo '<li class="page-item disabled">
					<a class="page-link" href="#" tabindex="-1">Наступна</a>
				</li>';
			} 
		echo '</ul></nav>';
	}
}