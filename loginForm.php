<?php
    
    $viewTitle = "Connexion";
    $errorMessage = "";
    if (isset($_GET['error'])) {
        $error = $_GET['error'];
        if ($error == "passwordFailed")
            $errorMessage = "Le mot de passe n'est pas correct";
        if ($error == "usernameNotExists")
            $errorMessage = "L'alias n'est pas correct";
    }
    $content= <<<HTML
    
    <form method='post' action='login.php'>
        <div class="loginForm">
            <div>
                <i class="fa fa-user"></i>
                <span>
                    <input  type='text' 
                            name='alias' 
                            required 
                            RequiredMessage='Veuillez entrer un alias'
                            InvalidMessage='Alias invalide'
                            placeholder="Alias">
                        
                </span>
                <br>
                <i class="fa fa-lock" ></i>
                <span>
                    <input  type='password' 
                            name='motDePasse' 
                            placeholder='Mot de passe'
                            required
                            RequireMessage = 'Veuillez entrer votre mot de passe'
                            InvalidMessage = 'Mot de passe non existant' >
                </span>
                <br>
                <input type='submit' name='submit' value="Connexion" class="loginFormBtn" >
                <p class="text-danger errorMessage">$errorMessage</p>
            </div>
        </div>
    </form>
HTML;

    include "views/master.php";