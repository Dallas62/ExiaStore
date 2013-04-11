<?php
if(!defined('IN_STORE')) die(); //Si ca doit être un fichier inclut

/**
* \file commandAdmin.class.php
* \author Pouille Matthieu
* \brief Classe de commandes (listage de toutes les commandes, etc.)
*
* \class CommandAdmin
*/

class CommandAdmin extends Command
{
	
	/**
	* \fn public function __construct()
	* \author Pouille Matthieu 
	* \brief Constructeur
	*/
	public function __construct($ID)
	{
		parent::__construct($ID);
	}
	
	
	/**
	* \fn public function setState() 
	* \author Pouille Matthieu
	* \brief methode de modification d'etat d'une commande
	*/
	public function setState($etat)
	{
		if( $etat == 1 || $etat == 2)
		{
			global $PDO;
			$req = $PDO->prepare('UPDATE commandes 
								  SET etat_commande = :etat  
								  WHERE id_commande = :id');
			$req->bindValue(':id', $this->getID(), PDO::PARAM_INT);
			$req->bindValue(':etat', $etat, PDO::PARAM_INT);
			$req->execute();
			if( $etat == 2)
			{
				$this->setDeliveryDate();
			}
			
			$this->m_State = $etat;
		}
	}
	
	/**
	*\fn function public setDeliveryDate()
	*\author Matthieu Pouille
	*\brief methode de modification de la date de livraison
	*/
	public function setDeliveryDate()
	{
		global $PDO;
		$req = $PDO->prepare('UPDATE commandes
							  SET date_livraison = :date
							  WHERE id_commande= :id');
		$req->bindValue(':id', $this->getID(), PDO::PARAM_INT);
		$date = time();
		$req->bindValue(':date', $date, PDO::PARAM_INT);
		$req->execute();
		$this->m_DeliveryDate = $date;
	}
	
}

?>
