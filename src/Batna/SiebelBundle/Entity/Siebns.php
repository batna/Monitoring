<?php

namespace Batna\SiebelBundle\Entity;

use Batna\SiebelBundle\Entity\Gateway;
use Batna\SiebelBundle\Entity\Enterprise;
use Batna\SiebelBundle\Entity\Server;
use Batna\SiebelBundle\Entity\NamedSubsystem;
use Batna\SiebelBundle\Entity\Component;
use Batna\SiebelBundle\Entity\ComponentGroup;

class Siebns
{
	private $file;
	private $contenuStatique;
	private $contenuCourant;
	private $gateway;
	
	/**
	 * Renseigne le nom complet du fichier siebns
	 * @param string $file
	 */
	
	public function setFile($file)
	{
		if(is_file($file))
		{
			$this->file = $file;
			$this->contenuStatique = file_get_contents($this->file);
			$this->contenuCourant = substr($this->contenuStatique, strlen($this->getFirstBlock()));
			if($this->isSiebnsType())
			{
				return true;
			}
			
		}
		return false;
	}
	
	/**
	 * Renvoie un boolean indiquand si la chaine de caractere est de type correspondant à un fichier siebns
	 * @param string $contenu
	 */
	private function isSiebnsType()
	{
		if($this->getFirstLine($this->getFirstBlock()) == 'Siebel Name Server Backing File')
		{
			return true;
		}
		else
		{
			return false;
		}
		
	}
	
	private function hasFile()
	{
		return (is_file($this->file));
	}
	
	public function getFile()
	{
		return $this->file;
	}
	
	public function getContenuStatique()
	{
		return $this->contenuStatique;
	}
	
	private function updateContenuCourant()
	{
		$this->contenuCourant = substr($this->contenuCourant, 2);
		$this->contenuCourant = strstr($this->contenuCourant, '[/');
		return true;
	}
	
	public function getContenuCourant()
	{
		return $this->contenuCourant;
	}
	
	private function setContenuCourant($contenuCourant)
	{
		$this->contenuCourant = $contenuCourant;
	}
	
	public function getBlock()
	{
		$block = new Block();
		$fin = strpos(substr($this->getContenuCourant(), 2), '[/');
		$block->setContent(substr($this->getContenuCourant(), 0, $fin));
		$this->updateContenuCourant();
		
		if($this->getContenuCourant()!='')
				return $block;
		else return false;
	}
	
	public function getFirstBlock()
	{
		return substr($this->contenuStatique, 0, strpos($this->contenuStatique, '[/]'));
	}
	
	public function getFirstLine($content)
	{
		return substr($content, 0, (strpos($this->getContenuStatique(), "\n")-1));
	}
	
	public function setGateway($gateway)
	{
		$this->gateway = $gateway;
	}
	
	public function getGateway()
	{
		return $this->gateway;
	}
	
