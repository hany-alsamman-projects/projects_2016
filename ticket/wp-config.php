<?php // Modified for Arabic by Rasheed Bydousi

/** إعدادات برنامج ووردبريس المعرب **/

// ** إعدادات قاعدة البيانات - ينمكنك الحصول على هذه المعلومات من مستضيفك ** //
/** اسم قاعدة بيانات ووردبريس */
define('DB_NAME', 'bp_ticket');

/** اسم المستخدم لقاعدة البيانات */
define('DB_USER', 'root');

/** كلمة المرور لقاعدة البيانات */
define('DB_PASSWORD', '');

/** عنوان خادم قاعدة البيانات */
define('DB_HOST', 'localhost');

/** ترميز قاعدة البيانات */
define('DB_CHARSET', 'utf8');

/** مقارنات قاعدة الببيانات (Collation). 
* إذا كنت غير متأكّد أتركها فارغة */
define('DB_COLLATE', '');

/**#@+
 * مفاتيح الأمان.
 * استخدم الرابط التالي لتوليد المفتايح {@link https://api.wordpress.org/secret-key/1.1/salt/}
 * @منذ 2.6.0
 */
define('AUTH_KEY',         '2 IXBYn~QIOIjX-Y3nmw3S3|M7SBYZ1>cu-G^Xauz75k<|:R5$|e_Je^7X,r7X.e');
define('SECURE_AUTH_KEY',  '#S=`F]cGTJR|i^a=Cg=<a-6!|.GeOB@B(NW<U%[FLGXk)2aKDy[y(g|WU+1?OfXs');
define('LOGGED_IN_KEY',    'iVa@f/K^ehr32ymo1&@@lJ+xKO8CJOv`t-8[h7b)$):#QmvSV%-QNb]eq9*+:JUJ');
define('NONCE_KEY',        'bkD ^(wG,@8VBfB{ujX2C|O@Qo[M+Ww7|DS6HgmL!F{X(bsGPs;<8&c:4kappMfE');
define('AUTH_SALT',        'qM+vr3-DdX-)H$lv3AZSK(j0IRg.>AI*5QSUmBgQiqvL6y$[J|DUPOR:udq*YE]C');
define('SECURE_AUTH_SALT', '9g7y@#+%aQ|^#&1YWPx{J39~k!v9St]cNBy|wa{Ro.T.sOh(&rm@N{{A-v|V+?o$');
define('LOGGED_IN_SALT',   'DNtpeD5>X=9IT_t_3&@_|z2E%DgTXM}LwEfI|]@Q}`6gC_RQdjfyw0|R*t>+*P0X');
define('NONCE_SALT',       'e!HM$gU,``9f#Ekjuf+3aQgQ&{gN/G p^h.c4mp%G0Zq0mAwhjsGi/#>enO0[kD?');


/**#@-*/

/**
 * بادئة الجداول في قاعدة البيانات.
 * تستطيع تركيب أكثر من مدونة على نفس قاعدة البيانات إذا أعطيت لكل قاعدة بادئة جداول مختلفة
 * استخدم فقط حروف, أرقام وخطوط سفلية!
 */
$table_prefix  = 'wp_';

/**
 * اللغة الافتراضية المستخدمة في هذه النسخة هي العربية
 * إذا أردت أن تكون لوحة التحكم في مدونتك بالانجليزية قم بحذف الحرفين أدناه وهي الحروف ar
 */
define('WPLANG', 'ar');

/**
 * للمطورين: نظام تشخيص الأخطاء
 * قم بتغيير flase إلى true لتمكين عرض الملاحظات أثناء التطوير
 */
define('WP_DEBUG', false);





/* هذا هو المطلوب! توقف عن التعديل. نتمنى لك التوفيق في موقعك! */

/** المسار المطلق لمجلد ووردبريس. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
