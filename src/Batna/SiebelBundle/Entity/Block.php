<?php
namespace Batna\SiebelBundle\Entity;

class Block
{
	private $content;    // Contenu complet du block, tableau ligne par ligne
	private $titre;      // Ligne de titre
	private $hauteur;    // Résumé de la ligne de titre épuré des élements variables ('/enterprises/<enterprise>/servers/<server>/params'=>'enterprises/servers/params')
	private $variable;   // Nom de la variable de définition, paramètre, attribut, sequence, ...
	private $value;      // Valeur de la variable $variable
	private $GTW;        // Nom de la gateway
	private $ES;         // Nom de l'enterprise
	private $NS;         // Nom du named susbsytem
	private $SS;         // Nom du siebel server
	private $CG;         // Nom du composant group
	private $CP;         // Nom du composant
	
	/**
	 * Renseigne le nom complet du fichier siebns
	 * @param string $file
	 */
	
	public function __construct()
	{
		$this->value = null;
		$this->corps = array();
	}
	
	public function setContent($content)
	{
		$this->content = explode("\n", str_replace(array("\t", '    '), '', $content));
		$this->setTitre();
		$this->analyseTitre();
	}
	
	private function setValue()
	{		
		foreach($this->content as $numero => $ligne)
		{
			if(strpos($ligne, '=')!==false)
			{
				list($key, $value) = explode('=', $ligne);
				if($key=='Value')
				{
					$this->value = str_replace(array('"', "\n"), '', substr($value, 0));
				}
			}
			//elseif{}  // ajouter les autres parametres qu'on veux recuperer, pour l'instant que Value est utile
			elseif($numero==0){// on est sur la ligne de titre, ne rien faire ici
			}
			else {
				unset($this->content[$numero]);
			}
		}
		//echo $this->value.'<br />';
	}
	
