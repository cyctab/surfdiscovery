 html
 
 <?
/* Этот скрипт получает переменные из request.html */

/* Переменные для соединения с базой данных */
$hostname = "localhost";
$username = "myusername";
$password = "mypassword";
$dbName = "products";

/* Таблица MySQL, в которой хранятся данные */
$userstable = "clients";

/* email администратора */
$adminaddress = "administration@me.com";

/* создать соединение */
mysql_connect($hostname,$username,$password) OR DIE("Не могу создать соединение ");
/* выбрать базу данных. Если произойдет ошибка - вывести ее */
mysql_select_db($dbName) or die(mysql_error()); 

echo "<CENTER>";
echo "Привет, ".$_POST['name'];
echo "<BR><BR>";
echo "Спасибо за ваш интерес.<BR><BR>";
echo "Вас интересуют ".$_POST['preference'].". Информацию о них мы пошлем вам на email: ".$_POST['email'];
echo "</CENTER>";

/* Отправляем email-ы */
$subj = "Запрос на информацию";
$text = "Уважаемый ".$_POST['name']."!
Спасибо за ваш интерес!
Вас интересуют ".$_POST['preference']."
Мы их распространяем бесплатно.
Обратитесь в ближайший филиал нашей компании и получите ящик этого продукта.";
mail($_POST['email'], $subj, $text);

$subj="Поступил запрос на информацию";
$text = $_POST['name']." интересовали ".$_POST['preference']." email-адрес: ".$_POST['email']; 
mail($adminaddress, $subj, $text);

/* составить запрос для вставки информации о клиенте в таблицу */
$query = "INSERT INTO $userstable VALUES('$name','$email', '$preference')";
/* Выполнить запрос. Если произойдет ошибка - вывести ее. */
mysql_query($query) or die(mysql_error());
echo "Информация о вас занесена в базу данных.";

/* Закрыть соединение */
mysql_close();
?> 
