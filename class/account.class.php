<?php
if(!defined('IN_STORE')) die(); // Si le fichier doit être inclut

/**
* \file account.class.php
* \author Beddiaf Mehdi
* \brief Classe Membre
*
* \class Account
*/

class Account
{
    private $m_ID; // identifiant du membre
	private $m_Name = ''; //  Nom du membre
	private $m_FirstName = ''; // Prénom du membre
	private $m_Login = 'Visiteur'; // Login du membre
	private $m_Mail = ''; // Mail du membre
	private $m_Adress = ''; // Adresse du membre
	private $m_Birthday; // Date de Naissance du membre
	private $m_RegisterDay; // Date d'inscription du membre
	private $m_Right = 0; // Droit du membre
	private $m_City = ''; // Ville du membre
	private $m_CP = 0;
	private $m_Country = ''; // Pays du membre
    private $m_Connected = false; // état de connexion du membre
    
	/**
	* \fn public function getID()
	* \author Beddiaf Mehdi
	* \brief getter ID
	*
	* \return ID du compte membre
	*/
	
    public function getID()
    {
        return $this->m_ID;
    }
    
	/**
	* \fn public function getHTMLName()
	* \author Beddiaf Mehdi
	* \brief getter Nom du membre en convertissant tous les caractères éligibles en entités HTML
	*
	* \return Nom du membre
	*/
    public function getHTMLName()
    {
        return htmlentities($this->m_Name);
    }

	/**
	* \fn public function getName()
	* \author Beddiaf Mehdi
	* \brief getter Nom du membre 
	*
	* \return Nom du membre
	*/
    public function getName()
    {
        return $this->m_Name;
    }

	/**
	* \fn public function getHTMLFirstName()
	* \author Beddiaf Mehdi
	* \brief getter Prénom du membre en convertissant tous les caractères éligibles en entités HTML
	*
	* \return Prénom du membre
	*/
    public function getHTMLFirstName()
    {
        return htmlentities($this->m_FirstName);
    }

	/**
	* \fn public function getFirstName()
	* \author Beddiaf Mehdi
	* \brief getter Prénom du membre 
	*
	* \return Prénom du membre
	*/
    public function getFirstName()
    {
        return $this->m_FistName;
    }
	
	/**
	* \fn public function getHTMLLogin()
	* \author Beddiaf Mehdi
	* \brief getter Login du membre en convertissant tous les caractères éligibles en entités HTML
	*
	* \return Login du membre
	*/
    public function getHTMLLogin()
    {
        return htmlentities($this->m_Login);
    }

	/**
	* \fn public function getLogin()
	* \author Beddiaf Mehdi
	* \brief getter Login du membre 
	*
	* \return Login du membre
	*/
    public function getLogin()
    {
        return $this->m_Login;
    }
	
	/**
	* \fn public function getHTMLMail()
	* \author Beddiaf Mehdi
	* \brief getter Mail du membre en convertissant tous les caractères éligibles en entités HTML
	*
	* \return Mail du membre
	*/
    public function getHTMLMail()
    {
        return htmlentities($this->m_Mail);
    }

	/**
	* \fn public function getMail()
	* \author Beddiaf Mehdi
	* \brief getter Mail du membre 
	*
	* \return Mail du membre
	*/
    public function getMail()
    {
        return $this->m_Mail;
    }
	
	/**
	* \fn public function getHTMLAdress()
	* \author Beddiaf Mehdi
	* \brief getter Adresse du membre en convertissant tous les caractères éligibles en entités HTML
	*
	* \return Adresse du membre
	*/
    public function getHTMLAdress()
    {
        return htmlentities($this->m_Adress);
    }

	/**
	* \fn public function getAdress()
	* \author Beddiaf Mehdi
	* \brief getter Adresse du membre 
	*
	* \return Prénom du membre
	*/
    public function getAdresse()
    {
        return $this->m_Adresse;
    }
	
	/**
	* \fn public function getBirthday()
	* \author Beddiaf Mehdi
	* \brief getter Date de naissance du membre 
	*
	* \return Date de naissance du membre
	*/
    public function getBirthday()
    {
        return $this->m_Birthday;
    }
	
	/**
	* \fn public function getRegisterday()
	* \author Beddiaf Mehdi
	* \brief getter Date d'inscription du membre 
	*
	* \return Date d'inscription du membre
	*/
    public function getRegisterday()
    {
        return $this->m_RegisterDay;
    }
	
	/**
	* \fn public function getRight()
	* \author Beddiaf Mehdi
	* \brief getter Droit du membre 
	*
	* \return Droit du membre
	*/
    public function getRight()
    {
        return $this->m_Right;
    }
	
