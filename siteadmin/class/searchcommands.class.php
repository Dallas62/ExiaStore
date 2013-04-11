<?php
if(!defined('IN_STORE')) die(); //Si ca doit être un fichier inclut

/**
* \file commandSearch.class.php
* \author Pouille Matthieu
* \brief Classe de commandes (listage de toutes les commandes, etc.)
*
* \class CommandAdmin
*/

class SearchCommands
{
	/**
	* \fn public function searchCommands()
	* \author Pouille Matthieu 
	* \brief fonction qui recherche des commandes par id, nom de membre et prenom de membre
	*
	* \return tableau de commandes
	*/
	public function searchCommandsByIDNameFirstName($id, $name, $firstname)
	{
	    global $PDO;
		$SQL = 'SELECT id_commande FROM commandes INNER JOIN membres ON commandes.id_membre = membres.id_membre WHERE id_commande = :id';
		
		if(!empty($name))
		{
			$SQL .= ' OR membres.nom_membre LIKE :name';
		}
		if(!empty($firstname))
		{
			$SQL .= ' OR membres.prenom_membre LIKE :firstname';
		}
		$req = $PDO->prepare($SQL);
		$req->bindValue(':id', $id, PDO::PARAM_INT);
		if(!empty($name))
		{
			$req->bindValue(':name', '%'.$name.'%', PDO::PARAM_STR);
		}
		if(!empty($firstname))
		{
			$req->bindValue(':firstname', '%'.$firstname.'%', PDO::PARAM_STR);
		}
		$req->execute();
		
		$commands = array();
		while($result = $req->fetch())
		{
			$commands[]= new Command($result['id_commande']);
		}
		return $commands;
	}
	
	
	/**
	* \fn public function searchCommandsByState()
	* \author Pouille Matthieu 
	* \brief recherche les commandes selon leur etat
	*
	* \return tableau de commandes
	*/
	public function searchCommandsByState($etat) //etat = 0 pour en préparation, 1 pour prête à envoyer, 2 pour envoyée
	{
	    global $PDO;
		if( $etat >= 0 )
        {
			
            $req = $PDO->prepare('SELECT id_commande, date_commande, adresse_facturation, date_livraison, membres.nom_membre, membres.prenom_membre
								  FROM commandes INNER JOIN membres ON commandes.id_membre = membres.id_membre
								  WHERE etat_commande = :etat ');
            $req->bindValue(':etat', $etat, PDO::PARAM_INT);
            $req->execute();
			
			$commandes = array();
            while($result = $req->fetch())
            {
                $commands[]= new Command($result['id_commande']);
            }
			
			return $commands;
        }
	}	
}

?>
