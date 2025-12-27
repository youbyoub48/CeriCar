<?php
use app\assets\AppAsset;
use yii\web\JqueryAsset;
/** @var yii\web\View $this */

$this->title = 'CeriCar';

$this->registerJsFile(
    '@web/js/recherche.js',
    ['depends' => [JqueryAsset::class]]
);
?>

<div class="site-index">
    <div class="bg-img d-flex justify-content-center align-items-center">
        
        <div class="search-card d-flex align-items-center justify-content-between">
            
            <div class="search-group d-flex flex-column">
                <span class="input-label text-primary-custom">Départ</span>
                <div class="d-flex align-items-center">
                    <span class="material-symbols-outlined text-primary-custom icon-wrapper">location_on</span>
                    <input id="depart" type="text" class="custom-input" placeholder="D'où partez-vous ?">
                </div>
            </div>

            <div class="search-group d-flex flex-column">
                <span class="input-label text-success-custom">Arrivée</span>
                <div class="d-flex align-items-center">
                    <span class="material-symbols-outlined text-success-custom icon-wrapper">location_on</span>
                    <input id="arrivee" type="text" class="custom-input" placeholder="Où allez-vous ?">
                </div>
            </div>

            <div class="search-group d-flex flex-column" style="flex-grow: 0.5;">
                <span class="input-label text-primary-custom">Passagers</span>
                <div class="d-flex align-items-center">
                    <span class="material-symbols-outlined text-primary-custom icon-wrapper">group</span>
                    <input id="personnes" type="number" min="1" max="10" value="1" class="custom-input">
                </div>
            </div>

            <div class="ps-3">
                <button class="btn-search" onclick="rechercher()">Rechercher</button>
            </div>

        </div>
    </div>
    <div id="result"></div>
</div>