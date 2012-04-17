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
		$this->contenuCourant = strstr($this->contenuCourant, '[');
		
		//$this->setContenuCourant(substr($this->getContenuCourant(),(strlen($block->getLen())+2)));
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
		
		$cmpt = 80;
		
		$gtw= new $this->gateway;
		$es = new Enterprise();
		$ss = new Server();
		$cg = new ComponentGroup();
		$cp = new Component();
		$ns = new NamedSubsystem();

		$i=0;
		while(false != ($block = $this->getBlock()) && $i<$cmpt)
		{
			if($block->getValue()!=null)
			{
				$i++;
				echo '"'.$block->getHauteur().'" => "'.$block->getVariable().'" : "'.$block->getValue().'"<br />';
				switch($block->getHauteur())
				{
					case '/es/version':
					{
						$es = checkES($es, $block->getES());
						$es->setVersion($block->getValue());
						
						echo $es;
						$em->persist($es);
						break;
					}
					case '/es/ns/def':
					{
						$es = checkES($es, $block->getES());
						$ns = checkNS($ns, $block->getNS());
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
						$es = checkES($es, $block->getES());
						$ns = checkNS($ns, $block->getNS());
						$ns->addParameter(array($block->getVariable(), $block->getValue()));
						$em->persist($ns);
						break;
					}
					case '/es/cl/cp':
					{
						$es = checkES($es, $block->getES());
						$es->addComponent(array($block->getVariable(), $block->getValue()));
						$em->persist($es);
						break;
					}
					case '/es/def':
					{
						$es = checkES($es, $block->getES());
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
						$es = checkES($es, $block->getES());
						$ss = checkSS($ss, $block->getSS());
						$ss->setVersion($block->getValue());
						$em->persist($ss);
						break;
					}
					case '/es/ss/def':
					{
						$es = checkES($es, $block->getES());
						$ss = checkSS($ss, $block->getSS());
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
					/*case '/es/ss/evt':
					{
						$es = checkES($es, $block->getES());
						$ss = checkSS($ss, $block->getSS());
						$ss->setEvent($block->getValue());
						$em->persist($ss);
						break;
					}*/
					case '/es/ss/cg/def':
					{
						$es = checkES($es, $block->getES());
						$ss = checkSS($ss, $block->getSS());
						$cg = checkCG($cg, $block->getCG());
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
						$es = checkES($es, $block->getES());
						$ss = checkSS($ss, $block->getSS());
						$cg = checkCG($cg, $block->getCG());
						$cp = checkCP($cp, $block->getCP());
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
						$es = checkES($es, $block->getES());
						$ss = checkSS($ss, $block->getSS());
						$cg = checkCG($cg, $block->getCG());
						$cp = checkCP($cp, $block->getCP());
						$cp->addParameter(array($block->getVariable(), $block->getValue()));
						$em->persist($cp);
						break;
					}
					case '/es/ss/cg/cp/cs':
					{
						$es = checkES($es, $block->getES());
						$ss = checkSS($ss, $block->getSS());
						$cg = checkCG($cg, $block->getCG());
						$cp = checkCP($cp, $block->getCP());
						$cp->setConnectString($block->getValue());
						$em->persist($cp);
						break;
					}
					case '/ess/ss/param':
					{
						$es = checkES($es, $block->getES());
						$ss = checkSS($ss, $block->getSS());
						$ss->addParameter(array($block->getVariable(), $block->getValue()));
						$em->persist($ss);
						break;
					}
					case '/es/ss/attr':
					{
						$es = checkES($es, $block->getES());
						$ss = checkSS($ss, $block->getSS());
						$ss->addAttribute(array($block->getVariable(), $block->getValue()));
						$em->persist($ss);
						break;
					}
					case '/es/cg/def':
					{
						$es = checkES($es, $block->getES());
						$cg = checkCG($cg, $block->getCG());
						switch($block->getVariable())
						{
							case 'enable state':		{$cg->setEnableState($block->getValue());		break;}
							case 'status':				{$cg->setStatus($block->getValue());			break;}
						}
						$em->persist($cg);
						break;
					}
					case '/es/cg/cp/def':
					{
						$es = checkES($es, $block->getES());
						$cg = checkCG($cg, $block->getCG());
						$cp = checkCP($cp, $block->getCP());
						switch($block->getVariable())
						{
							case 'start mode':			{$cp->setStartMode($block->getValue());			break;}
							case 'enable state':		{$cp->setEnableState($block->getValue());		break;}
							case 'status':				{$cp->setStatus($block->getValue());			break;}
						}
						$em->persist($cp);
						break;
					}
					case '/es/cg/cp/param':
					{
						$es = checkES($es, $block->getES());
						$cg = checkCG($cg, $block->getCG());
						$cp = checkCP($cp, $block->getCP());
						$cp->addParameter(array($block->getVariable(), $block->getValue()));
						$em->persist($cp);
						break;
					}
					case '/es/cg/cp/fxparam':
					{
						$es = checkES($es, $block->getES());
						$cg = checkCG($cg, $block->getCG());
						$cp = checkCP($cp, $block->getCP());
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
						$es = checkES($es, $block->getES());
						$es->addParameter(array($block->getVariable(), $block->getValue()));
						$em->persist($es);
						break;
					}
					case '/es/attr':
					{
						$es = checkES($es, $block->getES());
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
						$es = checkES($es, $block->getES());
						switch($block->getVariable())
						{
							case 'named subsystem sequence':	{$es->setNamedSubsystemSequence($block->getValue());	break;}
							case 'component sequence':			{$es->setComponents($block->getValue());				break;}
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
							case 'UseDefault':			{$gtw->setUseDefault($block->getValue());;	break;}
						}
						$em->persist($gtw);
						break;
					}
				}
				$em->flush();
			}
		}
		return true;
	}
	
	private function checkES(Enterprise $es, $esString)
	{
		if($es->getName() != $esString)
		{
			$es = new Enterprise();
			$es->setName($esString);
		}
		return $es;
	}
	
	private function checkSS(Server $ss, $ssString)
	{
		if($ss->getName() != $ssString)
		{
			$ss = new Server();
			$ss->setName($ssString);
		}
		return $ss;
	}
	
	private function checkCG(ComponentGroup $cg, $cgString)
	{
		if($cg->getName() != $cgString)
		{
			$cg = new ComponentGroup();
			$cg->setName($cgString);
		}
		return $cg;
	}
	
	private function checkCS(Component $cs, $csString)
	{
		if($cs->getName() != $csString)
		{
			$cs = new Component();
			$cs->setName($csString);
		}
		return $cs;
	}
	
	private function checkNS(NamedSubsystem $ns, $nsString){
		if($ns->getName() != $nsString)
		{
			$ns = new NamedSubsystem();
			$ns->setName($nsString);
		}
		return $ns;
	}
}