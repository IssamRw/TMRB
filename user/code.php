<?php
include('../configuration/function.php');

if(isset($_POST['saveAdmin']))
 {
 $name= validate($_POST['name']);
 $cin= validate($_POST['cin']);
 $email= validate($_POST['email']);
 $password= validate($_POST['password']);
 $phone= validate($_POST['phone']);
 $usertype= validate($_POST['usertype']);
 $is_ban= isset($_POST['is_ban']) == true ? 1:0;


 if($name != '' && $email != '' && $password != ''){

 $emailCheck = mysqli_query($conn,"SELECT * FROM `admins` WHERE email='$email'");
 if($emailCheck){
    if(mysqli_num_rows($emailCheck) > 0){
        redirect('admins-create.php', 'Email already used by another user');

    }
 }

 $bcrypt_password = password_hash($password, PASSWORD_BCRYPT);
 
 $data = [
    'name'=> $name,
    'cin'=> $cin,
    'email'=> $email,
    'password'=> $bcrypt_password,
    'phone'=> $phone,
    'usertype'=> $usertype,
    'is_ban'=> $is_ban
 ];
 $result =insert('admins',$data);
 if($result){
    redirect('admins.php','Admin Creater Successfully');
 }else{
    redirect('admins_create.php','Quelque chose s"est mal passé');
 }
  }else{
    redirect('admins-create.php','Please fi');
  }

}



if(isset($_POST['updateAdmin']))
{
    $adminId= validate($_POST['adminId']);
    $adminData= getById('admins',$adminId);
    if($adminData['status'] != 200){
        redirect('admins-edit.php?id='.$adminId,'Please fill required fields');

    }
    $name= validate($_POST['name']);
    $cin= validate($_POST['cin']);
    $email= validate($_POST['email']);
    $password= validate($_POST['password']);
    $phone= validate($_POST['phone']);
    $usertype= validate($_POST['usertype']);
    $is_ban= isset($_POST['is_ban']) == true ? 1:0;

    $bcrypt_password = password_hash($password, PASSWORD_BCRYPT);
   
    if($name != '' && $email != ''){

 $data = [
    'name'=> $name,
    'cin'=> $cin,
    'email'=> $email,
    'password'=> $bcrypt_password,
    'phone'=> $phone,
    'usertype'=> $usertype,
    'is_ban'=> $is_ban
 ];
 $result = update('admins', $adminId, $data);
 if($result){
    redirect('admins-edit.php?id='.$adminId,'Admin update Successfully');
 }else{
    redirect('admins-edit.php?id='.$adminId,'something went wrong');
 }

}else{
    redirect('admins-create.php', 'Email already used by another user');
}
}



if(isset($_POST['savecategorie']))
{
$namecategorie = validate($_POST['namecategorie']);
$description = validate($_POST['description']);
$status = isset($_POST['status']) == true ? 1:0;


$data = [
   'namecategorie'=> $namecategorie,
   'status'=> $status
];
$result =insert('categorie',$data);
if($result){
   redirect('categorie.php','categorie Creater Successfully');
}else{
   redirect('categorie-create.php','Quelque chose s"est mal passé');
}
}

if(isset($_POST['updateCategorie'])){

   $categorieId = validate($_POST['categorieId']);
   $namecategorie = validate($_POST['namecategorie']);
   $description = validate($_POST['description']);
   $status = isset($_POST['status']) == true ? 1:0;
   
   
   $data = [
      'namecategorie'=> $namecategorie,
      'description'=> $description,
      'status'=> $status
   ];
   $result =update('categorie',$categorieId,$data);
   if($result){
      redirect('categorie-edit.php?id='.$categorieId,'categorie updated Successfully');
   }else{
      redirect('categorie-edit.php?id='.$categorieId,'Quelque chose s"est mal passé');
   }
   }


   if(isset($_POST['saveproduit'])){

      $categorie_id = validate($_POST['categorie_id']);
      $nameproduit = validate($_POST['nameproduit']);
      $reference = validate($_POST['reference']);
      $description = validate($_POST['description']);
      $disponibilite = validate($_POST['disponibilite']);
      $prix = validate($_POST['prix']);
      $quantite = validate($_POST['quantite']);
      $status = isset($_POST['status']) == true ? 1:0;
      
      
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
      $result =insert('produit',$data);
      if($result){
         redirect('produit.php','produit Creater Successfully');
      }else{
         redirect('produit-add.php','Quelque chose s"est mal passé');
      }

   }

   
