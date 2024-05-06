<?php
include('../configuration/function.php');

if(isset($_POST['saveAdmin']))
{
    // Récupération des données du formulaire
    $name= validate($_POST['name']);
    $cin= validate($_POST['cin']);
    $email= validate($_POST['email']);
    $password= validate($_POST['password']);
    $phone= validate($_POST['phone']);
    $usertype= validate($_POST['usertype']);
    $is_ban= isset($_POST['is_ban']) == true ? 1:0;

    // Vérification que les champs obligatoires sont remplis
    if($name != '' && $email != '' && $password != ''){
        // Vérification si l'email est déjà utilisé
        $emailCheck = mysqli_query($conn,"SELECT * FROM `admins` WHERE email='$email'");
        if($emailCheck){
            if(mysqli_num_rows($emailCheck) > 0){
                // Redirection avec un message d'erreur si l'email est déjà utilisé
                redirect('admins-create.php', 'L"e-mail est déjà utilisé par un autre utilisateur');
            }
        }

        // Hashage du mot de passe
        $bcrypt_password = password_hash($password, PASSWORD_BCRYPT);
        
        // Création d'un tableau de données pour l'insertion dans la base de données
        $data = [
            'name'=> $name,
            'cin'=> $cin,
            'email'=> $email,
            'password'=> $bcrypt_password,
            'phone'=> $phone,
            'usertype'=> $usertype,
            'is_ban'=> $is_ban
        ];

        // Insertion des données dans la table des administrateurs
        $result = insert('admins',$data);
        
        // Redirection avec un message de succès ou d'échec
        if($result){
            redirect('admins.php','Création de l"administrateur réussie');
        }else{
            redirect('admins_create.php','Quelque chose s"est mal passé');
        }
    }else{
        // Redirection si les champs obligatoires ne sont pas remplis
        redirect('admins-create.php','Veuillez remplir les champs obligatoires');
    }
}




if(isset($_POST['updateAdmin']))
{
    // Récupération de l'ID de l'administrateur à mettre à jour
    $adminId= validate($_POST['adminId']);
    
    // Récupération des données de l'administrateur à partir de la base de données
    $adminData= getById('admins',$adminId);
    
    // Vérification si les données de l'administrateur existent et sont valides
    if($adminData['status'] != 200){
        // Redirection avec un message d'erreur si les données ne sont pas valides
        redirect('admins-edit.php?id='.$adminId,'Veuillez remplir les champs obligatoires');
    }
    
    // Récupération des données du formulaire
    $name= validate($_POST['name']);
    $cin= validate($_POST['cin']);
    $email= validate($_POST['email']);
    $password= validate($_POST['password']);
    $phone= validate($_POST['phone']);
    $usertype= validate($_POST['usertype']);
    $is_ban= isset($_POST['is_ban']) == true ? 1:0;

    // Hashage du mot de passe
    $bcrypt_password = password_hash($password, PASSWORD_BCRYPT);
   
    // Vérification que les champs obligatoires sont remplis
    if($name != '' && $email != ''){
        // Création d'un tableau de données pour la mise à jour dans la base de données
        $data = [
            'name'=> $name,
            'cin'=> $cin,
            'email'=> $email,
            'password'=> $bcrypt_password,
            'phone'=> $phone,
            'usertype'=> $usertype,
            'is_ban'=> $is_ban
        ];
        
        // Mise à jour des données de l'administrateur dans la base de données
        $result = update('admins', $adminId, $data);
        
        // Redirection avec un message de succès ou d'échec
        if($result){
            redirect('admins-edit.php?id='.$adminId,'Mise à jour de l"administrateur réussie');
        }else{
            redirect('admins-edit.php?id='.$adminId,'Quelque chose s"est mal passé');
        }
    }else{
        // Redirection si les champs obligatoires ne sont pas remplis
        redirect('admins-create.php', 'L"adresse e-mail est déjà utilisée par un autre utilisateur');
    }
}