	private function analyseTitre()
	{
		
		$items = explode('/', str_replace(array('[/', ']'), '', $this->titre));
		
		//$rendu = print_r($items);
		
		if($items[0]=='enterprises') //enterprises
		{
			if(isset($items[1]))//enterprises/<enterprise>
			{
				if(isset($items[2]))
				{
					$this->ES = $items[1];
					if($items[2] == 'version') //enterprises/<enterprise>/version
					{
						$this->setHV2('/es/version', 'VersionString');
					}
					elseif($items[2]=='named subsystems') //enterprises/<enterprise>/named subsystem
					{
						if(isset($items[3])) //enterprises/<enterprise>/named subsystem/<named subsystem>
						{
							$this->NS = $items[3];
							if(isset($items[4])) //enterprises/<enterprise>/named subsystem/<named subsystem>/...
							{
								if($items[4]=='definition') //enterprises/<enterprise>/named subsystem/<named subsystem>/definition
								{
									if(isset($items[5]))
									{
										$this->setHV2('/es/ns/def', $items[5]);
									}
								}
								elseif($items[4]=='parameters') //enterprises/<enterprise>/named subsystem/<named subsystem>/parameters
								{
									if(isset($items[5]))
									{
										$this->setHV2('/es/ns/param', $items[5]);
									}
								}
							}
						}
					}
					elseif($items[2]=='component list') //enterprises/<enterprise>/component list
					{
						if(isset($items[3])) //enterprises/<enterprise>/component list/<component>
						{
							$this->setHV2('/es/cl/cp', $items[3]);
						}
					}
					elseif($items[2]=='definition') //enterprises/<enterprise>/definition
					{
						if(isset($items[3]))
						{
							$this->setHV2('/es/def', $items[3]);
						}
					}
					elseif($items[2]=='servers') //enterprises/<enterprise>/servers
					{
						if(isset($items[3])) //enterprises/<enterprise>/servers/<server>
						{
							$this->SS = $items[3];
							if(isset($items[4]))
							{
								if($items[4]=='version')//enterprises/<enterprise>/servers/<server>/version
								{
									if(isset($items[5]))//enterprises/<enterprise>/servers/<server>/version/...
									{
										$this->setHV2('/es/ss/ver', $items[5]);
									}
								}
								elseif($items[4]=='definition')//enterprises/<enterprise>/servers/<server>/definition
								{
									if(isset($items[5]))//enterprises/<enterprise>/servers/<server>/definition/...
									{
										$this->setHV2('/es/ss/def', $items[5]);
									}
								}
								elseif($items[4]=='events' && isset($items[7]) && $items[7] = 'EventLog')//enterprises/<enterprise>/servers/<server>/events/ServerLog/handlers/EventLog
								{
									$this->setHV2('es/ss/evt', 'EventLog');
								}
								elseif($items[4]=='component groups')//enterprises/<enterprise>/servers/<server>/component groups
								{
									if(isset($items[5]))//enterprises/<enterprise>/servers/<server>/component groups/<component group>
									{
										$this->CG = $items[5];
										if(isset($items[6]))//enterprises/<enterprise>/servers/<server>/component groups/<component group>/..
										{
											if($items[6]=='definition')//enterprises/<enterprise>/servers/<server>/component groups/<component group>/definition
											{
												if(isset($items[7]))
												{
													$this->setHV2('/es/ss/cg/def', $items[7]);
												}
											}
											elseif($items[6]=='components')//enterprises/<enterprise>/servers/<server>/component groups/<component group>/components
											{
												if(isset($items[7]))//enterprises/<enterprise>/servers/<server>/component groups/<component group>/components/<component>
												{
													$this->CP = $items[7];
													if(isset($items[8]))
													{
														if($items[8]=='definition')
														{
															if(isset($items[9]))//enterprises/<enterprise>/servers/<server>/component groups/<component group>/components/<component>/definition/...
															{
																$this->setHV2('/es/ss/cg/cp/def', $items[9]);
															}
														}	
														/*elseif($items[8]=='events')//enterprises/<enterprise>/servers/<server>/component groups/<component group>/components/<component>/events
														{
															// NADA TODO,  on n'enregistre pas c'est du bruit
														}/**/
														elseif($items[8]=='connect strings')//enterprises/<enterprise>/servers/<server>/component groups/<component group>/components/<component>/connect strings/connect
														{
															if(isset($items[9]) && $items[9]=='service')
															{
																$this->setHV2('/es/ss/cg/cp/cs', 'service');
															}
														}
														elseif($items[8]=='parameters') //enterprises/<enterprise>/servers/<server>/component groups/<component group>/components/<component>/parameters
														{
															if(isset($items[9])) //enterprises/<enterprise>/servers/<server>/component groups/<component group>/components/<component>/parameters/param
															{
																$this->setHV2('/es/ss/cg/cp/param', $items[9]);
															}
														}
													}
												}
											}
										}
									}
								}
								elseif($items[4]=='parameters') //enterprises/<enterprise>/servers/<server>/parameters
								{
									if(isset($items[5]))
									{
										$this->setHV2('/es/ss/param', $items[5]);
									}
								}
								elseif($items[4]=='attributes') //enterprises/<enterprise>/servers/<server>/attributes
								{
									if(isset($items[5]))
									{
										$this->setHV2('/es/ss/attr', $items[5]);
									}
								}
							}
						}
					}
					elseif($items[2]=='component groups') //enterprises/<enterprise>/component groups
					{
						if(isset($items[3])) //enterprises/<enterprise>/component groups/<component group>
						{
							$this->CG = $items[3];
							if(isset($items[4]))
							{
								if($items[4]=='definition') //enterprises/<enterprise>/component groups/<component group>/definition
								{
									if(isset($items[5]))
									{
										$this->setHV2('/es/cg/def', $items[5]);
									}
								}
								elseif($items[4]=='components') //enterprises/<enterprise>/component groups/<component group>/components
								{
									if(isset($items[5])) //enterprises/<enterprise>/component groups/<component group>/components/<component>
									{
										$this->CP = $items[5];
										if(isset($items[6]))
										{
											if($items[6]=='definition') //enterprises/<enterprise>/component groups/<component group>/components/<component>/definition
											{
												if(isset($items[7]))
												{
													$this->setHV2('/es/cg/cp/def', $items[7]);
												}
											}elseif($items[6]=='parameters') //enterprises/<enterprise>/component groups/<component group>/components/<component>/parameters
											{
												if(isset($items[7]))
												{
													$this->setHV2('/es/cg/cp/param', $items[7]);
												}
											}elseif($items[6]=='fixed parameters') //enterprises/<enterprise>/component groups/<component group>/components/<component>/fixed parameters
											{
												if(isset($items[7]))
												{
													$this->setHV2('/es/cg/cp/fxparam', $items[7]);
												}
											}
										}
									}
								}
							}
						}
					}
					elseif($items[2]=='parameters') //enterprises/<enterprise>/parameters
					{
						if(isset($items[3]))
						{
							$this->setHV2('/es/param', $items[3]);
						}
					}
					elseif($items[2]=='attributes') //enterprises/<enterprise>/attributes
					{
						if(isset($items[3]))
						{
							$this->setHV2('/es/attr', $items[3]);
						}
					}
					elseif($items[2]=='sequences') //enterprises/<enterprise>/sequences
					{
						if(isset($items[3]))
						{
							$this->setHV2('/es/seq', $items[3]);
						}
					}
				}
			}
		}
		elseif($items[0]=='gateways') //gateways
		{
			if(isset($items[1])) //gateways/<gateway>
			{
				$this->GTW = $items[1];
				if(isset($items[2]))
				{
					if($items[2]=='version') //gateways/<gateway>/version
					{
						if(isset($items[3]))
						{
							$this->setHV2('/gtw/ver', $items[3]);
						}
					}elseif($items[2]=='definition') //gateways/<gateway>/definition
					{
						if(isset($items[3]))
						{
							$this->setHV2('/gtw/def', $items[3]);
						}
					}elseif($items[2]=='attributes') //gateways/<gateway>/attributes
					{
						if(isset($items[3]))
						{
							$this->setHV2('/gtw/attr', $items[3]);
						}
					}
				}
			}
		}
	}
	
	/**
	 * Set HV2 (Hauteur, Variable, Valeur)
	 * @param string $hauteur
	 * @param string $variable
	 */
	private function setHV2($hauteur, $variable)
	{
		$this->hauteur = $hauteur;
		$this->variable = $variable;
		$this->setValue();
	}
		
	private function setTitre()
	{
		$this->titre = $this->content[0];
	}
	
	public function getValue()
	{
		return $this->value;
	}
	
	public function hasValue()
	{
		return ($this->value != null);
	}
	
	public function getTitre()
	{
		return $this->titre;
	}
	
	public function getHauteur()
	{
		return $this->hauteur;
	}
	
	public function getVariable()
	{
		return $this->variable;
	}
	
	public function getGTW()
	{
		return $this->GTW;
	}
	
	public function getES()
	{
		return $this->ES;
	}
	
	public function getNS()
	{
		return $this->NS;
	}
	
	public function getSS()
	{
		return $this->SS;
	}
	
	public function getCG()
	{
		return $this->CG;
	}
	
	public function getCP()
	{
		return $this->CP;
	}
}