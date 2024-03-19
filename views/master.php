<?php
include 'views/header.php';
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
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <link rel="stylesheet" href="./css/site.css">
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
                <div class="bg-dark py-2 text-center">
                    <p class="text-white">&copy; 2024 Chevaleresk</p>
                </div>
            </footer>
        </body>
    </html>
HTML;