// Traitement du formulaire pour enregistrer une nouvelle catégorie
if(isset($_POST['savecategorie']))
{
    // Récupération des données du formulaire
    $namecategorie = validate($_POST['namecategorie']);
    $description = validate($_POST['description']);
    $status = isset($_POST['status']) == true ? 1:0;

    // Création d'un tableau de données pour l'insertion dans la base de données
    $data = [
       'namecategorie'=> $namecategorie,
       'status'=> $status
    ];
    
    // Insertion des données dans la table 'categorie' de la base de données
    $result =insert('categorie',$data);
    
    // Redirection avec un message de succès ou d'échec
    if($result){
       redirect('categorie.php','Création de la catégorie réussie');
    }else{
       redirect('categorie-create.php','Quelque chose s"est mal passé');
    }
}

// Traitement du formulaire pour mettre à jour une catégorie existante
if(isset($_POST['updateCategorie'])){

   // Récupération de l'ID de la catégorie à mettre à jour
   $categorieId = validate($_POST['categorieId']);
   
   // Récupération des données du formulaire
   $namecategorie = validate($_POST['namecategorie']);
   $description = validate($_POST['description']);
   $status = isset($_POST['status']) == true ? 1:0;
   
   // Création d'un tableau de données pour la mise à jour dans la base de données
   $data = [
      'namecategorie'=> $namecategorie,
      'description'=> $description,
      'status'=> $status
   ];
   
   // Mise à jour des données de la catégorie dans la base de données
   $result =update('categorie',$categorieId,$data);
   
   // Redirection avec un message de succès ou d'échec
   if($result){
      redirect('categorie-edit.php?id='.$categorieId,'Mise à jour de la catégorie réussie');
   }else{
      redirect('categorie-edit.php?id='.$categorieId,'Quelque chose s"est mal passé');
   }
}

// Traitement du formulaire pour enregistrer un nouveau produit
if(isset($_POST['saveproduit'])){

      // Récupération des données du formulaire
      $categorie_id = validate($_POST['categorie_id']);
      $nameproduit = validate($_POST['nameproduit']);
      $reference = validate($_POST['reference']);
      $description = validate($_POST['description']);
      $disponibilite = validate($_POST['disponibilite']);
      $prix = validate($_POST['prix']);
      $quantite = validate($_POST['quantite']);
      $status = isset($_POST['status']) == true ? 1:0;
      
      // Création d'un tableau de données pour l'insertion dans la base de données
      $data = [
         'categorie_id'=> $categorie_id,
         'nameproduit'=> $nameproduit,
         'reference'=> $reference,
         'description'=> $description,
         'disponibilite'=> $disponibilite,
         'prix'=> $prix,
         'quantite'=> $quantite,
         'status'=> $status
      ];
      
      // Insertion des données dans la table 'produit' de la base de données
      $result =insert('produit',$data);
      
      // Redirection avec un message de succès ou d'échec
      if($result){
         redirect('produit.php','Création du produit réussie');
      }else{
         redirect('produit-add.php','Quelque chose s"est mal passé');
      }

}

 // Vérifie si le formulaire de mise à jour du produit a été soumis
if(isset($_POST['updateproduit'])){

   // Récupère l'ID du produit à mettre à jour et valide les données
   $produit_id = validate($_POST['produit_id']);
   
   // Récupère les données du produit à partir de la base de données
   $produitData = getById('produit', $produit_id);
   
   // Vérifie si le produit existe dans la base de données
   if(!$produitData){
      // Redirige vers la page produit avec un message d'erreur si le produit n'existe pas
      redirect('produit.php','No such produit found');
   }

   // Récupère et valide les autres données du formulaire de mise à jour du produit
   $categorie_id = validate($_POST['categorie_id']);
   $nameproduit = validate($_POST['nameproduit']);
   $reference = validate($_POST['reference']);
   $description = validate($_POST['description']);
   $disponibilite = validate($_POST['disponibilite']);
   $prix = validate($_POST['prix']);
   $quantite = validate($_POST['quantite']);
   $status = isset($_POST['status']) == true ? 1:0;
   
   // Prépare les données mises à jour du produit
   $data = [
      'nameproduit'=> $nameproduit,
      'reference'=> $reference,
      'description'=> $description,
      'disponibilite'=> $disponibilite,
      'prix'=> $prix,
      'quantite'=> $quantite,
      'status'=> $status
   ];

   // Met à jour le produit dans la base de données
   $result = update('produit',$produit_id,$data);

   // Redirige vers la page d'édition du produit avec un message de succès ou d'échec
   if($result){
      redirect('produit-edit.php?id='.$produit_id,'Mise à jour du produit réussie');
   }else{
      redirect('produit-edit.php?id='.$produit_id,'Quelque chose s"est mal passé');
   }
}