	/**
	* \fn public function getHTMLCity()
	* \author Beddiaf Mehdi
	* \brief getter Ville du membre en convertissant tous les caractères éligibles en entités HTML
	*
	* \return Ville du membre
	*/
    public function getHTMLCity()
    {
        return htmlentities($this->m_City);
    }

	/**
	* \fn public function getCity()
	* \author Beddiaf Mehdi
	* \brief getter Ville du membre 
	*
	* \return Ville du membre
	*/
    public function getCity()
    {
        return $this->m_City;
    }
	
	/**
	* \fn public function getCP()
	* \author Beddiaf Mehdi
	* \brief getter CP
	*
	* \return Code Postal du compte membre
	*/
	
    public function getCP()
    {
        return $this->m_CP;
    }
	
	/**
	* \fn public function getHTMLCountry()
	* \author Beddiaf Mehdi
	* \brief getter Pays du membre en convertissant tous les caractères éligibles en entités HTML
	*
	* \return Pays du membre
	*/
    public function getHTMLCountry()
    {
        return htmlentities($this->m_Country);
    }

	/**
	* \fn public function getCountry()
	* \author Beddiaf Mehdi
	* \brief getter Pays du membre 
	*
	* \return Pays du membre
	*/
    public function getCountry()
    {
        return $this->m_Country;
    }
	
	/**
	* \fn public function getConnected()
	* \author Beddiaf Mehdi
	* \brief getter de l'état de connexion
	*
	* \return l'état de connexion du membre
	*/
    public function getConnected()
    {
        return $this->m_Connected;
    }
    
	/**
	* \fn public function getCommandslist()
	* \author Beddiaf Mehdi
	* \brief getter de la liste des commandes du client 
	*
	* \return un tableau de commandes du client
	*/
	public function getCommandslist()
	{
		global $PDO;
		$list = array(); // list va contenir la liste des commandes avec ID, 
		
		$req = $PDO->prepare('SELECT id_commande, date_commande, date_livraison, etat_commande  FROM commandes WHERE id_membre = :id');
        $req->bindValue(':id', $this->m_ID, PDO::PARAM_INT);
		$req->execute();
		$i = 0;
        while($result = $req->fetch())
        {
            $list[$i]['id'] 			= $result['id_commande'];
			$list[$i]['date_commande']	= $result['date_commande'];
			$list[$i]['date_delivery'] 	= $result['date_livraison'];
			$list[$i]['etat'] 			= $result['etat_commande'];
			$i ++;
        }
		
		return $list;
	}
	