if(isset($_POST['updateproduit'])){


   $produit_id = validate($_POST['produit_id']);
   $produitData = getById('produit', $produit_id);
   if(!$produitData){
      redirect('produit.php','No such produit found');
   }
 
   $categorie_id = validate($_POST['categorie_id']);
   $nameproduit = validate($_POST['nameproduit']);
   $reference = validate($_POST['reference']);
   $description = validate($_POST['description']);
   $disponibilite = validate($_POST['disponibilite']);
   $prix = validate($_POST['prix']);
   $quantite = validate($_POST['quantite']);
   $status = isset($_POST['status']) == true ? 1:0;
   
   $data = [
      'nameproduit'=> $nameproduit,
      'reference'=> $reference,
      'description'=> $description,
      'disponibilite'=> $disponibilite,
      'prix'=> $prix,
      'quantite'=> $quantite,
      'status'=> $status

   ];
   $result =update('produit',$produit_id,$data);
   if($result){
      redirect('produit-edit.php?id='.$produit_id,'produit updated Successfully');
   }else{
      redirect('produit-edit.php?id='.$produit_id,'Quelque chose s"est mal passé');
   }
   }


   if(isset($_POST['saveprojet'])){

      $nameprojet = validate($_POST['nameprojet']);
      $reference = validate($_POST['reference']);
      $description = validate($_POST['description']);
      $datedebut = validate($_POST['datedebut']);
      $datefin = validate($_POST['datefin']);
      $status = isset($_POST['status']) ? 1:0;
      
      if($nameprojet !=''){
         $referenceCheck =mysqli_query($conn, "SELECT * FROM `projet` WHERE reference='$reference'");
       if($referenceCheck){
         if(mysqli_num_rows($referenceCheck) > 0){
            redirect('projet.php','projet Creater Successfully');
         }
      }
      
      $data = [
         'nameprojet'=> $nameprojet,
         'reference'=> $reference,
         'description'=> $description,
         'datedebut'=> $datedebut,
         'datefin'=> $datefin,
         'status'=> $status,
      ];
      $result =insert('projet',$data);
      if($result){
         redirect('projet.php','projet Creater Successfully');
      }else{
         redirect('projet.php','Quelque chose s"est mal passé');
      }
      }else{
         redirect('projet-create.php','Quelque chose s"est mal passé');
      }
   }



     if(isset($_POST['updateprojet'])){
      $projetId = validate($_POST['projetId']);
      $nameprojet = validate($_POST['nameprojet']);
      $reference = validate($_POST['reference']);
      $description = validate($_POST['description']);
      $datedebut = validate($_POST['datedebut']);
      $datefin = validate($_POST['datefin']);
      $status = isset($_POST['status']) ? 1:0;
      
      if($nameprojet !=''){
         $referenceCheck =mysqli_query($conn, "SELECT * FROM `projet` WHERE reference='$reference' AND id!= '$projetId'");
       if($referenceCheck){
         if(mysqli_num_rows($referenceCheck) > 0){
            redirect('projet-edit.php?id='.$projetId,'projet update Successfully');
         }
      }
      
      $data = [
         'nameprojet'=> $nameprojet,
         'reference'=> $reference,
         'description'=> $description,
         'datedebut'=> $datedebut,
         'datefin'=> $datefin,
         'status'=> $status,
      ];
      $result =update('projet',$projetId ,$data);
      if($result){
         redirect('projet-edit.php?id='.$projetId,'projet update Successfully');
      }else{
         redirect('projet-edit.php?id='.$projetId,'Quelque chose s"est mal passé');
      }
      }else{
         redirect('projet-edit.php?id='.$projetId,'Quelque chose s"est mal passé');
      }



     }
 









?>