// Vérifie si le formulaire de création d'un nouveau projet a été soumis
if(isset($_POST['saveprojet'])){

   // Récupère et valide les données du formulaire de création d'un nouveau projet
   $nameprojet = validate($_POST['nameprojet']);
   $reference = validate($_POST['reference']);
   $description = validate($_POST['description']);
   $datedebut = validate($_POST['datedebut']);
   $datefin = validate($_POST['datefin']);
   $status = isset($_POST['status']) ? 1:0;
   $acceptation = isset($_POST['acceptation']) ? 1:0;
   
   // Vérifie si le nom du projet n'est pas vide
   if($nameprojet !=''){
      // Vérifie si une référence de projet similaire existe déjà dans la base de données
      $referenceCheck = mysqli_query($conn, "SELECT * FROM `projet` WHERE reference='$reference'");
      if($referenceCheck){
         if(mysqli_num_rows($referenceCheck) > 0){
            // Redirige vers la page projet avec un message de succès si une référence de projet similaire existe
            redirect('projet.php','Création du projet réussie');
         }
      }
      
      // Prépare les données du nouveau projet
      $data = [
         'nameprojet'=> $nameprojet,
         'reference'=> $reference,
         'description'=> $description,
         'datedebut'=> $datedebut,
         'datefin'=> $datefin,
         'status'=> $status,
         'acception'=>$acceptation,
      ];

      // Insère les données du nouveau projet dans la base de données
      $result = insert('projet',$data);

      // Redirige vers la page projet avec un message de succès ou d'échec
      if($result){
         redirect('projet.php','Création du projet réussie');
      }else{
         redirect('projet.php','Quelque chose s"est mal passé');
      }
   }else{
      // Redirige vers la page de création de projet avec un message d'erreur si le nom du projet est vide
      redirect('projet-create.php','Quelque chose s"est mal passé');
   }
}


// Vérifie si le formulaire de mise à jour d'un projet a été soumis
if(isset($_POST['updateprojet'])){
   // Récupère et valide l'ID du projet à mettre à jour
   $projetId = validate($_POST['projetId']);
   
   // Récupère et valide les données du formulaire de mise à jour du projet
   $nameprojet = validate($_POST['nameprojet']);
   $reference = validate($_POST['reference']);
   $description = validate($_POST['description']);
   $datedebut = validate($_POST['datedebut']);
   $datefin = validate($_POST['datefin']);
   $status = isset($_POST['status']) ? 1:0;
   
   // Vérifie si le nom du projet n'est pas vide
   if($nameprojet !=''){
       // Vérifie si une référence de projet similaire existe déjà dans la base de données (à l'exception du projet actuel)
       $referenceCheck = mysqli_query($conn, "SELECT * FROM `projet` WHERE reference='$reference' AND id!= '$projetId'");
       if($referenceCheck){
           if(mysqli_num_rows($referenceCheck) > 0){
               // Redirige vers la page d'édition du projet avec un message de succès si une référence similaire est trouvée
               redirect('projet-edit.php?id='.$projetId,'Mise à jour du projet réussie');
           }
       }
       
       // Prépare les données mises à jour du projet
       $data = [
           'nameprojet'=> $nameprojet,
           'reference'=> $reference,
           'description'=> $description,
           'datedebut'=> $datedebut,
           'datefin'=> $datefin,
           'status'=> $status,
       ];
       
       // Met à jour le projet dans la base de données
       $result = update('projet',$projetId ,$data);
       
       // Redirige vers la page d'édition du projet avec un message de succès ou d'échec
       if($result){
           redirect('projet-edit.php?id='.$projetId,'Mise à jour du projet réussie');
       }else{
           redirect('projet-edit.php?id='.$projetId,'Quelque chose s"est mal passé');
       }
   }else{
       // Redirige vers la page d'édition du projet avec un message d'erreur si le nom du projet est vide
       redirect('projet-edit.php?id='.$projetId,'Quelque chose s"est mal passé');
   }
}




?>