	public function execute($em)
	{
		$start = microtime(true);
	
		$max = 5000;
		
		$blocks_total = 0;
		$blocks_utiles = 0;
		
		$rendu = '';
		
		$gtw=$this->gateway;
		
		$es = new Enterprise();
		$ss = new Server();
		$cg = new ComponentGroup();
		$cp = new Component();
		$ns = new NamedSubsystem();

		while(false != ($block = $this->getBlock()) && $blocks_total<$max)
		{
			$blocks_total++;
			
			$block_backup = $block;
			
			if($block->getValue()!=null)
			{
				$blocks_utiles++;
				
				//$rendu .= $blocks_total.' : "'.$block->getHauteur().'" => "'.$block->getVariable().'" : "'.$block->getValue().'"'."\n";
				
				switch($block->getHauteur())
				{
					case '/es/version':
					{
						$es = $this->checkES($em, $gtw, $es, $block->getES());
						$es->setVersion($block->getValue());
						$em->persist($es);
						break;
					}
					case '/es/ns/def':
					{
						$es = $this->checkES($em, $gtw, $es, $block->getES());
						$ns = $this->checkNS($em, $es, $ns, $block->getNS());
						
						switch($block->getVariable())
						{
							case 'name':				{$ns->setName($block->getValue());			break;}
							case 'description':			{$ns->setDescription($block->getValue());	break;}
							case 'full name':			{$ns->setFullname($block->getValue());		break;}
							case 'enable state':		{$ns->setEnableState($block->getValue());	break;}
							case 'subsystem name':		{$ns->setSubsystemName($block->getValue());	break;}
							case 'object id':			{$ns->setObjectId($block->getValue());		break;}
						}
						$em->persist($ns);
						break;
					}
					case '/es/ns/param':
					{
						$es = $this->checkES($em, $gtw, $es, $block->getES());
						$ns = $this->checkNS($em, $es, $ns, $block->getNS());
						$ns->addParameter(array($block->getVariable(), $block->getValue()));
						$em->persist($ns);
						break;
					}
					case '/es/cl/cp':
					{
						$es = $this->checkES($em, $gtw, $es, $block->getES());
						$es->addComponent(array($block->getVariable(), $block->getValue()));
						$em->persist($es);
						break;
					}
					case '/es/def':
					{
						$es = $this->checkES($em, $gtw, $es, $block->getES());
						switch($block->getVariable())
						{
							case 'name':				{$es->setName($block->getValue());			break;}
							case 'description':			{$es->setDescription($block->getValue());	break;}
							case 'full name':			{$es->setFullname($block->getValue());		break;}
							case 'enable state':		{$es->setEnableState($block->getValue());	break;}
							case 'signature':			{$es->setSignature($block->getValue());		break;}
							case 'object id':			{$es->setObjectId($block->getValue());		break;}
						}
						$em->persist($es);
						break;
					}
					case '/es/ss/ver':
					{
						$es = $this->checkES($em, $gtw, $es, $block->getES());
						$ss = $this->checkSS($em, $es, $ss, $block->getSS());
						$ss->setVersion($block->getValue());
						$em->persist($ss);
						break;
					}
					case '/es/ss/def':
					{
						$es = $this->checkES($em, $gtw, $es, $block->getES());
						$ss = $this->checkSS($em, $es, $ss, $block->getSS());
						switch($block->getVariable())
						{
							case 'name':				{$ss->setName($block->getValue());			break;}
							case 'description':			{$ss->setDescription($block->getValue());	break;}
							case 'full name':			{$ss->setFullname($block->getValue());		break;}
							case 'enable state':		{$ss->setEnableState($block->getValue());	break;}
							case 'object id':			{$ss->setObjectId($block->getValue());		break;}
						}
						$em->persist($ss);						
						break;
					}
					case '/es/ss/evt':
					{
						$es = $this->checkES($em, $gtw, $es, $block->getES());
						$ss = $this->checkSS($em, $es, $ss, $block->getSS());
						$ss->setEventLog($block->getValue());
						$em->persist($ss);
						break;
					}
					case '/es/ss/cg/def':
					{
						$es = $this->checkES($em, $gtw, $es, $block->getES());
						$ss = $this->checkSS($em, $es, $ss, $block->getSS());
						$cg = $this->checkCGByServer($em, $ss, $cg, $block->getCG());
						switch($block->getVariable())
						{
							case 'enable state':		{$cg->setEnableState($block->getValue());		break;}
							case 'status':				{$cg->setStatus($block->getValue());			break;}
						}
						$em->persist($cg);
						break;
					}
					case '/es/ss/cg/cp/def':
					{
						$es = $this->checkES($em, $gtw, $es, $block->getES());
						$ss = $this->checkSS($em, $es, $ss, $block->getSS());
						$cg = $this->checkCGByServer($em, $ss, $cg, $block->getCG());
						$cp = $this->checkCP($em, $cg, $cp, $block->getCP());
						switch($block->getVariable())
						{
							case 'start mode':			{$cp->setStartMode($block->getValue());			break;}
							case 'enable state':		{$cp->setEnableState($block->getValue());		break;}
							case 'status':				{$cp->setStatus($block->getValue());			break;}
						}
						$em->persist($cp);
						break;
					}
					case '/es/ss/cg/cp/param':
					{
						$es = $this->checkES($em, $gtw, $es, $block->getES());
						$ss = $this->checkSS($em, $es, $ss, $block->getSS());
						$cg = $this->checkCGByServer($em, $ss, $cg, $block->getCG());
						$cp = $this->checkCP($em, $cg, $cp, $block->getCP());
						$cp->addParameter(array($block->getVariable(), $block->getValue()));
						$em->persist($cp);
						break;
					}
					case '/es/ss/cg/cp/cs':
					{
						$es = $this->checkES($em, $gtw, $es, $block->getES());
						$ss = $this->checkSS($em, $es, $ss, $block->getSS());
						$cg = $this->checkCGByServer($em, $ss, $cg, $block->getCG());
						$cp = $this->checkCP($em, $cg, $cp, $block->getCP());
						$cp->setConnectString($block->getValue());
						$em->persist($cp);
						break;
					}
					case '/es/ss/param':
					{
						$es = $this->checkES($em, $gtw, $es, $block->getES());
						$ss = $this->checkSS($em, $es, $ss, $block->getSS());
						$ss->addParameter(array($block->getVariable(), $block->getValue()));
						$em->persist($ss);
						break;
					}
					case '/es/ss/attr':
					{
						$es = $this->checkES($em, $gtw, $es, $block->getES());
						$ss = $this->checkSS($em, $es, $ss, $block->getSS());
						$ss->addAttribute(array($block->getVariable(), $block->getValue()));
						$em->persist($ss);
						break;
					}
					case '/es/cg/def':
					{
						$es = $this->checkES($em, $gtw, $es, $block->getES());
						$cg = $this->checkCGByEnterprise($em, $es, $cg, $block->getCG());
						switch($block->getVariable())
						{
							case 'enable state':		{$cg->setEnableState($block->getValue());		break;}
							case 'status':				{$cg->setStatus($block->getValue());			break;}
							case 'object id':			{$cg->setObjectId($block->getValue());			break;}
						}
						$em->persist($cg);
						break;
					}
					case '/es/cg/cp/def':
					{
						$es = $this->checkES($em, $gtw, $es, $block->getES());
						$cg = $this->checkCGByEnterprise($em, $es, $cg, $block->getCG());
						$cp = $this->checkCP($em, $cg, $cp, $block->getCP());
						switch($block->getVariable())
						{
							case 'start mode':			{$cp->setStartMode($block->getValue());			break;}
							case 'enable state':		{$cp->setEnableState($block->getValue());		break;}
							case 'status':				{$cp->setStatus($block->getValue());			break;}
							case 'object id':			{$cp->setObjectId($block->getValue());			break;}
						}
						$em->persist($cp);
						break;
					}
					case '/es/cg/cp/param':
					{
						$es = $this->checkES($em, $gtw, $es, $block->getES());
						$cg = $this->checkCGByEnterprise($em, $es, $cg, $block->getCG());
						$cp = $this->checkCP($em, $cg, $cp, $block->getCP());
						$cp->addParameter(array($block->getVariable(), $block->getValue()));
						$em->persist($cp);
						break;
					}
					case '/es/cg/cp/fxparam':
					{
						$es = $this->checkES($em, $gtw, $es, $block->getES());
						$cg = $this->checkCGByEnterprise($em, $es, $cg, $block->getCG());
						$cp = $this->checkCP($em, $cg, $cp, $block->getCP());
						switch($block->getVariable())
						{
							case 'ConfigFile':			{$cp->setConfigFile($block->getValue());			break;}
							case 'ServiceName':			{$cp->setServiceName($block->getValue());			break;}
							case 'NamedDataSource':		{$cp->setNamedDataSource($block->getValue());		break;}
							case 'DataSource':			{$cp->setDataSource($block->getValue());			break;}
						}
						$em->persist($cp);
						break;
					}
					case '/es/param':
					{
						$es = $this->checkES($em, $gtw, $es, $block->getES());
						$es->addParameter(array($block->getVariable(), $block->getValue()));
						$em->persist($es);
						break;
					}
					case '/es/attr':
					{
						$es = $this->checkES($em, $gtw, $es, $block->getES());
						switch($block->getVariable())
						{
							case 'DatabasePlatform':	{$es->setDatabasePlatform($block->getValue());		break;}
							case 'UseMSStored':			{$es->setUseMSStored($block->getValue());;			break;}
							case 'DatabaseConnStr':		{$es->setDatabaseConStr($block->getValue());		break;}
							case 'Description':			{$es->setAttrDescription($block->getValue());		break;}
						}
						$em->persist($es);
						break;
					}
					case '/es/seq':
					{
						$es = $this->checkES($em, $gtw, $es, $block->getES());
						switch($block->getVariable())
						{
							case 'named subsystem sequence':	{$es->setNamedSubsystemSequence($block->getValue());	break;}
							case 'component sequence':			{$es->setComponentSequence($block->getValue());			break;}
							case 'component group sequence':	{$es->setComponentGroupSequence($block->getValue());	break;}
							case 'server sequence':				{$es->setServerSequence($block->getValue());			break;}
						}
						$em->persist($es);
						break;
					}
					case '/gtw/ver':
					{
						$gtw->setVersion($block->getValue());
						$em->persist($gtw);
						break;
					}
					case '/gtw/def':
					{
						switch($block->getVariable())
						{
							case 'name':				{$gtw->setName($block->getValue());			break;}
							case 'description':			{$gtw->setDescription($block->getValue());	break;}
							case 'full name':			{$gtw->setFullName($block->getValue());		break;}
							case 'enable state':		{$gtw->setEnableState($block->getValue());	break;}
							case 'object id':			{$gtw->setObjectId($block->getValue());		break;}
						}
						$em->persist($gtw);
						break;
					}
					case '/gtw/attr':
					{
						switch($block->getVariable())
						{
							case 'CreateDefault':		{$gtw->setCreateDefault($block->getValue());break;}
							case 'UseDefault':			{$gtw->setUseDefault($block->getValue());	break;}
						}
						$em->persist($gtw);
						break;
					}
				}
				$em->flush();
			}
			else
			{
				//$rendu .= $blocks_total.' : Bloc inutile : '.$block->getTitre()."\n";
			}
		}
		
		// DEBUT DEBUG
		
		// FIN DEBUG
				
		$end = microtime(true);
		$time = $end-$start;
		$rendu = '*** Temps total d\'execution pour '.$blocks_utiles.' blocks utiles parmis '.$blocks_total.' blocks : '.round($time, 2).' secondes ***'."\n\n".$rendu;
		return $rendu;
	}
	
