<?php

shell_exec("nohup php bomb.php '".$argv[1] ."' > output.log 2>&1 &");