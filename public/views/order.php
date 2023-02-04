<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="public/css/style.css">
</head>
<body>
  <?php include 'navigation.php'; ?>
  <div class="card mb-3 col-8 mx-auto my-5 rounded-5">
    <div class="row g-0">
      <div class="bg-info d-flex align-items-center col-md-4 text-center">
        <h4 class="card-title">Logowanie lub <a href="register">Rejestracja</a></h4>
      </div>
      <div class="col-md-8 bg-secondary">
        <div class="card-body">
          <h5 class="card-title">Logowanie</h5>
          <form action="order" method="POST" id="payment_form">
            <div class="form-floating mb-3">
              <input name="fname" type="text" class="form-control" id="floatingFName" placeholder="name@example.com">
              <label for="floatingFName">Imię</label>
            </div>
            <div class="form-floating">
              <input name="lname" type="text" class="form-control" id="floatingLName" placeholder="Doe">
              <label for="floatingLName">Nazwisko</label>
            </div>
            <div class="form-floating">
              <input name="telephone" type="text" class="form-control" id="floatingTelephone" placeholder="123456789">
              <label for="floatingTelephone">Telephone</label>
            </div>
            <button type="submit" class="btn btn-primary float-end my-4" disabled>Adres</button>
            <button type="submit" class="btn btn-primary float-end my-4">Zrealizuj</button>
          </form>
        </div>
      </div>
    </div>
  <?php include 'modal.php' ?>
</body>
</html>