	private function checkES($em, Gateway $gtw, Enterprise $es, $esString)
	{
		if($es_id = $gtw->getEnterpriseIdByName($esString))
		{
			$es = $em->getRepository('BatnaSiebelBundle:Enterprise')->find($es_id);
			if($es->getGateway()->getId()!=$gtw->getId())
			{
				$es = new Enterprise();
				$es->setName($esString);
				$em->persist($es);
				$em->flush();
				$es->setGateways($gtw);
			}
		}
		else
		{
			$es = new Enterprise();
			$es->setName($esString);
			$em->persist($es);
			$em->flush();
			$es->setGateway($gtw);
		}
		return $es;
	}
	
	private function checkSS($em, Enterprise $es, Server $ss, $ssString)
	{
		if($ss_id = $es->getServerIdByName($ssString))
		{
			$ss = $em->getRepository('BatnaSiebelBundle:Server')->find($ss_id);
			if($ss->getEnterprise()->getId()!=$es->getId())
			{
				$ss = new Server();
				$ss->setName($ssString);
				$em->persist($ss);
				$em->flush();
				$ss->setEnterprise($es);
			}
		}
		else
		{
			$ss = new Server();
			$ss->setName($ssString);
			$em->persist($ss);
			$em->flush();
			$ss->setEnterprise($es);
		}
		return $ss;
	}
	
