<?php
use yii\helpers\Url;

$this->title = 'Inscription';

?>

<script src="js/signup.js"></script>

<div class="bg-img d-flex justify-content-center align-items-center auth-bg">
    
    <div class="login-card signup-card-extended">
        <h3 class="text-center text-primary-custom mb-4" style="font-weight: 800;">INSCRIPTION</h3>
        
            
            <div class="row g-3 mb-3">
                <div class="col-6">
                    <div class="login-group mb-0">
                        <span class="input-label text-primary-custom">Nom <span class="text-danger">*</span></span>
                        <div class="d-flex align-items-center">
                            <span class="material-symbols-outlined text-primary-custom icon-wrapper">badge</span>
                            <input type="text" id="nom" class="custom-input" placeholder="Votre nom">
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="login-group mb-0">
                        <span class="input-label text-primary-custom">Prénom <span class="text-danger">*</span></span>
                        <div class="d-flex align-items-center">
                            <input type="text" id="prenom" class="custom-input" placeholder="Votre prénom">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-6">
                    <div class="login-group mb-0">
                        <span class="input-label text-primary-custom">Pseudo <span class="text-danger">*</span></span>
                        <div class="d-flex align-items-center">
                            <span class="material-symbols-outlined text-primary-custom icon-wrapper">person</span>
                            <input type="text" id="pseudo" class="custom-input" placeholder="Pseudo">
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="login-group mb-0">
                        <span class="input-label text-primary-custom">N° Permis</span>
                        <div class="d-flex align-items-center">
                            <span class="material-symbols-outlined text-primary-custom icon-wrapper">directions_car</span>
                            <input type="text" id="permis" class="custom-input" placeholder="Optionnel">
                        </div>
                    </div>
                </div>
            </div>

            <div class="login-group">
                <span class="input-label text-success-custom">Adresse Email <span class="text-danger">*</span></span>
                <div class="d-flex align-items-center">
                    <span class="material-symbols-outlined text-success-custom icon-wrapper">mail</span>
                    <input type="email" id="mail" class="custom-input" placeholder="exemple@email.com">
                </div>
            </div>

            <div class="login-group">
                <span class="input-label text-primary-custom">Photo de profil (URL) <span class="text-danger">*</span></span>
                <div class="d-flex align-items-center">
                    <span class="material-symbols-outlined text-primary-custom icon-wrapper">image</span>
                    <input type="url" id="photo" class="custom-input" placeholder="https://...">
                </div>
            </div>

            <div class="login-group">
                <span class="input-label text-success-custom">Mot de passe <span class="text-danger">*</span></span>
                <div class="d-flex align-items-center">
                    <span class="material-symbols-outlined text-success-custom icon-wrapper">lock</span>
                    <input type="password" id="pass" class="custom-input" placeholder="Votre mot de passe">
                </div>
            </div>

            <div id="error-message" class="text-danger text-center mb-2" style="display:none; font-weight: bold;"></div>

            <div class="mb-3">
                <small class="text-danger fst-italic">* Champs obligatoires</small>
            </div>

            <button type="button" class="btn-search w-100" onclick="inscrire()">S'inscrire</button>
            
            <div class="text-center mt-3">
                <button type="button" data-bs-toggle="button" onclick="requete('<?= Url::to(['site/login']) ?>')" class="small text-muted btn" style="text-decoration: none;">Déjà inscrit ? Se connecter</a>
            </div>
    </div>
</div>