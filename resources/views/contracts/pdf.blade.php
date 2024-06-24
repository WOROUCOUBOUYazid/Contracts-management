<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrat de Prestation de Service</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    {{-- <link href="{{ asset('`css/app.css') }}" rel="stylesheet"> --}}
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <div class="container mx-auto my-8 p-8 bg-white shadow-md rounded-lg">

        <div class="mb-4">
            <p class="mt-"px>ANNEE 2023/ N°...</p>

            <h1 class="text-3xl font-bold my-96 text-center">Contrat de Prestation de Service au nom de Monsieur ……………………….</h1>

        </div>

        <div class="mb-4">
            <h1 class="text-2xl font-bold underline text-center">Contrat de Prestation de Service</h1>
            <h2 class="text-xl font-semibold">ENTRE</h2>
            <p>Agence Nationale pour la Transfusion Sanguine (ANTS)</p>
            <p>sise à Saint-Michel, en face de l'école Saint Augustin, à Cotonou,</p>
            <p>Téléphone : +229  21 32 04 35</p>
            <p>Email : info@ants.com.</p>
            <p>Représentée par Dr Ourou Bagou YOROU CHABI,</p>
            <p>Agissant au nom et pour le compte de l'ANTS</p>
            <p>Désignée ci-après « l’employeur » ;</p>
        </div>

        <div class="mb-4">
            <h2 class="text-xl font-semibold">ET</h2>
            <p>NOM ET PRENOMS : {{$contract->serviceProvider->user->firstname}} {{$contract->serviceProvider->user->lastname}} </p>
            <p>DATE ET LIEU DE NAISSANCE : le {{$contract->serviceProvider->birth_date}} à {{$contract->serviceProvider->birth_place}} </p>
            <p>NATIONALITE : Béninoise</p>
            <p>LIEU DE RESIDENCE : {{$contract->serviceProvider->residence_place}} </p>
            <p>ADRESSE : {{$contract->serviceProvider->adress}} </p>
            <p>Tél : {{$contract->serviceProvider->user->phone}} </p>
            <p>E-mail : {{$contract->serviceProvider->user->email}} </p>
            <p>SITUATION MATRIMONIALE : {{$contract->serviceProvider->marital_status}} </p>
            <p>NOMBRE D’ENFANTS : {{$contract->serviceProvider->children_number}} </p>
            <p>TITRE : {{$contract->title}}</p>
            <p>Désigné ci-après « LE PRESTATAIRE » ;</p>
            <p>Qui déclare être libre de tout engagement,</p>
        </div>

        <div class="mb-4">
            <h2 class="text-xl font-semibold">Préambule</h2>
            <ol class="list-decimal list-inside">
                <li>L’Agence Nationale pour la Transfusion Sanguine (ANTS) est la structure chargée d’assurer la disponibilité du sang et des produits sanguins pour les services de santé au Bénin...</li>
                <li>Les Services de Transfusion Sanguine (STS) ont pour mission : la promotion du don de sang ; le recrutement des donneurs de sang au niveau départemental ; la collecte de sang ; la rétro-information vers les structures sanitaires posant l’acte transfusionnel...</li>
                <li>Dans l’accomplissement de cette mission, le STS/Zou connait des périodes d’accroissement d’activités qui nécessitent le recrutement de travailleurs à titre temporaire...</li>
                <li>La signature d’un contrat de prestation de service avec Monsieur …Y…… pour le poste de Gardien s’inscrit dans le cadre de la gestion du surcroit d’activités au niveau du Service de Transfusion Sanguine Zou.</li>
            </ol>
        </div>

        <div class="mb-4">
            <h2 class="text-xl font-semibold"><span class="underline">Article 1</span> : Objet</h2>
            <p>Par le présent contrat, Monsieur {{$contract->serviceProvider->user->firstname}} {{$contract->serviceProvider->user->lastname}} s’engage à exercer en qualité de prestataire de service les fonctions de Gardiennage pour le compte de l’Agence Nationale pour la Transfusion Sanguine (ANTS) qui accepte.</p>
        </div>

        <div class="mb-4">
            <h2 class="text-xl font-semibold"><span class="underline">Article 2</span> : Lieu d’exécution de la prestation</h2>
            <p>L’exécution de la prestation de services se fera dans les locaux du Service de Transfusion Sanguine Zou. Le prestataire sera aussi appelé à se rendre en tout lieu où l’employeur aura besoin de ses services.</p>
        </div>

        <div class="mb-4">
            <h2 class="text-xl font-semibold"><span class="underline">Article 3</span> : Durée du contrat</h2>
            <p>La durée du contrat est de six (06) mois. Le contrat prend effet à compter du 1er janvier 2023 pour finir le 30 juin 2023.</p>
        </div>

        <div class="mb-4">
            <h2 class="text-xl font-semibold"><span class="underline">Article 4</span> : Fonctions</h2>
            <p>Durant la période de référence, le prestataire exercera sous le contrôle du Chef Service Transfusion Sanguine Zou les fonctions de Gardiennage des locaux du siège de la Transfusion Sanguine...</p>
            <ul class="list-disc list-inside">
                <li>assurer la sécurité des locaux, maintenir l’ordre, protéger contre le vol, le feu, le vandalisme</li>
                <li>rechercher et signaler les dangers d’incendie</li>
                <li>alerter la police, les sapeurs-pompiers et l’ambulance au besoin</li>
                <li>faire des rondes périodiques pour inspecter les zones et pour relever toute anomalie</li>
                <li>veiller à la propreté de l’immeuble</li>
                <li>exécuter toutes les autres tâches à lui confiées par son supérieur hiérarchique</li>
            </ul>
        </div>

        <div class="mb-4">
            <h2 class="text-xl font-semibold"><span class="underline">Article 5</span> : Obligations</h2>
            <p>Le prestataire s’engage à :</p>
            <ul class="list-disc list-inside">
                <li>s’acquitter avec zèle, loyauté et fidélité des travaux ou missions qui lui seront confiés</li>
                <li>respecter les horaires de travail convenus avec l’administration sur proposition du supérieur hiérarchique</li>
                <li>exercer ses fonctions conformément à la déontologie du métier</li>
                <li>ne faire aucune déclaration orale ou écrite aux médias ou à toute autre personne physique ou morale qui violerait le secret professionnel</li>
                <li>ne pas se rendre coupable d’actes répréhensibles tels que : rançonnement des usagers, bagarre sur les lieux de travail, violence sur les usagers, état d’ivresse caractérisé, vol de matériels, négligence du travail, retards ou absences répétés</li>
            </ul>
        </div>

        <div class="mb-4">
            <h2 class="text-xl font-semibold"><span class="underline">Article 6</span> : Suivi et Evaluation</h2>
            <p>Dans l’exécution du présent contrat, l’agent prestataire fera l’objet d’une évaluation professionnelle mensuelle par son supérieur hiérarchique...</p>
        </div>

        <div class="mb-4">
            <h2 class="text-xl font-semibold"><span class="underline">Article 7</span>: Rémunération</h2>
            <p>La rémunération du prestataire de service sera calculée et liquidée mensuellement sur la base des forfaits ci-après :</p>
            <ul class="list-disc list-inside">
                <li>Permanence jours ouvrables de 08h à 19h un montant forfaitaire de mille cinq cents (1500) FCFA</li>
                <li>Garde de 19 h à 08h. un montant forfaitaire de deux mille cinq cents (2500) FCFA</li>
                <li>En dehors des forfaits de prestation, il sera alloué au prestataire un forfait mensuel de dix mille (10.000) francs CFA pour les déplacements</li>
            </ul>
            <p>La rémunération mensuelle globale subira la retenue obligatoire à la source, prévue par les dispositions en vigueur (AIB). Elle sera d’un maximum de soixante-douze mille cinq cent (72 500) F CFA y compris les forfaits de déplacement.</p>
            <p>La rémunération du prestataire de service est imputée sur les ressources du budget autonome de l’ANTS.</p>
        </div>

        <div class="mb-4">
            <h2 class="text-xl font-semibold"><span class="underline">Article 8</span> : Modalité de paiement</h2>
            <p>Le paiement se fera mensuellement à la Direction Générale de l’Agence Nationale pour la Transfusion Sanguine (ANTS) par virement dès la date 05 du mois suivant sur la base de la facture produite par l’agent prestataire et de l’attestation de service fait établie par le supérieur hiérarchique.</p>
        </div>

        <div class="mb-4">
            <h2 class="text-xl font-semibold"><span class="underline">Article 9</span> : Règlement des différends</h2>
            <p>En cas de litige, la partie plaignante avise par écrit son contractant pour porter à sa connaissance ses griefs. Les parties pourront régler le litige à l’amiable...</p>
        </div>

        <div class="mb-4">
            <h2 class="text-xl font-semibold"><span class="underline">Article 10</span> : Des sanctions</h2>
            <p>Comme tous les agents des services publics, le prestataire peut être sanctionné en cas de légèreté, retard, absence, incompétences constatés ...etc.</p>
            <p>L’affaire sera portée devant le CODIR qui déterminera le type de sanction à infliger. La sanction peut aller de la suspension à la résiliation du contrat ou la perte de tous les avantages liés à la prestation.</p>
        </div>

        <div class="mb-4">
            <h2 class="text-xl font-semibold"><span class="underline">Article 11</span>: Renouvellement du contrat</h2>
            <p>Le présent contrat est renouvelable au plus une fois, sur demande manuscrite rédigée par le prestataire et visée par le supérieur hiérarchique un (01) mois avant le terme du contrat.</p>
        </div>

        <div class="mb-4">
            <h2 class="text-xl font-semibold"><span class="underline">Article 12</span> : Résiliation</h2>
            <p>Le présent contrat pourra être résilié dans les conditions ci-après :</p>
            <ul class="list-disc list-inside">
                <li>abandon de poste</li>
                <li>à l’échéance du terme</li>
                <li>par accord des parties à condition que la démission ou la cessation de la prestation soit constatée par écrit un mois avant</li>
                <li>malversation ou faute lourde (désinvolture, négligence, absence)</li>
                <li>en cas de force majeure</li>
            </ul>
        </div>

        <div class="mb-4">
            <h2 class="text-xl font-semibold"><span class="underline">Article 13</span>: Dispositions Diverses</h2>
            <p>Pour tout ce qui n’est pas prévu au présent contrat, les parties s’en remettent aux dispositions législatives, réglementaires ou conventionnelles en vigueur.</p>
        </div>

        <p>Fait et établi en trois (03) exemplaires originaux à Cotonou, le ...................................</p>

        <div class="w-100 flex justify-between px-8 mt-8">
            <div class="h-28 flex flex-col justify-between">
                <p>Lu et approuvé <br>
                Le Prestataire</p>
                <p>{{$contract->serviceProvider->user->firstname}} {{$contract->serviceProvider->user->lastname}}</p>
            </div>
            <div class="h-28 flex flex-col justify-between">
                <p>Pour l’employeur, <br>
                    le Directeur Général</p>
                <p>Dr Ourou Bagou YOROU CHABI</p>
            </div>
        </div>
    </div>
</body>
</html>