	private function checkCGByEnterprise($em, Enterprise $es, ComponentGroup $cg, $cgString)
	{
		if($cg_id = $es->getComponentGroupIdByName($cgString))
		{
			$cg = $em->getRepository('BatnaSiebelBundle:ComponentGroup')->find($cg_id);
			if($cg->getEnterprise()->getId()!=$es->getId())
			{
				//echo 'BY ENTERPRISE : Les id ne correspondent pas';
				$cg = new ComponentGroup();
				$cg->setName($cgString);
				$em->persist($cg);
				$em->flush();
				$cg->setEnterprise($es);
			}
		}
		else
		{
			//echo 'BY ENTERPRISE : Le nom ne correspond pas';
			$cg = new ComponentGroup();
			$cg->setName($cgString);
			$em->persist($cg);
			$em->flush();
			$cg->setEnterprise($es);
		}
		return $cg;
	}
	
	private function checkCGByServer($em, Server $ss, ComponentGroup $cg, $cgString)
	{
		if($cg_id = $ss->getComponentGroupIdByName($cgString))
		{
			$cg = $em->getRepository('BatnaSiebelBundle:ComponentGroup')->find($cg_id);
			if($cg->getServer()->getId()!=$ss->getId())
			{
				//echo 'BY SERVER : Les id ne correspondent pas';
				$cg = new ComponentGroup();
				$cg->setName($cgString);
				$em->persist($cg);
				$em->flush();
				$cg->setServer($ss);
			}
		}
		else
		{
			//echo 'BY SERVER : Le nom ne correspond pas';
			//echo 'id : "'.$cg_id.'" string "'.$cgString.'"<br />';
			
			$cg = new ComponentGroup();
			$cg->setName($cgString);
			$em->persist($cg);
			$em->flush();
			$cg->setServer($ss);
		}
		return $cg;
	}
	
