<?php
include 'views/header.php';
include 'views/footer.php';

if (!isset($pageTitle))
    $pageTitle = "";
$stylesBundle = "";
if (file_exists("views/stylesBundle.html"))
    $stylesBundle = file_get_contents("views/stylesBundle.html");

$scriptsBundle = "";
if (file_exists("views/scriptsBundle.html"))
    $scriptsBundle = file_get_contents("views/scriptsBundle.html");


echo <<<HTML
    <!DOCTYPE html>
    <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1" />
            <title>$pageTitle</title>
            $stylesBundle
            $scriptsBundle
        </head>
        <body>
            <header>
                $viewHead
            </header>
            <main>
                $content
            </main>
            <footer>
                $viewFooter
            </footer>
        </body>
    </html>
HTML;
