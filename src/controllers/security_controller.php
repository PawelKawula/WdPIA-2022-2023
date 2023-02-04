<?php

require_once 'app_controller.php';
require_once __DIR__.'/../models/user.php';
require_once __DIR__.'/../repository/user_repository.php';
require_once __DIR__.'/../repository/payments_repository.php';

class SecurityController extends AppController {

    private $user_repository;
    private $items_repository;
    private $payments_repository;
    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_MIME_TYPES = ["image/jpeg"];
    const UPLOAD_DIRECTORY = "/../public/img/";
    public function __construct()
    {
        parent::__construct();
        $this->user_repository = new UserRepository();
        $this->items_repository = new ItemsRepository();
        $this->payments_repository = new PaymentsRepository();
    }

    public function login() {
        session_start();
        if (!$this->is_post()) {
            return $this->render('login');
        }

        $email = $_POST['email'];
        $passwd = $_POST['passwd'];
        if ($email === "admin" && $passwd === "admin") {
            session_regenerate_id();
            $_SESSION["logged_in"] = true;
            $_SESSION["name"] = "admin";
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/admin");
        }

        $user = $this->user_repository->get_user($email);

        if ($user == null || $user->get_email() !== $email) {
            return $this->render('login', ['messages' => ['User with this email doesn\'t exist!']]);
        }

        if (!password_verify($passwd, $user->get_passwd())) {
            return $this->render('login', ['messages' => ['Wrong password!']]);
        }
        session_regenerate_id();
        $_SESSION["logged_in"] = true;
        $_SESSION["name"] = $email;
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/items");
    }

    public function logout() {
        session_start();
        session_destroy();
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/login");
    }
    public function register() {
        if (!$this->is_post()) {
            return $this->render('register');
        }
        $email = $_POST['email'];
        $passwd = password_hash($_POST['passwd'], PASSWORD_DEFAULT);
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $user = new User($email, $passwd, $fname, $lname);

        $url = "http://$_SERVER[HTTP_HOST]";

        if ($this->user_repository->get_user($email) != null)
            return $this->render('register', ["messages" => ["Użytkownik z podanym emailem już istnieje!"]]);

        if ($this->user_repository->add_user($user)) {
            header("Location: {$url}/login");
        }
        else {
            return $this->render('register', ["messages" => ["Niepowodzenie w dodawaniu użytkownika! Spróbuj ponownie"]]);
        }
    }

    public function admin() {
        session_start();
        if (!isset($_SESSION["logged_in"]) || $_SESSION["name"] != "admin") {
            return $this->redirect_to("logout");
        }
        $categories = $this->items_repository->get_categories();
        if (!$this->is_post() || isset($_POST["email"]))
            return $this->render('admin', ["categories" => $categories]);
        $category = $_POST["category"];
        $id_categories = null;
        foreach ($categories as $cat)
            if ($cat["name"] == $category)
                $id_categories = intval($cat["id_categories"]);
        if ($id_categories == null)
            $this->render('admin', ["categories" => $categories, "messages" => ["Nie istnieje taka kategoria! Dodawanie nieudane"]]);
        $quantity = intval($_POST["quantity"]);
        $name = trim($_POST["name"]);
        if (strlen($name) == 0)
            return $this->render('admin', ["categories" => $categories, "messages" => ["Nazwa nie może być pusta!"]]);
        $price = floatval($_POST["price"]);
        $desc = $_POST["desc"];
        if (!$this->validate_uploaded_file($_FILES["file"]))
            return $this->render('admin', ["categories" => $categories, "messages" => ["Podany plik jest za duzy lub nie jest typu jpeg! Dodawanie nieudane"]]);
        if (!$this->items_repository->add_item($name, $id_categories, $quantity, $price, null, $desc))
            return $this->render('admin', ["categories" => $categories, "messages" => ["Nieudane dodanie wpisu do bazy! Dodawanie nieudane"]]);
        move_uploaded_file(
            $_FILES["file"]["tmp_name"],
            dirname(__DIR__).self::UPLOAD_DIRECTORY.$name.".jpeg"
        );
            $this->render('admin', ["categories" => $categories, "messages" => ["Dodawanie udane!"]]);
    }

    public function payment() {
        session_start();
        if (!isset($_SESSION) || !isset($_SESSION["logged_in"])) {
            return $this->redirect_to("login");
        }
        if (!isset($_SESSION["name"]) || $_SESSION["name"] == "admin") {
            return $this->redirect_to("logout");
        }
        if (!$this->is_post()) {
            return $this->render('payment');
        }
        $payment_method = $_POST["payment_method"];
        $basket = json_decode($_POST["items"], true);
        $email = $_SESSION["name"];
        $payment = null;
        switch ($payment_method) {
            case "visa_mastercard":
                if (!isset($_POST["credit_card"])) return $this->render('payment', ["messages" => ["nie podano numeru karty"]]);
                if (!isset($_POST["expiration_date"])) return $this->render('payment', ["messages" => ["nie podano daty ważności"]]);
                if (!isset($_POST["cvv"])) return $this->render('payment', ["messages" => ["nie podano cvv"]]);
                $card_number = intval(str_replace(" ", "", $_POST["credit_card"]));
                $expire_date = explode("/", trim($_POST["expiration_date"]));
                $cvv = intval(trim($_POST["cvv"]));
                var_dump($cvv);
                $payment = new CardPayment($card_number, $expire_date[0], $expire_date[1], $cvv);
                break;
            case "blik":
                if (!isset($_POST["blik"])) return $this->render('payment', ["messages" => ["nie podano numeru blik!"]]);
                $blik = intval(str_replace(" ", "", $_POST["blik"]));
                $payment = new BlikPayment($blik);
                break;
            default:
                return $this->render("payment", ["messages" => ["nie obsługiwana metoda płatności!"]]);
        }
        if ($this->payments_repository->add_order($email, $payment, $basket) == true)
            return $this->render("items", ["messages" => ["Udany zakup! Zapraszamy ponownie"]]);
        else return $this->render("items", ["messages" => ["Zakup zakonczony niepowodzeniem :("]]);
    }

    private function validate_uploaded_file($file) {
        if (!is_uploaded_file($file["tmp_name"]))
            return false;
        if ($$file["size"] > self::MAX_FILE_SIZE)
            return false;
        if (!isset($file["type"]) || !in_array($file["type"], self::SUPPORTED_MIME_TYPES))
            return false;
        return true;
    }
}