	private function checkCP($em, ComponentGroup $cg, Component $cp, $cpString)
	{
		if($cp_id = $cg->getComponentIdByName($cpString))
		{
			$cp = $em->getRepository('BatnaSiebelBundle:Component')->find($cp_id);
			if($cp->getComponentGroup()->getId()!=$cg->getId())
			{
				$cp = new Component();
				$cp->setName($cpString);
				$em->persist($cp);
				$em->flush();
				$cp->setComponentGroup($cg);
			}
		}
		else
		{
			$cp = new Component();
			$cp->setName($cpString);
			$em->persist($cp);
			$em->flush();
			$cp->setComponentGroup($cg);
		}
		return $cp;
	}
	
	private function checkNS($em, $es, NamedSubsystem $ns, $nsString)
	{
		if($ns_id = $es->getNamedSubsystemIdByName($nsString))
		{
			$ns = $em->getRepository('BatnaSiebelBundle:NamedSubsystem')->find($ns_id);
			if($ns->getEnterprise()->getId()!=$es->getId())
			{
				$ns = new NamedSubsystem();
				$ns->setName($nsString);
				$em->persist($ns);
				$em->flush();
				$ns->setEnterprise($es);
			}
		}
		else
		{
			$ns = new NamedSubsystem();
			$ns->setName($nsString);
			$em->persist($ns);
			$em->flush();
			$ns->setEnterprise($es);
		}
		return $ns;
	}
}