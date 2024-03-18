<?php
    
    $viewTitle = "Connexion";
   
    $content= <<<HTML
    
    <form method='post' action='login.php'>
        <div class="loginForm">
            <div>
                <i class="fa fa-user"></i>
                <span>
                    <input  type='text' 
                            name='Alias' 
                            required 
                            RequiredMessage='Veuillez entrer un alias'
                            InvalidMessage='Alias invalide'
                            placeholder="Alias">
                        
                </span>
                <br>
                <i class="fa fa-lock" ></i>
                <span>
                    <input  type='password' 
                            name='Password' 
                            placeholder='Mot de passe'
                            required
                            RequireMessage = 'Veuillez entrer votre mot de passe'
                            InvalidMessage = 'Mot de passe non existant' >
                </span>
                <br>
                <input type='submit' name='submit' value="Connexion" class="loginFormBtn" >
            </div>
        </div>
    </form>
    HTML;

    include "views/master.php";


