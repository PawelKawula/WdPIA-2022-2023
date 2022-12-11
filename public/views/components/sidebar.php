<script defer>
    let small = window.innerWidth > 450 ? false : true;
    var bar = document.getElementById("bar");
    var hamburger = document.getElementById("hamburger");
    function set_category(name) {
      localStorage.setItem("category", name);
    }

    var toggled = true;
    if (!localStorage.getItem("category"))
        localStorage.setItem("category", "");
    function toggleNav(small) {
        if (toggled){
            openNav(small)
        }
        else {
            closeNav()
        }
        toggled = !toggled;
    }

    function openNav() {
        var nav = document.getElementById("mySidenav");
        hamburger.classList.toggle("hamburger_animate");
        console.log(small)
        var sidebar_width = small ? "100%" : getComputedStyle(document.documentElement)
            .getPropertyValue("--sidebar-width");
        nav.style.height = "auto";
        nav.style.width = sidebar_width;
    }

    function closeNav() {
        var nav = document.getElementById("mySidenav");
        nav.style.width = "0";
        nav.style.height = "0";
        hamburger.classList.toggle("hamburger_animate");
    }

    document.getElementById("hamburger").addEventListener("click", function () {toggleNav();});
</script>
<style>
    .sidenav {
        height: 0;
        width: 0;
        z-index: 1;
        top: 0;
        left: 0;
        background-color: #326881;
        overflow-x: hidden;
        transition: 0.3s;
        white-space: nowrap;
        text-align: center;
        font-size: 1.5em;
        align-content: center;
        display: flex;
        flex-flow: column;
        align-items: center;
    }

    .hamburger_animate {
        transform: rotate(90deg);
        animation-duration: 1s;
    }

    .sidenav a {
        padding: 0.5em 0.5em 0.5em 0.5em;
        text-decoration: none;
        font-size: 1.5em;
        color: #000000
        display: inline-block;
        transition: 0.3s;
        border: solid 2px;
        width: calc(100% - 1em);
    }
    .sidenav a:visited{
        color: #000000
    }

    .sidenav a:last-child {
        border-bottom-width: 4px
    }

    .sidenav a:first-child {
        border-top-width: 4px;
    }

    .sidenav a:hover {
        color: #f1f1f1;
    }

</style>
<div id="mySidenav" class="sidenav">
  <a href="items" onclick="set_category('')">Wszystkie</a>
  <a href="items" onclick="set_category('CPU')">CPU</a>
  <a href="items" onclick="set_category('GPU')">GPU</a>
  <a href="items" onclick="set_category('Motherboard')">Płyty Główne</a>
  <a href="items" onclick="set_category('ram')">RAM</a>
  <a href="items" onclick="set_category('case')">Obudowy</a>
  <a href="items" onclick="set_category('disk')">Dyski</a>
  <a href="items" onclick="set_category('controller')">Kontrolery</a>
</div>
