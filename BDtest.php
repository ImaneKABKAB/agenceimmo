<?php
try{
    $con= new PDO("mysql:host=localhost;port=3306;dbname=agenceimmo",'root','');
    $con->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e){
    echo "error due to ".$e->getMessage();
}
//CRUD POUR ADMIN
function checkAdmin($a,$b){
    global $con;
    $sql="SELECT * FROM admin WHERE login=? AND password=?";
    $query=$con->prepare($sql);
    $query->bindParam(1,$a);
    $query->bindParam(2,$b);
    $query->execute();
    $res=$query->fetchAll();
    if($res)
    return true;
    else return false;
   
}
function getAdmins(){
    global $con;
    $sql="SELECT * FROM admin ";
    $res=$con->query($sql);
    $resultat=$res->fetchAll();
    return $resultat;
}
function getAdmin($pass){
    global $con;
    $sql="SELECT prenom FROM admin WHERE password=?";
    $res=$con->prepare($sql);
    $res->execute(array($pass));
    $resultat=$res->fetch();
    return $resultat;
}
function deleteAdmin($pass){
    global $con;
    $sql='DELETE FROM admin WHERE pass = ? ';
    $res=$con->prepare($sql);
    $res->bindParam(1,$pass,PDO ::PARAM_STR);
    $res->execute();
}
function addupdateAD($pre,$nom,$log,$pass){
    global $con;
    $sql="SELECT * FROM admin WHERE prenom=? AND nom=?";
    $query=$con->prepare($sql);
    $query->execute(array($pass));
    $res=$query->fetch();
    if($res){
        $sqlt="UPDATE admin SET login=? , pass=? WHERE prenom=? AND nom=?";
        $querry=$con->prepare($sqlt);
        $resl=$querry->execute(array($log,$pass,$pre,$nom));
        return $resl;
    }
    else{
        $sqlt="INSERT INTO admin(prenom,nom,login,pass,password) VALUES (?,?,?,?,?)";
        $querry=$con->prepare($sqlt);
        $resl=$querry->execute(array($pre,$nom,$log,$pass,sha1($pass)));
        return $resl;
    }
}

//CRUD POUR CLIENTS
function getClients(){
    global $con;
    $sql="SELECT * FROM clients";
    $res=$con->query($sql);
    $val= $res->fetchAll(PDO::FETCH_ASSOC);
    return $val;
}
function deleteClient($a){
    global $con;
    $sql='DELETE FROM clients WHERE CNI = ? ';
    $res=$con->prepare($sql);
    $res->bindParam(1,$a,PDO ::PARAM_STR);
    $res->execute();
}
function addupdateCl($code,$nom,$adr,$gnd,$mail,$tel){
    global $con;
    $sql="SELECT * FROM clients WHERE CNI=?";
    $query=$con->prepare($sql);
    $query->execute(array($code));
    $res=$query->fetch();
    if($res){
        $sqlt="UPDATE clients SET nom=?, adresse=?, genre=?, mail=?, tel=? WHERE CNI=?";
        $querry=$con->prepare($sqlt);
        $resl=$querry->execute(array($nom,$adr,$gnd,$mail,$tel,$code));
        return $resl;
    }
    else{
        $sqlt="INSERT INTO clients(CNI,nom,adresse,genre,mail,tel) VALUES (?,?,?,?,?,?)";
        $querry=$con->prepare($sqlt);
        $resl=$querry->execute(array($code,$nom,$adr,$gnd,$mail,$tel));
        return $resl;
    }
}
//CRUD POUR BIENS
function deleteBien($adr){
    global $con;
    $sql='DELETE FROM biens WHERE adresse = ? ';
    $res=$con->prepare($sql);
    $res->bindParam(1,$adr,PDO ::PARAM_STR);
    $res->execute();
}
function getBiens(){
    global $con;
    $sql="SELECT type,adresse,ville,superficie,nbr_chambre,prix_men,path FROM biens";
    $res=$con->query($sql);
    $val= $res->fetchAll(PDO::FETCH_ASSOC);
    return $val;
}
function addupdateBn($type,$adr,$ville,$sup,$nbr,$prix,$path){
    global $con;
    $sql="SELECT * FROM biens WHERE adresse=?";
    $query=$con->prepare($sql);
    $query->execute(array($adr));
    $res=$query->fetch();
    if($res){
        $sqlt="UPDATE biens SET type=?, ville=?, superficie=?, nbr_chambre=?, prix_men=?, path=? WHERE adresse=?";
        $querry=$con->prepare($sqlt);
        $resl=$querry->execute(array($type,$ville,$sup,$nbr,$prix,$path,$adr));
        return $resl;
    }
    else{
        $sqlt="INSERT INTO biens(type,adresse,ville,superficie,nbr_chambre,prix_men,path) VALUES (?,?,?,?,?,?,?)";
        $querry=$con->prepare($sqlt);
        $resl=$querry->execute(array($type,$adr,$ville,$sup,$nbr,$prix,$path));
        return $resl;
    }
}

