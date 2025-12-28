<?php
use yii\helpers\Url;
use yii\web\JqueryAsset;

$this->title = 'Connexion';

?>

<script src="js/login.js"></script>

<div class="bg-img d-flex justify-content-center align-items-center auth-bg">
    
    <div class="login-card">
        <h3 class="text-center text-primary-custom mb-4" style="font-weight: 800;">CONNEXION</h3>
            
        <div class="login-group">
            <span class="input-label text-primary-custom">Email</span>
            <div class="d-flex align-items-center">
                <span class="material-symbols-outlined text-primary-custom icon-wrapper">person</span>
                <input type="text" id="email" class="custom-input" placeholder="Votre email" autofocus>
            </div>
        </div>

        <div class="login-group">
            <span class="input-label text-success-custom">Mot de passe</span></span>
            <div class="d-flex align-items-center">
                <span class="material-symbols-outlined text-success-custom icon-wrapper">lock</span>
                <input type="password" id="pass" class="custom-input" placeholder="Votre mot de passe">
            </div>
        </div>

        <div id="error-message" class="text-danger text-center mb-3" style="display:none; font-weight: bold;"></div>

        <button type="button" class="btn-search w-100" onclick="connexion()">Se connecter</button>
        
        <div class="text-center mt-3">
            <a href="<?= Url::to(['site/signup']) ?>" class="small text-muted" style="text-decoration: none;">Pas encore de compte ? S'inscrire</a>
        </div>
    </div>
</div>