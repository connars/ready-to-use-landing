<?php
header("Content-Type: text/html; charset=utf-8");

if(isset($_POST['phone'])) {
	
        
$products = [];
            
$products[0]["id"] = $_POST['product_id']; // id товара
$products[0]["name"] = ""; // название товара
$products[0]["costPerItem"] = $_POST['product_price']; // цена
$products[0]["amount"] = "1"; // количество
            
$_salesdrive_values = [
    "form" => "I_dW6Yos0m803amkxJ45uCA-11gIAlNfwmJ2lJ2MkDEGBleMoKfB_Ko",
    "products" => $products, //Товары/Услуги
    "comment" => "", // Комментарий
    "shipping_method" => "id_9", // Способ доставки
    "fName" =>  $_POST['name'], // Имя
    "lName" => "", // Фамилия
    "phone" => $_POST['phone'], // Телефон
    "email" => "", // Email
    "company" => "", // Компания
    "con_comment" => "", // Комментарий
	"sajt" => isset($_SERVER["SERVER_NAME"])?$_SERVER["SERVER_NAME"]:"", // Сайт
    "prodex24source_full" => isset($_COOKIE["prodex24source_full"])?$_COOKIE["prodex24source_full"]:"",
    "prodex24source" => isset($_COOKIE["prodex24source"])?$_COOKIE["prodex24source"]:"",
    "prodex24medium" => isset($_COOKIE["prodex24medium"])?$_COOKIE["prodex24medium"]:"",
    "prodex24campaign" => isset($_COOKIE["prodex24campaign"])?$_COOKIE["prodex24campaign"]:"",
    "prodex24content" => isset($_COOKIE["prodex24content"])?$_COOKIE["prodex24content"]:"",
    "prodex24term" => isset($_COOKIE["prodex24term"])?$_COOKIE["prodex24term"]:"",
    "prodex24page" => isset($_SERVER["HTTP_REFERER"])?$_SERVER["HTTP_REFERER"]:"",
];

$_salesdrive_url = "https://igadgetgroup.salesdrive.me/handler/";
$_salesdrive_ch = curl_init();
curl_setopt($_salesdrive_ch, CURLOPT_URL, $_salesdrive_url);
curl_setopt($_salesdrive_ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($_salesdrive_ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt($_salesdrive_ch, CURLOPT_SAFE_UPLOAD, true);
curl_setopt($_salesdrive_ch, CURLOPT_CONNECTTIMEOUT, 30);
curl_setopt($_salesdrive_ch, CURLOPT_POST, 1);
curl_setopt($_salesdrive_ch, CURLOPT_POSTFIELDS, json_encode($_salesdrive_values));
curl_setopt($_salesdrive_ch, CURLOPT_TIMEOUT, 10);

$_salesdrive_res = curl_exec($_salesdrive_ch);
$_salesdriveerrno = curl_errno($_salesdrive_ch);
$_salesdrive_error = 0;

	
	
	
$email = "kamerprovod8@gmail.com"; #Email, на него придут письма
$title = urlencode("Заказ на Плюшевый танцующий кактус"); #Заголовок письма

$text = "
Информация о покупателе:

Имя: ".$_POST['name']."
Телефон: ".$_POST['phone']."

Заявка пришла с сайта:" . $_SERVER['HTTP_REFERER'] ."
Время заказа: ".date("Y-m-d H:i:s");


$texttg = "Информация о покупателе:%0A%0A".$title."%0A%0AФИО: ".$_POST['name']."%0AТелефон: ".$_POST['phone']."%0A%0AЗаявка пришла с сайта: ". $_SERVER['HTTP_REFERER'] ."%0AВремя заказа: ".date("Y-m-d H:i:s");

$sendToTelegram = fopen("https://api.telegram.org/bot1276224300:AAEKX8i0IJcH6S_0ca-L7BhHAZ19s6z-6Cc/sendMessage?chat_id=-1001430380402&parse_mode=html&text=$texttg","r");

if($sendToTelegram) {
	header('Location: thx.html');
} else {
	echo "Ошибка. Возможно функция mail отключена. Обратитесь к хостинг-провайдеру или возьмите консультацию на сайте, где купили шаблон";
}
} else {
	echo "Ошибка";
}
?>