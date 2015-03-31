<?php
use lib\System;

    if (System::disSession('logedin','global') === true and System::closeSession())
	{
		echo '<meta http-equiv="refresh" content="0;url=?control=login" />';
    }