//CRUD POUR LOCATIONS
function getLocations(){
    global $con;
    $sql="SELECT CNI,adresse,date,de,a,duree,prix FROM locations";
    $res=$con->query($sql);
    $val= $res->fetchAll(PDO::FETCH_ASSOC);
    return $val;
}
function deleteLocation($code){
    global $con;
    $sql='DELETE FROM locations WHERE CNI = ? ';
    $res=$con->prepare($sql);
    $res->bindParam(1,$code,PDO ::PARAM_STR);
    $res->execute();
}
function getPrix($adresse){
    global $con;
    $sql="SELECT prix_men FROM biens WHERE adresse=?";
    $query=$con->prepare($sql);
    $query->execute(array($adresse));
    $res=$query->fetch();
    return $res;
}
function addupdateL($code,$adr,$date,$de,$a,$duree,$prix){
    global $con;
    $sql="SELECT * FROM locations WHERE adresse=? AND de=? AND a=?";
    $query=$con->prepare($sql);
    $query->execute(array($adr,$de,$a));
    $res=$query->fetch();
    if($res){
        return 0;
     }

    $req="SELECT * FROM locations WHERE CNI=? AND adresse=?";
    $requete=$con->prepare($req);
    $requete->execute(array($code,$adr));
    $resultat=$requete->fetch();
    if($resultat){
    $sqlt="UPDATE locations SET date=?, de=?, a=? WHERE CNI=? AND adresse=?";
    $querry=$con->prepare($sqlt);
    $resl=$querry->execute(array($date,$de,$a,$code,$adr));
    return $resl;
    }
    
    $state="SELECT * FROM locations WHERE CNI=? AND de=? AND a=?";
    $proc=$con->prepare($state);
    $proc->execute(array($code,$de,$a));
    $sol=$proc->fetch();
    if($sol){
    $ques="UPDATE locations SET adresse=?, date=? WHERE CNI=? AND de=? AND a=? ";
    $process=$con->prepare($ques);
    $ret=$process->execute(array($adr,$date,$code,$de,$a));
    return $ret;
    }
    else{
        $sqle="INSERT INTO locations(CNI,adresse,date,de,a,duree,prix) VALUES (?,?,?,?,?,?,?)";
        $quer=$con->prepare($sqle);
        $resu=$quer->execute(array($code,$adr,$date,$de,$a,$duree,$prix));
        return $resu;
    }
}
//FONCTION POUR EXPORTATION DES DONNEES EN FORMAT CSV
function exportCSV($name,$tab){
     header("Content-type: text/csv");
     header("Content-Disposition: attachment; filename=$name");
     header("Content-Discription: File Transfer");
     header("Content-Transfer-Encoding: binary");
        $fup=fopen($name,"w");
        fclose($fup);
        $y=implode(",",array_keys($tab[0]));
        file_put_contents($name,$y."\n");
        foreach($tab as $ligne){
            $v=implode(",",$ligne);
            file_put_contents($name,$v."\n",FILE_APPEND);
        }
     readfile($name);
     exit; 
        }
//CRUD POUR DEMANDES DE LOCATIONS
function insertDemande($name,$mail,$tel,$text){
    global $con;
    $sql="INSERT INTO demandes(nom_complet,mail,tel,text) VALUES (?,?,?,?)";
    $query=$con->prepare($sql);
    $query->execute(array($name,$mail,$tel,$text));
}
function getDemandes(){
    global $con;
    $query=$con->query("SELECT * FROM demandes WHERE statut=0");
    $res=$query->fetchAll();
    return $res;
}
function updateDemandes(){
    global $con;
    $sql="UPDATE demandes SET statut=1 WHERE statut=0";
    $con->exec($sql);
}
function deleteDemandes(){
    global $con;
    $sql='DELETE FROM demandes WHERE statut=1 ';
    $con->exec($sql);
}
//CRUD POUR PROPOSITIONS DE VENTE
function insertPropositon($name,$mail,$tel,$type,$adresse){
        global $con;
        $sql="INSERT INTO propositions(nom_complet,mail,tel,type,addr_bien) VALUES (?,?,?,?,?)";
        $query=$con->prepare($sql);
        $query->execute(array($name,$mail,$tel,$type,$adresse));
}
function getPropositions(){
    global $con;
    $query=$con->query("SELECT * FROM propositions WHERE statut=0");
    $res=$query->fetchAll();
    return $res;
}
function updatePropositions(){
    global $con;
    $sql="UPDATE propositions SET statut=1 WHERE statut=0";
    $con->exec($sql);
}
function deletePropositions(){
    global $con;
    $sql='DELETE FROM propositions WHERE statut=1';
    $con->exec($sql);
}
