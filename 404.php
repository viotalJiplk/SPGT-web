<?php

$uri = $_GET['uri'];

if (strlen($uri) == 0) {
  header('Location: /');
  die();
}
else {
    header('X-PHP-Response-Code: 404', true, 404);
}

include_once('BUILD.php');

build_page('Chyba', basename($_SERVER["SCRIPT_FILENAME"], '.php'), '

<h5 class="text-danger">Stránka nenalezena</h5>
<div class="pl-md-2">
    <p>Pokud jste URL napsali manuálně, pokuste se ji upravit do správného tvaru nebo prejděte zpět na <a href="index" title="Úvod">úvodní stránku</a>.</p>
    <div class="row">
        <label class="col-md-2" for="uri">Upravte url:</label>
        <div class="col-md-10">
            <div class="row no-gutters">
                <div class="col-11">
                    <input id="uri" class="form-control" value="'.$uri.'" />
                </div>
                <div class="pl-3 col-1 d-flex">
                    <a href="#" class="align-self-center" id="redirect" title="přesměrovat"><i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        var uri = $("input#uri").select();
        var redirect = $("#redirect").click(function (e) {
            e.preventDefault();
            window.location.href = uri.val().replace(/\/$/, "");
            return false;
        });

        $(window).keydown(function (e) {
            if (e.which === 13) {
                e.preventDefault();
                redirect.trigger("click");
            }
        });
    });
</script>

');
?>
