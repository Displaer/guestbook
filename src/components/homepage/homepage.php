<?php
namespace components;

use homepage\HomepageLayer;
use lib\System;

//////////////////////////////////////// M A I N /////////////////////////////////////////

    echo '<div class="jumbotron">
        <h1>' . System::getStorage('global_title_main') . '</h1>
        <h3>' . System::getStorage('global_title_second') . '</h3>
        <p>' . System::getStorage("global_slogan") . '</p>
      </div>';


    $layer = new HomepageLayer();

    // menu
    $layer->ShowMenu();

//////////////////////////////////////// M A I N /////////////////////////////////////////
