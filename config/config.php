<?php
$config = new Letterpress\Config();

$config->addPaper(new \Letterpress\PaperSheet('Superpapier 2000', 700, 100, \Letterpress\PaperSheet::LONG_GRAIN, 0.5));
$config->addPaper(new \Letterpress\PaperSheet('Superpapier 3000', 700, 80, \Letterpress\PaperSheet::LONG_GRAIN,  0.5));
$config->addPaper(new \Letterpress\PaperSheet('Bonner Bogen', 600, 220, \Letterpress\PaperSheet::SHORT_GRAIN, 0.75));