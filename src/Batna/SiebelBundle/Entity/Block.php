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
		$this->setValue();
		if($this->hasValue()){$this->analyseTitre();} // la fonction analyseTitre n'est pas faite pour être appelée dans une autres condition que celle-ci
	}
	
	private function setValue()
	{
		foreach($this->content as $numero => $ligne)
		{
			if(strpos($ligne, '=')!==false)
			{
				list($key, $value) = explode('=', $ligne);
				if($key=='Value')
					$this->value = str_replace('"', '', substr($value, 0, -1));
			}
			//elseif{}  // ajouter les autres parametres qu'on veux recuperer, pour l'instant que Value est utile
			elseif($numero==0){// on est sur la ligne de titre, ne rien faire ici
			}
			else {
				unset($this->content[$numero]);
			}
		}
	}
	
	//
	// ATTENTION : Cette fonction n'est à appeler que lorsque la variable $value est remplie, c'est à dire que le block a une vraie utilité et n'est pas juste un block de transition vers un block plus important. Il faut donc $this->hasValue()==true
	//
	private function analyseTitre()
	{
		
		$items = explode('/', str_replace(array('[/', '[', ']'), '', $this->titre));
		
		
		if($items[0]=='enterprises') //enterprises
		{
			if(isset($items[1]))//enterprises/<enterprise>
			{
				if(isset($items[2]))
				{
					$this->ES = $items[1];
					if($items[2] = 'version') //enterprises/<enterprise>/version
					{
						$this->hauteur = 'es/version';
						$this->variable = 'VersionString';
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
										$this->hauteur = '/es/ns/def';
										$this->variable = $items[5];
									}
								}
								elseif($items[4]=='parameters') //enterprises/<enterprise>/named subsystem/<named subsystem>/parameters
								{
									if(isset($items[5]))
									{
										$this->hauteur = '/es/ns/param';
										$this->variable = $items[5];
									}
								}
							}
						}
					}
					elseif($items[2]=='component list') //enterprises/<enterprise>/component list
					{
						if(isset($items[3])) //enterprises/<enterprise>/component list/<component>
						{
							$this->hauteur = '/es/cl/cp';
							$this->variable = $items[3];
						}
					}
					elseif($items[2]=='definition') //enterprises/<enterprise>/definition
					{
						if(isset($items[3]))
						{
							$this->hauteur = '/es/def';
							$this->variable = $items[3];
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
										$this->hauteur = '/es/ss/ver';
										$this->variable = $items[5];
									}
								}
								elseif($items[4]=='definition')//enterprises/<enterprise>/servers/<server>/definition
								{
									if(isset($items[5]))//enterprises/<enterprise>/servers/<server>/definition/...
									{
										$this->hauteur = '/es/ss/def';
										$this->variable = $items[5];
									}
								}
								elseif($items[4]=='events' && isset($items[7]) && $items[7] = 'EventLog')//enterprises/<enterprise>/servers/<server>/events/ServerLog/handlers/EventLog
								{
									$this->hauteur = 'es/ss/evt';
									$this->variable = 'EventLog';
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
													$this->hauteur = 'es/ss/cg/def';
													$this->variable = $items[7];
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
																$this->hauteur = '/es/ss/cg/cp/def';
																$this->variable = $items[9];
															}
														}	
														elseif($items[8]=='events')//enterprises/<enterprise>/servers/<server>/component groups/<component group>/components/<component>/events
														{
															// NADA TO DO,  on n'enregistre pas c'est du bruit
														}
														elseif($items[8]=='connect string')//enterprises/<enterprise>/servers/<server>/component groups/<component group>/components/<component>/connect strings/connect
														{
															if(isset($items[9]) && $items[9]=='service')
															{
																$this->hauteur = '/es/ss/cg/cp/cs';
																$this->variable = 'service';
															}
														}
														elseif($items[8]=='parameters') //enterprises/<enterprise>/servers/<server>/component groups/<component group>/components/<component>/parameters
														{
															if(isset($items[9])) //enterprises/<enterprise>/servers/<server>/component groups/<component group>/components/<component>/parameters/param
															{
																$this->hauteur = '/es/ss/cg/cp/param';
																$this->variable = $items[9];
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
										$this->hauteur = '/es/ss/param';
										$this->variable = $items[5];
									}
								}
								elseif($items[4]=='attributes') //enterprises/<enterprise>/servers/<server>/attributes
								{
									if(isset($items[5]))
									{
										$this->hauteur = '/es/ss/attr';
										$this->variable = $items[5];
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
										$this->hauteur = '/es/cg/def';
										$this->variable = $items[5];
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
													$this->hauteur = '/es/cg/cp/def';
													$this->variable = $items[7];
												}
											}elseif($items[6]=='parameters') //enterprises/<enterprise>/component groups/<component group>/components/<component>/parameters
											{
												if(isset($items[7]))
												{
													$this->hauteur = '/es/cg/cp/param';
													$this->variable = $items[7];
												}
											}elseif($items[6]=='fixed parameters') //enterprises/<enterprise>/component groups/<component group>/components/<component>/fixed parameters
											{
												if(isset($items[7]))
												{
													$this->hauteur = '/es/cg/cp/fxparam';
													$this->variable = $items[7];
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
							$this->hauteur = '/es/param';
							$this->variable = $items[3];
						}
					}
					elseif($items[2]=='attributes') //enterprises/<enterprise>/attributes
					{
						if(isset($items[3]))
						{
							$this->hauteur = '/es/attr';
							$this->variable = $items[3];
						}
					}
					elseif($items[2]=='sequences') //enterprises/<enterprise>/sequences
					{
						if(isset($items[3]))
						{
							$this->hauteur = '/es/seq';
							$this->variable = $items[3];
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
							$this->hauteur = '/gtw/ver';
							$this->variable = $items[3];
						}
					}elseif($items[2]=='definition') //gateways/<gateway>/definition
					{
						if(isset($items[3]))
						{
							$this->hauteur = '/gtw/def';
							$this->variable = $items[3];
						}
					}elseif($items[2]=='attributes') //gateways/<gateway>/attributes
					{
						if(isset($items[3]))
						{
							$this->hauteur = '/gtw/attr';
							$this->variable = $items[3];
						}
					}
				}
			}
		}
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
		return substr($this->variable, 0, -1);
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