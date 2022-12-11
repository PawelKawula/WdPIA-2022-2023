<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="public/css/style.css">
</head>
<body>

  <?php include 'components/bar.php'?>

  <div id="content">
  <?php include 'components/sidebar.php' ?>

    <div class="main security_main">
      <div class="prompt">Dodaj przedmiot</div>
      <div class="security_box">
        <form class="login" action="admin" method="POST" id="item_upload_form" enctype="multipart/form-data">
          <?php if (isset($messages)) foreach($messages as $msg) echo $msg; else echo 'no msg'?>
          <div>kategoria
            <select name="category" id="category_select">
              <?php if(isset($categories)) foreach($categories as $cat) echo '<option value="'.$cat[name].'">'.$cat["name"].'</option>'; else echo 'xd';?>
            </select>
          </div>
          <div>nazwa<input name="name" type="text"></div>
          <div>ilość<input name="quantity" type="number"></div>
          <div>kwota<input name="price" type="number"></div>
          <div>zdjęcie<input type="file" name="file"></div>
          <div>opis<textarea name="desc" rows="5"></textarea></div>
          <button type="submit">Dodaj</button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
