<?php
/**
 *WordPress基础配置文件。
 *
 * 这个文件被安装程序用于自动生成wp-config.php配置文件，
 * 您可以不使用网站，您需要手动复制这个文件，
 * 并重命名为“wp-config.php”，然后填入相关信息。
 *
 * 本文件包含以下配置选项：
 *
 * * MySQL设置
 * * 密钥
 * * 数据库表名前缀
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/zh-cn:%E7%BC%96%E8%BE%91_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL 设置 - 具体信息来自您正在使用的主机 ** //
/** WordPress数据库的名称 */
define('DB_NAME', '1809awx');

/** MySQL数据库用户名 */
define('DB_USER', 'root');

/** MySQL数据库密码 */
define('DB_PASSWORD', '123456abc');

/** MySQL主机 */
define('DB_HOST', '127.0.0.1');

/** 创建数据表时默认的文字编码 */
define('DB_CHARSET', 'utf8mb4');

/** 数据库整理类型。如不确定请勿更改 */
define('DB_COLLATE', '');

/**#@+
 * 身份认证密钥与盐。
 *
 * 修改为任意独一无二的字串！
 * 或者直接访问{@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org密钥生成服务}
 * 任何修改都会导致所有cookies失效，所有用户将必须重新登录。
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '*0jS~QN`56*whwZ7zRF/)i=J)j+IfPS0CGg|;&5e:}Qq=Amd=(DdT79C3yq,!}+X');
define('SECURE_AUTH_KEY',  '-]rlYh GRNC5(c[nymgcm<^zKK;b4Uv#hi5 _W-k:/[a[p=w9#G`KtZHkWcJ.Br@');
define('LOGGED_IN_KEY',    'Z?0Wj5BxT{UZkLR=KZ{p!0#dBC!0aUlZeIRT6S0Ql)-<5J@NH#9~}UPE;J</,EZ*');
define('NONCE_KEY',        'S=e`3^/UhWoUh:h{fj|f7{KxTu};A^Y!pJ+]Hr!lMw$>ozK0p3Qc=p{@sn`@(4A8');
define('AUTH_SALT',        ';QxRYfQ?B{R@sEd}?G7hx4PX{m1YN}^Cf=4jOUxTW7T@9K,T=)jiQ2dlRA[?I}E6');
define('SECURE_AUTH_SALT', 'pJ2{vsy. OEK8t:@0 .OmLiwy36zp9U&f{xC]MZIL >yv]?@zDfdu1qJeVEEIgQm');
define('LOGGED_IN_SALT',   'g_:,is:p/D;P1{5VOu97;0siwq0i4cYRqfPWeT).o_HAfA0,Yo[ u^0@2),7`)Mf');
define('NONCE_SALT',       '-R-;&^vO/f[-qQI5=!)`-E0I|.l23%)$X3n#L};pJss1*-kNnic]4 bK5A(dv1TP');

/**#@-*/

/**
 * WordPress数据表前缀。
 *
 * 如果您有在同一数据库内安装多个WordPress的需求，请为每个WordPress设置
 * 不同的数据表前缀。前缀名只能为数字、字母加下划线。
 */
$table_prefix  = 'wp_';

/**
 * 开发者专用：WordPress调试模式。
 *
 * 将这个值改为true，WordPress将显示所有用于开发的提示。
 * 强烈建议插件开发者在开发环境中启用WP_DEBUG。
 *
 * 要获取其他能用于调试的信息，请访问Codex。
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* 好了！请不要再继续编辑。请保存本文件。使用愉快！ */

/** WordPress目录的绝对路径。 */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** 设置WordPress变量和包含文件。 */
require_once(ABSPATH . 'wp-settings.php');
?>
