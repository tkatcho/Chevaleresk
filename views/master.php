<?php

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
            <title>Chevaleresk - $title</title>
            $stylesBundle
            $scriptsBundle
        </head>
        <body>
            <header>
                <h2>Chevaleresk - $title</h2>
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
