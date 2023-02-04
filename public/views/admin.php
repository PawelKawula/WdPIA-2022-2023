<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css" />
  <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.js" defer></script>
  <script src="public/js/scripts.js" type="module" defer></script>
</head>
<body class="bg-body">
<?php include 'navigation.php'?>
  <div class="card mb-3 col-10 mx-auto my-5 rounded-5">
    <div class="row g-0">
      <div class="d-none d-md-flex col-2 col-md-4 justify-content-center align-items-center text-center">
        <h4 class="card-title">Dodaj przedmiot</a></h4>
      </div>
      <div class="col-12 col-md-8">
        <div class="card-body">
          <h5 class="card-title">Dodaj przedmiot</h5>
          <form action="admin" method="POST" id="item_upload_form" enctype="multipart/form-data">
            <select name="category" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                <?php if(isset($categories)) foreach($categories as $cat) echo '<option value="'.$cat["name"].'">'.$cat["name"].'</option>';?>
            </select>
            <div class="form-floating mb-3">
              <input name="name" type="text" class="form-control" id="nameInput" placeholder="GTX 1080 Ti">
              <label for="nameInput">Nazwa</label>
            </div>
            <div class="form-floating mb-3">
              <input name="quantity" type="number" class="form-control" id="quantityInput" placeholder="2">
              <label for="quantityInput">Ilość<label>
            </div>
            <div class="form-floating mb-3">
              <input name="price" type="text" class="form-control" id="priceInput" placeholder="1999.99">
              <label for="priceInput">Cena<label>
            </div>
            <div class="input-group mb-3">
              <input name="file" type="file" class="form-control" id="inputGroupFile02">
              <label class="input-group-text" for="inputGroupFile02">Upload</label>
            </div>
            <div class="form-floating mb-3">
              <input name="desc" type="text" class="form-control" id="nameInput" placeholder="Karta Graficzna od Nvidii">
              <label for="nameInput">Opis</label>
            </div>
            <button type="submit" class="btn btn-primary float-end my-4">Dodaj</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <?php include 'modal.php'; ?>
</body>
</html>