	/**
	* \fn public function __construct($ID = 0)
	* \author Beddiaf Mehdi
	* \brief constructeur de membre
	*
	* \param $ID du membre 
	*/
    public function __construct($ID = 0)
    {
        global $PDO;
        if($ID == 0 && isset($_SESSION['ID']))
        {
            $ID = $_SESSION['ID'];
        }
        if($ID > 0)
        {
            $req = $PDO->prepare('SELECT id_membre, nom_membre, prenom_membre, login, mail, adresse, date_naissance, date_inscription, droit, villes.nom_ville, villes.cp_ville, pays.nom_pays 
								  FROM membres INNER JOIN villes ON membres.id_ville=villes.id_ville INNER JOIN pays ON villes.id_pays=pays.id_pays
								  WHERE id_membre = :id');
            $req->bindValue(':id', $ID, PDO::PARAM_INT);
            $req->execute();
            if($result = $req->fetch())
            {
                $this->m_Name 			= $result['nom_membre'];
				$this->m_FirstName 		= $result['prenom_membre'];
				$this->m_Login 			= $result['login'];
				$this->m_Mail 			= $result['mail'];
				$this->m_Adress 		= $result['adresse'];
				$this->m_Birthday 		= $result['date_naissance'];
				$this->m_RegisterDay 	= $result['date_inscription'];
				$this->m_Right 			= $result['droit'];
				$this->m_City 			= $result['nom_ville'];
				$this->m_CP				= $result['cp_ville'];
				$this->m_Country 		= $result['nom_pays'];
                if(isset($_SESSION['ID']) AND $ID == $_SESSION['ID'])$this->m_Connected = true;
            }
        }
        $this->m_ID = $ID;
    }
    
	 
	/**
	* \fn public function add($m_name, $m_FirstName, $m_Login, $m_Mail, $m_Adress, $m_Birthday, $m_RegisterDay, $m_Right, $m_City, $m_Country, $Pwd)
	* \author Beddiaf Mehdi
	* \brief ajout d'un membre
	*
	* \param $Login login du membre
	* \param $Pwd mot de passe du membre
	*
	* \return True si membre ajouté, False si membre existant 
	*/
    public function add($Name, $FirstName, $Login, $Mail, $Adress, $Birthday, $RegisterDay, $Right, $City, $CP, $Country, $Pwd)
    {
        global $PDO;
        $req = $PDO->prepare('SELECT id_membre FROM membres WHERE login = :login');
        $req->bindValue(':login', $Login);
        $req->execute();
        if($result = $req->fetch())
        {
            return false;
        }
        else
        {
			$IDVille = 0;
			$IDPays = 0;
			$reqSelectVille = $PDO->prepare('SELECT id_ville FROM villes WHERE nom_ville LIKE :nom_ville');
			$reqSelectVille->bindValue(':nom_ville', $City);
			$reqSelectVille->execute();
			if ($result = $reqSelectVille->fetch())
			{
				$IDVille = $result['id_ville'];// on recupere l'ID de la ville
			}
			else
			{
				$reqSelectPays = $PDO->prepare('SELECT id_pays FROM pays WHERE nom_pays LIKE :nom_pays');
				$reqSelectPays->bindValue(':nom_pays', $Country );
				$reqSelectPays->execute();
				if ($result = $reqSelectPays->fetch())
				{
					$IDPays = $result['id_pays'];
				}
				else
				{
					$req = $PDO->prepare('INSERT INTO pays SET nom_pays = :nom_pays');
					$req->bindValue(':nom_pays', $Country );
					$req->execute();
					$reqSelectPays->execute();
					if ($result = $reqSelectPays->fetch())
					{
						$IDPays=$result['id_pays'];
					}	
				}
				$req = $PDO->prepare('INSERT INTO villes SET nom_ville = :nom_ville, cp_ville = :cp_ville, id_pays = :id_pays');
				$req->bindValue(':nom_ville', $City);
				$req->bindValue(':cp_ville', $CP);
				$req->bindValue(':id_pays', $IDPays);
				$req->execute();
				$reqSelectVille->execute();
				if ($result = $reqSelectVille->fetch())
				{
					$IDVille=$result['id_ville'];// on recupere l'ID de la ville
				}
			}
            $req = $PDO->prepare('INSERT INTO membres SET nom_membre = :nom, prenom_membre = :prenom, login = :login, mail = :mail, adresse = :adresse, date_naissance = :date_naissance, date_inscription= :date_inscription, droit = :droit, id_ville = :id_ville, mdp = :mdp');
            $req->bindValue(':nom', $Name);
			$req->bindValue(':prenom', $FirstName);
			$req->bindValue(':login', $Login);
			$req->bindValue(':mail', $Mail);
			$req->bindValue(':adresse', $Adress);
			$req->bindValue(':date_naissance', $Birthday);
			$req->bindValue(':date_inscription', $RegisterDay);
			$req->bindValue(':droit', $Right);
			$req->bindValue(':id_ville', $IDVille);
            $req->bindValue(':mdp', sha1($Pwd));
            $req->execute();
            return true;
        }
    }
    
	/**
	* \fn public function add($m_name, $m_FirstName, $m_Login, $m_Mail, $m_Adress, $m_Birthday, $m_City, $m_Country, $Pwd)
	* \author Beddiaf Mehdi
	* \brief modification d'un membre
	*
	* \param $Login login du membre
	* \param $Pwd mot de passe du membre
	*
	* \return True si membre modifier, False si membre non modifié 
	*/
    public function update($Mail, $Adress, $City, $CP, $Country, $Pwd)
    {
        global $PDO;
		
			$IDVille = 0;
			$IDPays = 0;
			$reqSelectVille = $PDO->prepare('SELECT id_ville FROM villes WHERE nom_ville LIKE :nom_ville');
			$reqSelectVille->bindValue(':nom_ville', $City);
			$reqSelectVille->execute();
			if ($result2 = $reqSelectVille->fetch())
			{
				$IDVille = $result2['id_ville'];// on recupere l'ID de la ville
			}
			else
			{
				$reqSelectPays = $PDO->prepare('SELECT id_pays FROM pays WHERE nom_pays LIKE :nom_pays');
				$reqSelectPays->bindValue(':nom_pays', $Country );
				$reqSelectPays->execute();
				if ($result = $reqSelectPays->fetch())
				{
					$IDPays = $result['id_pays'];
				}
				else
				{
					$req = $PDO->prepare('INSERT INTO pays SET nom_pays = :nom_pays');
					$req->bindValue(':nom_pays', $Country );
					$req->execute();
					$reqSelectPays->execute();
					if ($result2 = $reqSelectPays->fetch())
					{
						$IDPays=$result2['id_pays'];
					}	
				}
				$req = $PDO->prepare('INSERT INTO villes SET nom_ville = :nom_ville, cp_ville = :cp_ville, id_pays = :id_pays');
				$req->bindValue(':nom_ville', $City);
				$req->bindValue(':cp_ville', $CP);
				$req->bindValue(':id_pays', $IDPays);
				$req->execute();
				$reqSelectVille->execute();
				if ($result = $reqSelectVille->fetch())
				{
					$IDVille=$result['id_ville'];// on recupere l'ID de la ville
				}
			}
			if(empty($Pwd))
			{
				$req = $PDO->prepare('UPDATE membres SET mail = :mail, adresse = :adresse, id_ville = :id_ville WHERE id_membre = :id_membre');
				
				$req->bindValue(':mail', $Mail);
				$req->bindValue(':adresse', $Adress);
				$req->bindValue(':id_ville', $IDVille);           
				$req->bindValue(':id_membre', $this->getId());
				
				$req->execute();
			}
			else
			{
				$req = $PDO->prepare('UPDATE membres SET mail = :mail, adresse = :adresse, id_ville = :id_ville, mdp = :mdp WHERE id_membre = :id_membre');
				
				$req->bindValue(':mail', $Mail);
				$req->bindValue(':mdp', sha1($Pwd));
				$req->bindValue(':adresse', $Adress);
				$req->bindValue(':id_ville', $IDVille);           
				$req->bindValue(':id_membre', $this->getId());
				
				$req->execute();
			} 
			$this->m_Adress = $Adress;
			$this->m_Mail = $Mail;
			$this->m_City = $City;
			$this->m_Mail = $Mail;
			$this->m_Country = $Country;
			$this->m_CP = $CP;
			
               return true;
    }
	
	/**
	* \fn public function connect($Login, $Pwd)
	* \author Beddiaf Mehdi
	* \brief connexion d'un membre
	*
	* \param $Login login du membre
	* \param $Pwd mot de passe du membre
	*
	* \return True si connexion du membre réussi, False si connexion du membre échoué  
	*/
    public function connect($Login, $Pwd)
    {
        global $PDO;
        $req = $PDO->prepare('SELECT id_membre, mdp FROM membres WHERE login = :login');
        $req->bindValue(':login', $Login);
        $req->execute();
        if($result = $req->fetch())
        {
            if(sha1($Pwd) == $result['mdp'])
            {
				$req = $PDO->prepare('SELECT id_membre, nom_membre, prenom_membre, login, mail, adresse, date_naissance, date_inscription, droit, villes.nom_ville, pays.nom_pays 
									  FROM membres INNER JOIN villes ON membres.id_ville=villes.id_ville INNER JOIN pays ON villes.id_pays=pays.id_pays
								      WHERE id_membre = :id');
				$req->bindValue(':id', $result['id_membre'], PDO::PARAM_INT);
				$req->execute();
				if($result = $req->fetch())
				{
					$this->m_ID				= $result['id_membre'];
					$this->m_Name 			= $result['nom_membre'];
					$this->m_FirstName 		= $result['prenom_membre'];
					$this->m_Login 			= $result['login'];
					$this->m_Mail 			= $result['mail'];
					$this->m_Adress 		= $result['adresse'];
					$this->m_Birthday 		= $result['date_naissance'];
					$this->m_RegisterDay 	= $result['date_inscription'];
					$this->m_Right 			= $result['droit'];
					$this->m_City 			= $result['nom_ville'];
					$this->m_Country 		= $result['nom_pays'];
					$this->m_Connected = true;
					$_SESSION['ID'] = $this->getID();
					return true;
				}
            }
        }
		return false;
    }
    
	/**
	* \fn public function disconnect()
	* \author Beddiaf Mehdi
	* \brief déconnecte d'un membre
	*
	*/
    public function disconnect()
    {
        session_destroy();
		$this->m_ID; // identifiant du membre
		$this->m_Name = ''; //  Nom du membre
		$this->m_FirstName = ''; // Prénom du membre
		$this->m_Login = 'Visiteur'; // Login du membre
		$this->m_Mail = ''; // Mail du membre
		$this->m_Adress = ''; // Adresse du membre
		$this->m_Birthday; // Date de Naissance du membre
		$this->m_RegisterDay; // Date d'inscription du membre
		$this->m_Right = 0; // Droit du membre
		$this->m_City = ''; // Ville du membre
		$this->m_Country = ''; // Pays du membre
		$this->m_Connected = false; // état de connexion du membre
    }
}
?>
