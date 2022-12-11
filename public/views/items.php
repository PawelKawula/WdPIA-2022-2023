<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="public/css/style.css">
  <link rel="stylesheet" href="public/css/pagination.css">
  <script type="module" src="public/js/scripts.js" defer></script>
  <script type="module" src="public/js/basket.js" defer></script>
  <script type="module" src="public/js/pagination.js" defer></script>
  <script type="module" src="public/js/items.js" defer></script>
</head>
<body>
  <?php include 'components/bar.php' ?>
  <div id="content">
  <?php include 'components/sidebar.php' ?>
    <ul class="main">
      <?php if (isset($messages)) foreach ($messages as $msg) echo $msg; ?>
      <ul id="items">
      </ul>
      <nav class="pagination_container">
        <button class="pagination_button" id="prev_button" title="Previous page">
          &lt;
        </button>
        <div id="pagination_numbers">
        </div>
        <button class="pagination_button" id="next_button" title="Next page">
          &gt;
        </button>
      </nav>
    </div>
  </div>
</body>
</html>

<template id="item_template">
  <div class="buy_item">
    <div class="item_image_div">
      <img class="item_image"/>
    </div>
    <div class="item_description"">
      <div><span class="price"></span></div>
      <div><button class="store_desc"></button></div>
    </div>
  </div>
</template>