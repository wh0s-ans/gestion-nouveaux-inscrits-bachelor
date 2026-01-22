<?php

/*
|--------------------------------------------------------------------------
| GUIDE DE TEST DE L'APPLICATION
|--------------------------------------------------------------------------
|
| Ce fichier décrit comment tester toutes les fonctionnalités
| de l'application "Gestion des Nouveaux Inscrits en Bachelor"
|
*/

return [
    'tests' => [
        'authentification' => [
            'connexion' => [
                'url' => '/login',
                'email' => 'admin@gestion-inscrits.local',
                'password' => 'password',
                'expected_redirect' => '/tableau-de-bord',
            ],
            'deconnexion' => [
                'url' => '/logout',
                'expected_redirect' => '/login',
            ],
        ],

        'tableau_de_bord' => [
            'url' => '/tableau-de-bord',
            'authenticated_required' => true,
            'elements' => [
                'total_etudiants',
                'etudiants_valides',
                'etudiants_en_attente',
                'etudiants_rejetes',
                'chartStatut', // Diagramme circulaire
                'chartFiliere', // Diagramme en barres
                'chartMensuel', // Courbe temporelle
                'chartAnnee', // Histogramme
            ],
        ],

        'gestion_etudiants' => [
            'liste' => [
                'url' => '/etudiants',
                'authenticated_required' => true,
                'elements' => [
                    'pagination',
                    'recherche',
                    'filtre_filiere',
                    'filtre_statut',
                    'btn_ajouter',
                ],
            ],

            'ajouter' => [
                'url' => '/etudiants/create',
                'authenticated_required' => true,
                'form_fields' => [
                    'nom' => 'Exemple Nom',
                    'prenom' => 'Exemple Prenom',
                    'cne' => 'CNE1234567890',
                    'cin' => 'AB123456',
                    'date_naissance' => '1998-01-15',
                    'email' => 'etudiant@exemple.com',
                    'telephone' => '+212612345678',
                    'filiere' => 'Licence Informatique',
                ],
                'expected_redirect' => '/etudiants/show/{id}',
            ],

            'voir_details' => [
                'url' => '/etudiants/{id}',
                'authenticated_required' => true,
                'elements' => [
                    'nom',
                    'prenom',
                    'cne',
                    'cin',
                    'email',
                    'filiere',
                    'statut',
                    'btn_modifier',
                    'btn_supprimer',
                ],
            ],

            'modifier' => [
                'url' => '/etudiants/{id}/edit',
                'authenticated_required' => true,
                'testable_fields' => [
                    'nom',
                    'prenom',
                    'email',
                    'statut',
                ],
                'expected_redirect' => '/etudiants/{id}',
            ],

            'supprimer' => [
                'url' => '/etudiants/{id}',
                'authenticated_required' => true,
                'method' => 'DELETE',
                'expected_redirect' => '/etudiants',
                'expected_message' => 'L\'étudiant a été supprimé',
            ],
        ],

        'recherche_et_filtrage' => [
            'recherche_par_nom' => [
                'url' => '/etudiants?recherche=Ahmed',
                'authenticated_required' => true,
            ],
            'recherche_par_email' => [
                'url' => '/etudiants?recherche=ahmed@exemple.com',
                'authenticated_required' => true,
            ],
            'filtre_par_filiere' => [
                'url' => '/etudiants?filiere=Licence+Informatique',
                'authenticated_required' => true,
            ],
            'filtre_par_statut' => [
                'url' => '/etudiants?statut=Validé',
                'authenticated_required' => true,
            ],
            'filtre_combine' => [
                'url' => '/etudiants?filiere=Licence+Informatique&statut=Validé&recherche=Ahmed',
                'authenticated_required' => true,
            ],
        ],

        'validations_formulaires' => [
            'email_unique' => [
                'expected_error' => 'Cet email existe déjà',
            ],
            'cne_unique' => [
                'expected_error' => 'Ce CNE existe déjà',
            ],
            'cin_unique' => [
                'expected_error' => 'Cette CIN existe déjà',
            ],
            'champs_requis' => [
                'expected_error' => 'requis',
            ],
        ],

        'securite' => [
            'routes_non_authentifiees' => [
                'tableau_de_bord' => '/tableau-de-bord',
                'etudiants_list' => '/etudiants',
                'etudiants_create' => '/etudiants/create',
            ],
            'protection_csrf' => [
                'formulaire' => 'form',
                'required_field' => '@csrf',
            ],
            'redirections' => [
                'utilisateur_auth_vers_login' => '/login -> /tableau-de-bord',
                'utilisateur_guest_vers_dashboard' => '/tableau-de-bord -> /login',
            ],
        ],
    ],

    'donnees_test' => [
        'total_etudiants' => 100,
        'etudiants_par_statut' => [
            'Validé' => 33,
            'En attente' => 33,
            'Rejeté' => 34,
        ],
        'filieres' => [
            'Licence Informatique',
            'Licence Gestion',
            'Licence Droit',
            'Licence Langues',
            'Licence Sciences',
        ],
    ],

    'performance' => [
        'pagination_par_page' => 15,
        'max_recherche_results' => null, // Sans limite
        'cache_duration_minutes' => 60,
    ],

    'navegation' => [
        'menu_principal' => [
            'Tableau de bord' => '/tableau-de-bord',
            'Étudiants' => '/etudiants',
            'Ajouter un étudiant' => '/etudiants/create',
        ],
        'actions_rapides' => [
            'Voir détails' => 'btn-info',
            'Modifier' => 'btn-warning',
            'Supprimer' => 'btn-danger',
        ],
    ],
];
