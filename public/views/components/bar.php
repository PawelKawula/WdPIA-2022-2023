<div id="bar">
  <div id="hamburger_div">
    <img src="public/img/hamburger.svg" id="hamburger">
  </div>
  <div id="search_div" >
    <form>
      <input type="text" placeholder="Search" name="search">
      <button type="submit"><img src="public/img/magnifier.svg"></button>
    </form>
  </div>
  <div class="login_and_basket_div">
    <div class="login_bar_div">

      <? if(isset($_SESSION) && count($_SESSION))
        echo '<p>Witaj<br>'.$_SESSION["name"].'</p><a href="logout">Wyloguj</a>';
      ?>
    </div>
    <div class="basket_div"><a href="cart"><div class="notify_badge" id="basket_count">0</div><img src="public/img/basket.svg"></a></div>
  </div>
</div>
