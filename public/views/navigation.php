<script defer>function set_category(cat) {localStorage.setItem("category", cat)}</script>
<div class="navbar navbar-expand-md navbar-dark bg-dark">
  <nav class="container-fluid d-flex" style="min-height: 30px;">
    <?php if (isset($_SESSION) && count($_SESSION) && $_SESSION != "admin")
      echo '
    <button class="navbar-toggler d-block" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" >
      <span class="navbar-toggler-icon"></span>
    </button>';
    ?>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTopContent" aria-controls="navbarTopContent">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse align-self-center justify-content-end mt-2 mt-md-0" id="navbarTopContent">
      <form class="d-flex mx-auto my-auto align-content-between">
        <input class="form-control me-2 container-fluid" type="search" name="search" placeholder="Search" aria-label="Search" size="30">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
      <div class="d-flex justify-content-between my-2">
        <a type="button" href="cart" class="btn btn-primary">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-basket" viewBox="0 0 16 16">
            <path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1v4.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 13.5V9a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h1.217L5.07 1.243a.5.5 0 0 1 .686-.172zM2 9v4.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V9H2zM1 7v1h14V7H1zm3 3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 4 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 6 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 8 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5z"></path>
          </svg>
          Cart <span class="badge rounded-pill bg-danger" id="basket_count_span">0</span>
        </a>
        <?php if (isset($_SESSION) && count($_SESSION))
          echo '
        <h5 class="text-white my-auto mx-2">
          Witaj '.$_SESSION["name"].'
        </h5>
        <a href="logout" class="btn btn-primary" tabindex="-1" role="button" id="logout_button">Wyloguj</a>';
        ?>
      </div>
    </div>
  </nav>
</div>
<div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Kategorie</h5>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3 text-center">
      <li class="nav-item bg-opacity-75 bg-secondary mb-2 rounded-2">
        <a class="nav-link active p-4" aria-current="page" href="items" onclick="set_category('')">Wszystko</a>
      </li>
      <li class="nav-item bg-opacity-75 bg-secondary mb-2 rounded-2">
        <a class="nav-link active active p-4" aria-current="page" href="items" onclick="set_category('CPU')">CPU</a>
      </li>
      <li class="nav-item bg-opacity-75 bg-secondary mb-2 rounded-2">
        <a class="nav-link active active p-4" aria-current="page" href="items" onclick="set_category('GPU')">GPU</a>
      </li>
      <li class="nav-item bg-opacity-75 bg-secondary mb-2 rounded-2">
        <a class="nav-link active active p-4" aria-current="page" href="items" onclick="set_category('Motherboard')">Płyty Główne</a>
      </li>
      <li class="nav-item bg-opacity-75 bg-secondary mb-2 rounded-2">
        <a class="nav-link active active p-4" aria-current="page" href="items" onclick="set_category('ram')">RAM</a>
      </li>
      <li class="nav-item bg-opacity-75 bg-secondary mb-2 rounded-2">
        <a class="nav-link active active p-4" aria-current="page" href="items" onclick="set_category('case')">Obudowy</a>
      </li>
      <li class="nav-item bg-opacity-75 bg-secondary mb-2 rounded-2">
        <a class="nav-link active active p-4" aria-current="page" href="items" onclick="set_category('disk')">Dyski</a>
      </li>
      <li class="nav-item bg-opacity-75 bg-secondary mb-2 rounded-2">
        <a class="nav-link active active p-4" aria-current="page" href="items" onclick="set_category('controller')">Kontrolery</a>
      </li>
    </ul>
  </div>
</div>
<script defer>
    new bootstrap.Offcanvas("#offcanvasDarkNavbar").hide()
</script>
