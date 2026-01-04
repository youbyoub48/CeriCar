<?php
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = 'Proposer un trajet';
?>

<script src="js/proposer.js"></script> 

<div class="bg-img d-flex justify-content-center align-items-center auth-bg">
    
    <div class="login-card signup-card-extended">
        <h3 class="text-center text-primary-custom mb-4" style="font-weight: 800;">PROPOSER UN TRAJET</h3>
        
            <div class="row g-3 mb-3">
                <div class="col-6">
                    <div class="login-group mb-0">
                        <span class="input-label text-primary-custom">Départ <span class="text-danger">*</span></span>
                        <div class="d-flex align-items-center">
                            <span class="material-symbols-outlined text-primary-custom icon-wrapper">trip_origin</span>
                            <input type="text" id="ville_depart" class="custom-input" placeholder="Ville de départ">
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="login-group mb-0">
                        <span class="input-label text-primary-custom">Arrivée <span class="text-danger">*</span></span>
                        <div class="d-flex align-items-center">
                            <span class="material-symbols-outlined text-primary-custom icon-wrapper">pin_drop</span>
                            <input type="text" id="ville_arrivee" class="custom-input" placeholder="Ville d'arrivée">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-6">
                    <div class="login-group mb-0">
                        <span class="input-label text-success-custom">Heure de départ <span class="text-danger">*</span></span>
                        <div class="d-flex align-items-center">
                            <span class="material-symbols-outlined text-success-custom icon-wrapper">schedule</span>
                            <input type="time" id="heure_depart" class="custom-input">
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="login-group mb-0">
                        <span class="input-label text-success-custom">Places dispo. <span class="text-danger">*</span></span>
                        <div class="d-flex align-items-center">
                            <span class="material-symbols-outlined text-success-custom icon-wrapper">group_add</span>
                            <input type="number" id="nb_places" class="custom-input" min="1" max="8" placeholder="Ex: 3">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-6">
                    <div class="login-group mb-0">
                        <span class="input-label text-primary-custom">Tarif (€/km/pers) <span class="text-danger">*</span></span>
                        <div class="d-flex align-items-center">
                            <span class="material-symbols-outlined text-primary-custom icon-wrapper">euro</span>
                            <input type="number" id="tarif" class="custom-input" step="0.01" placeholder="Ex: 0.25">
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="login-group mb-0">
                        <span class="input-label text-primary-custom">Bagages/pers. <span class="text-danger">*</span></span>
                        <div class="d-flex align-items-center">
                            <span class="material-symbols-outlined text-primary-custom icon-wrapper">luggage</span>
                            <input type="number" id="nb_bagages" class="custom-input" min="0" placeholder="Ex: 1">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-6">
                    <div class="login-group mb-0">
                        <span class="input-label text-success-custom">Type véhicule <span class="text-danger">*</span></span>
                        <div class="d-flex align-items-center">
                            <span class="material-symbols-outlined text-success-custom icon-wrapper">directions_car</span>
                            <select id="type_voiture" class="custom-input" style="background-color: transparent;">
                                <option value="" disabled selected>Sélectionner</option>

                                <?php foreach ($types as $type): ?>
                                <option value="<?= Html::encode($type->id) ?>"><?= Html::encode($type->typev) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="login-group mb-0">
                        <span class="input-label text-success-custom">Marque <span class="text-danger">*</span></span>
                        <div class="d-flex align-items-center">
                            <span class="material-symbols-outlined text-success-custom icon-wrapper">stars</span>
                            <select id="marque_voiture" class="custom-input" style="background-color: transparent;">
                                <option value="" disabled selected>Sélectionner</option>

                                <?php foreach ($marques as $marque): ?>
                                <option value="<?= Html::encode($marque->id) ?>"><?= Html::encode($marque->marquev) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="login-group">
                <span class="input-label text-primary-custom">Contraintes particulières</span>
                <div class="d-flex align-items-start"> 
                    <span class="material-symbols-outlined text-primary-custom icon-wrapper mt-2">info</span>
                    <textarea id="contraintes" class="custom-input" rows="3" style="padding-top: 10px; resize: none;" placeholder="Ex: Non-fumeur, animaux acceptés..."></textarea>
                </div>
            </div>

            <div class="mb-3">
                <small class="text-danger fst-italic">* Champs obligatoires</small>
            </div>

            <button type="button" class="btn-search w-100" onclick="proposer()">Publier le trajet</button>
            
            <div class="text-center mt-3">
                <button type="button" onclick="requete('<?= Url::to(['/site/voyage']) ?>')" class="small text-muted btn" style="text-decoration: none;">Annuler</button>
            </div>
    </div>
</div>