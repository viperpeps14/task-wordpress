<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'task-wordpress' );

/** Имя пользователя MySQL */
define( 'DB_USER', 'root' );

/** Пароль к базе данных MySQL */
define( 'DB_PASSWORD', '' );

/** Имя сервера MySQL */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '1YK~5&Ya o)>K*cbX&tX}lQ_}`Mre>Gz.Fo: ?@~_-%9oE^s/C_04ME(1_E(afe8' );
define( 'SECURE_AUTH_KEY',  'vdSJzz&|H{n7>&<VLhNDrv?%#4?J^ ,qs7esn[I#5~s}*jR7Kbh(V[s;L_2bov{W' );
define( 'LOGGED_IN_KEY',    'eDfo)]Jec$B`T}:<i]v<&miK5c}Du~6W$?eP+B,d$fF~E0w=rhS%EoeJq%7%@=Ai' );
define( 'NONCE_KEY',        '|od51DSShc)AT&bh<<E7:=/}HdY0s#KEP%oMW?C*:)`5)L9VprAt2y{hm dR`LhQ' );
define( 'AUTH_SALT',        'wwNlrQ4.[ME&L-o-]{kT:1z$X|M%6!0#_i27L72%Bd)t!bFE**j3I{*>/0r~ht6L' );
define( 'SECURE_AUTH_SALT', 'qyf~_uQqjMgf:!oz#So`]{&`I]yjfr)#?k9o$~:n0AiHyItT]Fbgo.]x>@ }{~yT' );
define( 'LOGGED_IN_SALT',   'v$Y8Yw{Ja3a_7SdK;:>~rw$PHS[CQbvg@HXjP.0.OH*,EweGF,637,&NGL:p=nA=' );
define( 'NONCE_SALT',       'w>yGl&6?C81>v$m`l7l.b&4%dxNP>aW5K1E_KMxZz!P^Pn8~|[ !VdUMqQ{cQ3v{' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once( ABSPATH . 'wp-settings.php' );
