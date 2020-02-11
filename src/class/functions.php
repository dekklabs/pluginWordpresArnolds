<?php 

defined( 'ABSPATH' ) or die( 'Direct access is not permitted' );

class functions {

	private $arr_lang = array();

	public function __construct() {
		$this->arr_lang = array(
			"Optimization"=>"Optimización",
			"XML Sitemap"=>"Mapa del sitio XML",
			"Missing"=>"No disponible",
			"Analytics"=>"Herramientas de Analítica",
			"Links"=>"Enlaces",
			"Page speed"=>"PageSpeed Insights",
			"Back to top"=>"Volver arriba",
			"Navigation"=>"Navegación",
			"Desktop"=>"Ordenador",
			"SPEED"=>"Velocidad",
			"USABILITY"=>"Experiencia de usuario",
			"Impact important"=>"Elementos que debes corregir:",
			"Impact warning" => "Elementos que puedes plantearte corregir:",
			"Impact success" => "{TotalInGroup} reglas aprobadas",
			"Analyzing..."=>" Analizando",
			"Show details"=>"Mostrar detalles",
			"Hide details"=>"Ocultar detalles",
			"Show how to fix"=>"Mostrar cómo corregirlo",
			"Google page speed cache"=>"*Los resultados se almacenan en la memoria caché durante 30 s. Si has realizado cambios en la página, espera 30 s antes de volver a ejecutar la prueba.",
			"Please confirm you're not a robot"=>"Por favor, confirma que no eres un robot",
			"This website uses cookies to ensure you get the best experience on our website."=>"Utilizamos cookies para personalizar contenido y anuncios, para proporcionar funciones de medios sociales y analizar nuestro tráfico. También compartimos información sobre su uso de nuestro sitio con nuestros socios de los medios sociales, publicidad y análisis.",
			"OK"=>"OK",
			"Learn more"=>"Aprende más",
			"Latest Reviews"=>"Último Revisións"
		);
	}

	public function parseFechaNumber($fecha = "") {
		switch ($fecha) {
			case 'ENERO':
				$data = 1;
			break;
			case 'FEBRERO':
				$data = 2;
			break;
			case 'MARZO':
				$data = 3;
			break;
			case 'ABRIL':
				$data = 4;
			break;
			case 'MAYO':
				$data = 5;
			break;
			case 'JUNIO':
				$data = 6;
			break;
			case 'JULIO':
				$data = 7;
			break;
			case 'AGOSTO':
				$data = 8;
			break;
			case 'SEPTIEMBRE':
				$data = 9;
			break;
			case 'OCTUBRE':
				$data = 10;
			break;
			case 'NOVIEMBRE':
				$data = 11;
			break;
			case 'DICIEMBRE':
				$data = 12;
			break;
		}
		return $data;
	}

	public function search_require($carpeta){
		$data = array();
		if(is_dir($carpeta)){
			if($dir = opendir($carpeta)){
				while(($archivo = readdir($dir)) !== false){
					$valid_formats = array("php");
					if($archivo != '.' && $archivo != '..' && $archivo != '.htaccess'){
						$ext = explode(".", $archivo);
						$extension = end($ext);
						if (in_array($extension, $valid_formats)) {
							$data[]  = $carpeta.'/'.$archivo;
						}else{
							$data = array_merge($data, $this->search_require($carpeta.'/'.$archivo));
						}
					}
				}
				closedir($dir);
			}
		}
		return $data;
	}

	public function sanear_string($string) {
		$string = trim($string);
		$string = str_replace(
			array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
			array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
			$string
			);

		$string = str_replace(
			array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
			array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
			$string
			);

		$string = str_replace(
			array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
			array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
			$string
			);

		$string = str_replace(
			array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
			array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
			$string
			);

		$string = str_replace(
			array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
			array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
			$string
			);

		$string = str_replace(
			array('ñ', 'Ñ', 'ç', 'Ç'),
			array('n', 'N', 'c', 'C',),
			$string
			);
		$string = str_replace(
			array("\\", "¨", "º", "-", "~",
				"#", "@", "|", "!", "\"",
				"·", "$", "%", "&", "/",
				"(", ")", "?", "'", "¡",
				"¿", "[", "^", "`", "]",
				"+", "}", "{", "¨", "´",
				">", "< ", ";", ",", ":",
				".","–","°","`","®","´", '"', "'", "‘", "’", '”', '“'),
			'',
			$string
			);
		return $string;
	}

	public function fecha_hora($fecha = null){
		$date = new DateTime($fecha);
		$dias = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
		$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		return $date->format('d')." de ".strtolower($meses[$date->format('n')-1]). " del ".$date->format('Y'). " a las " .$date->format('h:i');
	}

	public function saltos($texto){
		$texto = preg_replace("[\n|\r|\n\r]", "", $texto);
		return $texto;
	}

	public function redirect($url){
		header("Location: $url");
		exit();
	}

	public function seo($name=null){
		$string =  $this->sanear_string($name);
		$espacio= array('    ','   ','  ', ' ');
		$seo=strtolower(str_replace($espacio, "-", $string));
		return $seo;
	}

	public function displayOption($actual = null){
		$data = '';
		$s = "selected='selected'";
		$o=$t="";
		if(isset($actual)){
			if($actual==1){$o=$s;}else{$t=$s;}
		}
		$data .= "<option $o value='1'>SI</option>";
		$data .= "<option $t value='0'>NO</option>";
		return $data;
	}

	public function genero($actual = null){
		$data = '';
		$s = "selected='selected'";
		$o=$t="";
		if(isset($actual)){
			if($actual=='m'){$o=$s;}else{$t=$s;}
		}
		$data .= "<option $o value='m'>Hombre</option>";
		$data .= "<option $t value='f'>Mujer</option>";
		return $data;
	}

	public function textarea_encode($texto){
		$texto = str_replace("\n", "<br />",htmlentities(trim($texto)));
		return $texto;
	}
	
	public function textarea_decode($texto){
		$texto = str_replace("<br />", "\n", html_entity_decode(trim($texto)));
		return $texto;
	}

	public function mes($fecha = null){
		$date = new DateTime($fecha);
		$meses = array("ENE","FEB","MAR","ABR","MAY","JUN","JUL","AGO","SEP","OCT","NOV","DIC");
		return $date->format('d')." ".$meses[$date->format('n')-1];
	}

	public function mes_data($fecha = null){
		$data = array();
		$date = new DateTime($fecha);
		$meses = array("ENE","FEB","MAR","ABR","MAY","JUN","JUL","AGO","SEP","OCT","NOV","DIC");
		$data['day'] = $date->format('d');
		$data['month'] = $meses[$date->format('n')-1];
		return $data;
	}

	public function horario($fecha = null){
		$date = new DateTime($fecha);
		$dias = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
		$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		return $dias[$date->format('w')].", ".$date->format('d'). " de ".$meses[$date->format('n')-1] . " ". $date->format('H:i');
	}

	public function directorio_cursos($id = ''){
		global $config;
		try{
			$data = '';
			$directorio = _VIEWS_.'/frondend/'.$config['frondend'] ."/cursos";
			$direct = opendir($directorio);
			if(isset($direct)){
				$i = 0;
				while ($archivo = readdir($direct)){

					if (!is_file($archivo)){
						$filePath = $archivo;
						if (is_file($directorio."/".$filePath) && $filePath!="." && $filePath!=".."){
							if($archivo == $id) $sel = "selected='selected' "; else $sel = "";
							$data .= '<option '.$sel.' value="'.$archivo.'">'. $archivo.'</option>';
							$i++;
						}
					}
				}
			}else{
				$data .= '<option>No disponible</option>';
			}
			return $data;
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}

	}

	public function theme($id = ''){
		global $config;
		try{
			$data = '';
			$directorio = _VIEWS_.'/frondend/';
			$direct = opendir($directorio);
			if(isset($direct)){
				$i = 0;
				while ($archivo = readdir($direct)){

					if (!is_file($archivo)){
						$filePath = $archivo;
						if ($filePath!="." && $filePath!=".."){
							if($archivo == $id) $sel = "selected='selected' "; else $sel = "";
							$data .= '<option '.$sel.' value="'.$archivo.'">'. $archivo.'</option>';
						}
					}
				}
			}else{
				$data .= '<option>No disponible</option>';
			}
			return $data;
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}

	}

	public function directorio_mailing($id = ''){
		global $config;
		try{
			$data = '';
			$directorio = _VIEWS_."/mailing/cursos";
			$direct = opendir($directorio);
			if(isset($direct)){
				$i = 0;
				while ($archivo = readdir($direct)){

					if (!is_file($archivo)){
						$filePath = $archivo;
						if (is_file($directorio."/".$filePath) && $filePath!="." && $filePath!=".."){
							if($archivo == $id) $sel = "selected='selected' "; else $sel = "";
							$data .= '<option '.$sel.' value="'.$archivo.'">'. $archivo.'</option>';
							$i++;
						}
					}
				}
			}else{
				$data .= '<option>No disponible</option>';
			}
			return $data;
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}

	}

	public function imagen($fotos, $max, $nuevo, $path, $antigua){

		global $ModifiedImage;

		try{
			$valid_formats = array("jpg", "jpeg", "png", "gif", "ico");

			$name = $fotos['name'];
			$size = $fotos['size'];

			if(strlen($name)){
				$name = strtolower($name);
				$ext = explode(".", $name);
				$extension = end($ext);

				//validar formato
				if (in_array($extension, $valid_formats)) {
					//maximo 5MB
					if ($size<((1024*1024)*5)) {
						if($max == null){
							if(!move_uploaded_file($fotos['tmp_name'], $path . $nuevo)) {
								$this->msje = 'No se pudo subir la imagen';
								return false;
							}
						}else{
							if(count($max) > 0){
								foreach ($max as $key => $value) {
									$image = new ModifiedImage($fotos['tmp_name']);
									//convertir tamaño
									if($image->getWidth()){
										$image->resizeToWidth($value['size']);
										$image->save($path .$value['path']. $nuevo);
									}else{
										$this->msje = 'No se pudo subir la imagen y tampoco no se pude convertir el tamaño demasidado';
										return false;
									}
								}
							}else{
								$this->msje = 'Error en array [MAX]';
								return false;
							}
						}
					}else{
						$this->msje = 'La imagen es muy pesada';
						return false;
					}
				}

				//limpiar cache
				clearstatcache();

				$dir = $path . $nuevo;
				//verificar si el nuevo existe
				if (file_exists($dir)) {
					if($nuevo != $antigua &&  $antigua != ""){
						//verificar si la antigua existe
						if (file_exists($path . $antigua)) {
							//eliminar antigua
							unlink($path .$antigua);
						}
					}
				}else{
					$this->msje = 'La imagen no se pudo encuentrar';
					return false;
				}

			}
			return true;
		}catch(PDOException $e)
		{
			echo $e->getMessage();
		}

	}

	public function dias($fecha = null){
		$date = new DateTime($fecha);
		$dias = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
		$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		return $dias[$date->format('w')];
	}

	public function turno($horario = null){
		$exp = explode(':', $horario);
		$exp = intval($exp[0]);
		if($exp <= 12){
			$dia = 'Mañana';
			$time = 'AM';
		}else if($exp <= 18){
			$dia = 'Tarde';
			$time = 'AM';
		}else{
			$dia = 'Noche';
			$time = 'PM';
		}
		$horario =  $dia;
		return $horario;
	}

	public function locale($fecha = null){
		$date = new DateTime($fecha);
		$dias = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
		$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		return $date->format('d')." de ".$meses[$date->format('n')-1]. " del ".$date->format('Y') ;
	}

	public function autorespuesta($fecha, $curso, $inicio){

		$inicio = $inicio['fecha'];

		$nuevafecha = strtotime ( '+'.$curso->tiempo.' day' , strtotime ( $fecha ) ) ;

		$nuevafecha = date ( 'Y-m-d' , $nuevafecha );

		$inicio_text  = $this->locale($inicio);

		$textfecha = '';

		$textfecha .= '<b>'.$curso->nombre.'</b> iniciará el día <b>'.$inicio_text.'</b>';

		//vigente
		if($nuevafecha < $inicio){
			$textfecha .= ' y actualmente cuenta con un descuento del <b>'.$curso->descuento.'%</b> sobre la inversion total, si uno se inscribe hasta el <b>'.$this->locale($nuevafecha).'</b>';
		}

		$textfecha .= ' - <b>Aceptamos Todas las tarjetas de Crédito</b>.';

		return $textfecha;
	}

	public function cupon($nombre){
		$data = '';
		$explode = explode(' ', $nombre);
		foreach ($explode as $key => $value) {
			$data .= substr($value, 0, 1);
		}
		$data .= date("Y");
		return $data;
	}

	public function fix_trim($str){
		$str = Trim(htmlspecialchars($str));
		return $str;
	}

	public function get_domain($input) {
		$pieces = parse_url($input);
		if (isset($pieces['host'])) {
			return $pieces['host'];
        } else {
			return $pieces['path'];
        }
    }

	public function get_scheme($input) {
		$pieces = parse_url($input);
		if (isset($pieces['scheme'])) {
			return $pieces['scheme'];
        } else {
			return $pieces['path'];
		}
	}

	public function get_stopwords($html) {
        $stopwords = array('de', 'con', 'tu', 'se', 'una', 'que', 'qué', 'por', 'un', 'su', 'no', 'en', 'el', 'la', 'mas', 'más', 'para', 'ella', 'las', 'los', 'del', 'al', 'tus');
        $filtered_data = preg_replace('/\b(' . implode('|', $stopwords) . ')\b/', '', $html);
        return $filtered_data;
    }

	public function get_country_bycode($country) {
		$country_array = array(
				"AF" => "Afghanistan",
				"AL" => "Albania",
				"DZ" => "Algeria",
				"AS" => "American Samoa",
				"AD" => "Andorra",
				"AO" => "Angola",
				"AI" => "Anguilla",
				"AQ" => "Antarctica",
				"AG" => "Antigua and Barbuda",
				"AR" => "Argentina",
				"AM" => "Armenia",
				"AW" => "Aruba",
				"AU" => "Australia",
				"AT" => "Austria",
				"AZ" => "Azerbaijan",
				"BS" => "Bahamas",
				"BH" => "Bahrain",
				"BD" => "Bangladesh",
				"BB" => "Barbados",
				"BY" => "Belarus",
				"BE" => "Belgium",
				"BZ" => "Belize",
				"BJ" => "Benin",
				"BM" => "Bermuda",
				"BT" => "Bhutan",
				"BO" => "Bolivia",
				"BA" => "Bosnia and Herzegovina",
				"BW" => "Botswana",
				"BV" => "Bouvet Island",
				"BR" => "Brazil",
				"BQ" => "British Antarctic Territory",
				"IO" => "British Indian Ocean Territory",
				"VG" => "British Virgin Islands",
				"BN" => "Brunei",
				"BG" => "Bulgaria",
				"BF" => "Burkina Faso",
				"BI" => "Burundi",
				"KH" => "Cambodia",
				"CM" => "Cameroon",
				"CA" => "Canada",
				"CT" => "Canton and Enderbury Islands",
				"CV" => "Cape Verde",
				"KY" => "Cayman Islands",
				"CF" => "Central African Republic",
				"TD" => "Chad",
				"CL" => "Chile",
				"CN" => "China",
				"CX" => "Christmas Island",
				"CC" => "Cocos [Keeling] Islands",
				"CO" => "Colombia",
				"KM" => "Comoros",
				"CG" => "Congo - Brazzaville",
				"CD" => "Congo - Kinshasa",
				"CK" => "Cook Islands",
				"CR" => "Costa Rica",
				"HR" => "Croatia",
				"CU" => "Cuba",
				"CY" => "Cyprus",
				"CZ" => "Czech Republic",
				"CI" => "Côte d’Ivoire",
				"DK" => "Denmark",
				"DJ" => "Djibouti",
				"DM" => "Dominica",
				"DO" => "Dominican Republic",
				"NQ" => "Dronning Maud Land",
				"DD" => "East Germany",
				"EC" => "Ecuador",
				"EG" => "Egypt",
				"SV" => "El Salvador",
				"GQ" => "Equatorial Guinea",
				"ER" => "Eritrea",
				"EE" => "Estonia",
				"ET" => "Ethiopia",
				"FK" => "Falkland Islands",
				"FO" => "Faroe Islands",
				"FJ" => "Fiji",
				"FI" => "Finland",
				"FR" => "France",
				"GF" => "French Guiana",
				"PF" => "French Polynesia",
				"TF" => "French Southern Territories",
				"FQ" => "French Southern and Antarctic Territories",
				"GA" => "Gabon",
				"GM" => "Gambia",
				"GE" => "Georgia",
				"DE" => "Germany",
				"GH" => "Ghana",
				"GI" => "Gibraltar",
				"GR" => "Greece",
				"GL" => "Greenland",
				"GD" => "Grenada",
				"GP" => "Guadeloupe",
				"GU" => "Guam",
				"GT" => "Guatemala",
				"GG" => "Guernsey",
				"GN" => "Guinea",
				"GW" => "Guinea-Bissau",
				"GY" => "Guyana",
				"HT" => "Haiti",
				"HM" => "Heard Island and McDonald Islands",
				"HN" => "Honduras",
				"HK" => "Hong Kong SAR China",
				"HU" => "Hungary",
				"IS" => "Iceland",
				"IN" => "India",
				"ID" => "Indonesia",
				"IR" => "Iran",
				"IQ" => "Iraq",
				"IE" => "Ireland",
				"IM" => "Isle of Man",
				"IL" => "Israel",
				"IT" => "Italy",
				"JM" => "Jamaica",
				"JP" => "Japan",
				"JE" => "Jersey",
				"JT" => "Johnston Island",
				"JO" => "Jordan",
				"KZ" => "Kazakhstan",
				"KE" => "Kenya",
				"KI" => "Kiribati",
				"KW" => "Kuwait",
				"KG" => "Kyrgyzstan",
				"LA" => "Laos",
				"LV" => "Latvia",
				"LB" => "Lebanon",
				"LS" => "Lesotho",
				"LR" => "Liberia",
				"LY" => "Libya",
				"LI" => "Liechtenstein",
				"LT" => "Lithuania",
				"LU" => "Luxembourg",
				"MO" => "Macau SAR China",
				"MK" => "Macedonia",
				"MG" => "Madagascar",
				"MW" => "Malawi",
				"MY" => "Malaysia",
				"MV" => "Maldives",
				"ML" => "Mali",
				"MT" => "Malta",
				"MH" => "Marshall Islands",
				"MQ" => "Martinique",
				"MR" => "Mauritania",
				"MU" => "Mauritius",
				"YT" => "Mayotte",
				"FX" => "Metropolitan France",
				"MX" => "Mexico",
				"FM" => "Micronesia",
				"MI" => "Midway Islands",
				"MD" => "Moldova",
				"MC" => "Monaco",
				"MN" => "Mongolia",
				"ME" => "Montenegro",
				"MS" => "Montserrat",
				"MA" => "Morocco",
				"MZ" => "Mozambique",
				"MM" => "Myanmar [Burma]",
				"NA" => "Namibia",
				"NR" => "Nauru",
				"NP" => "Nepal",
				"NL" => "Netherlands",
				"AN" => "Netherlands Antilles",
				"NT" => "Neutral Zone",
				"NC" => "New Caledonia",
				"NZ" => "New Zealand",
				"NI" => "Nicaragua",
				"NE" => "Niger",
				"NG" => "Nigeria",
				"NU" => "Niue",
				"NF" => "Norfolk Island",
				"KP" => "North Korea",
				"VD" => "North Vietnam",
				"MP" => "Northern Mariana Islands",
				"NO" => "Norway",
				"OM" => "Oman",
				"PC" => "Pacific Islands Trust Territory",
				"PK" => "Pakistan",
				"PW" => "Palau",
				"PS" => "Palestinian Territories",
				"PA" => "Panama",
				"PZ" => "Panama Canal Zone",
				"PG" => "Papua New Guinea",
				"PY" => "Paraguay",
				"YD" => "People's Democratic Republic of Yemen",
				"PE" => "Perú",
				"PH" => "Philippines",
				"PN" => "Pitcairn Islands",
				"PL" => "Poland",
				"PT" => "Portugal",
				"PR" => "Puerto Rico",
				"QA" => "Qatar",
				"RO" => "Romania",
				"RU" => "Russia",
				"RW" => "Rwanda",
				"RE" => "Réunion",
				"BL" => "Saint Barthélemy",
				"SH" => "Saint Helena",
				"KN" => "Saint Kitts and Nevis",
				"LC" => "Saint Lucia",
				"MF" => "Saint Martin",
				"PM" => "Saint Pierre and Miquelon",
				"VC" => "Saint Vincent and the Grenadines",
				"WS" => "Samoa",
				"SM" => "San Marino",
				"SA" => "Saudi Arabia",
				"SN" => "Senegal",
				"RS" => "Serbia",
				"CS" => "Serbia and Montenegro",
				"SC" => "Seychelles",
				"SL" => "Sierra Leone",
				"SG" => "Singapore",
				"SK" => "Slovakia",
				"SI" => "Slovenia",
				"SB" => "Solomon Islands",
				"SO" => "Somalia",
				"ZA" => "South Africa",
				"GS" => "South Georgia and the South Sandwich Islands",
				"KR" => "South Korea",
				"ES" => "Spain",
				"LK" => "Sri Lanka",
				"SD" => "Sudan",
				"SR" => "Suriname",
				"SJ" => "Svalbard and Jan Mayen",
				"SZ" => "Swaziland",
				"SE" => "Sweden",
				"CH" => "Switzerland",
				"SY" => "Syria",
				"ST" => "São Tomé and Príncipe",
				"TW" => "Taiwan",
				"TJ" => "Tajikistan",
				"TZ" => "Tanzania",
				"TH" => "Thailand",
				"TL" => "Timor-Leste",
				"TG" => "Togo",
				"TK" => "Tokelau",
				"TO" => "Tonga",
				"TT" => "Trinidad and Tobago",
				"TN" => "Tunisia",
				"TR" => "Turkey",
				"TM" => "Turkmenistan",
				"TC" => "Turks and Caicos Islands",
				"TV" => "Tuvalu",
				"UM" => "U.S. Minor Outlying Islands",
				"PU" => "U.S. Miscellaneous Pacific Islands",
				"VI" => "U.S. Virgin Islands",
				"UG" => "Uganda",
				"UA" => "Ukraine",
				"SU" => "Union of Soviet Socialist Republics",
				"AE" => "United Arab Emirates",
				"GB" => "United Kingdom",
				"US" => "United States",
				"ZZ" => "Unknown or Invalid Region",
				"UY" => "Uruguay",
				"UZ" => "Uzbekistan",
				"VU" => "Vanuatu",
				"VA" => "Vatican City",
				"VE" => "Venezuela",
				"VN" => "Vietnam",
				"WK" => "Wake Island",
				"WF" => "Wallis and Futuna",
				"EH" => "Western Sahara",
				"YE" => "Yemen",
				"ZM" => "Zambia",
				"ZW" => "Zimbabwe",
				"AX" => "Åland Islands",
				);

		if (@$country_array[$country] != null) {
			return $country_array[$country];
		} 
		return 'unknown';
	}

	public function get_lang_bycode($lang) {
		$language_codes = array(
			'en' => 'English' , 
			'aa' => 'Afar' , 
			'ab' => 'Abkhazian' , 
			'af' => 'Afrikaans' , 
			'am' => 'Amharic' , 
			'ar' => 'Arabic' , 
			'as' => 'Assamese' , 
			'ay' => 'Aymara' , 
			'az' => 'Azerbaijani' , 
			'ba' => 'Bashkir' , 
			'be' => 'Byelorussian' , 
			'bg' => 'Bulgarian' , 
			'bh' => 'Bihari' , 
			'bi' => 'Bislama' , 
			'bn' => 'Bengali/Bangla' , 
			'bo' => 'Tibetan' , 
			'br' => 'Breton' , 
			'ca' => 'Catalan' , 
			'co' => 'Corsican' , 
			'cs' => 'Czech' , 
			'cy' => 'Welsh' , 
			'da' => 'Danish' , 
			'de' => 'German' , 
			'dz' => 'Bhutani' , 
			'el' => 'Greek' , 
			'eo' => 'Esperanto' , 
			'es' => 'Español' , 
			'et' => 'Estonian' , 
			'eu' => 'Basque' , 
			'fa' => 'Persian' , 
			'fi' => 'Finnish' , 
			'fj' => 'Fiji' , 
			'fo' => 'Faeroese' , 
			'fr' => 'French' , 
			'fy' => 'Frisian' , 
			'ga' => 'Irish' , 
			'gd' => 'Scots/Gaelic' , 
			'gl' => 'Galician' , 
			'gn' => 'Guarani' , 
			'gu' => 'Gujarati' , 
			'ha' => 'Hausa' , 
			'hi' => 'Hindi' , 
			'hr' => 'Croatian' , 
			'hu' => 'Hungarian' , 
			'hy' => 'Armenian' , 
			'ia' => 'Interlingua' , 
			'ie' => 'Interlingue' , 
			'ik' => 'Inupiak' , 
			'in' => 'Indonesian' , 
			'is' => 'Icelandic' , 
			'it' => 'Italian' , 
			'iw' => 'Hebrew' , 
			'ja' => 'Japanese' , 
			'ji' => 'Yiddish' , 
			'jw' => 'Javanese' , 
			'ka' => 'Georgian' , 
			'kk' => 'Kazakh' , 
			'kl' => 'Greenlandic' , 
			'km' => 'Cambodian' , 
			'kn' => 'Kannada' , 
			'ko' => 'Korean' , 
			'ks' => 'Kashmiri' , 
			'ku' => 'Kurdish' , 
			'ky' => 'Kirghiz' , 
			'la' => 'Latin' , 
			'ln' => 'Lingala' , 
			'lo' => 'Laothian' , 
			'lt' => 'Lithuanian' , 
			'lv' => 'Latvian/Lettish' , 
			'mg' => 'Malagasy' , 
			'mi' => 'Maori' , 
			'mk' => 'Macedonian' , 
			'ml' => 'Malayalam' , 
			'mn' => 'Mongolian' , 
			'mo' => 'Moldavian' , 
			'mr' => 'Marathi' , 
			'ms' => 'Malay' , 
			'mt' => 'Maltese' , 
			'my' => 'Burmese' , 
			'na' => 'Nauru' , 
			'ne' => 'Nepali' , 
			'nl' => 'Dutch' , 
			'no' => 'Norwegian' , 
			'oc' => 'Occitan' , 
			'om' => '(Afan)/Oromoor/Oriya' , 
			'pa' => 'Punjabi' , 
			'pl' => 'Polish' , 
			'ps' => 'Pashto/Pushto' , 
			'pt' => 'Portuguese' , 
			'qu' => 'Quechua' , 
			'rm' => 'Rhaeto-Romance' , 
			'rn' => 'Kirundi' , 
			'ro' => 'Romanian' , 
			'ru' => 'Russian' , 
			'rw' => 'Kinyarwanda' , 
			'sa' => 'Sanskrit' , 
			'sd' => 'Sindhi' , 
			'sg' => 'Sangro' , 
			'sh' => 'Serbo-Croatian' , 
			'si' => 'Singhalese' , 
			'sk' => 'Slovak' , 
			'sl' => 'Slovenian' , 
			'sm' => 'Samoan' , 
			'sn' => 'Shona' , 
			'so' => 'Somali' , 
			'sq' => 'Albanian' , 
			'sr' => 'Serbian' , 
			'ss' => 'Siswati' , 
			'st' => 'Sesotho' , 
			'su' => 'Sundanese' , 
			'sv' => 'Swedish' , 
			'sw' => 'Swahili' , 
			'ta' => 'Tamil' , 
			'te' => 'Tegulu' , 
			'tg' => 'Tajik' , 
			'th' => 'Thai' , 
			'ti' => 'Tigrinya' , 
			'tk' => 'Turkmen' , 
			'tl' => 'Tagalog' , 
			'tn' => 'Setswana' , 
			'to' => 'Tonga' , 
			'tr' => 'Turkish' , 
			'ts' => 'Tsonga' , 
			'tt' => 'Tatar' , 
			'tw' => 'Twi' , 
			'uk' => 'Ukrainian' , 
			'ur' => 'Urdu' , 
			'uz' => 'Uzbek' , 
			'vi' => 'Vietnamese' , 
			'vo' => 'Volapuk' , 
			'wo' => 'Wolof' , 
			'xh' => 'Xhosa' , 
			'yo' => 'Yoruba' , 
			'zh' => 'Chinese' , 
			'zu' => 'Zulu' , 
			);

		if (@$language_codes[$lang] != null) {
			return $language_codes[$lang];
		}
		return 'unknown';
	}

	public function filter_linksweb($web) {
		$arr = array('facebook.com', 'pe.linkedin.com', 'dinersclub.com.pe', 'universidadperu.com', 'indeed.com.pe', 'moovitapp.com', 'google.com', 'pinterest.com', 'youtube.com', 'razonsocialperu.com', 'myvideonews.com', 'datosperu.org');
		foreach($arr as $element) {
			if (strcmp($web, $element) == 0) {
				return true;
			}
		}
		return false;
	}

	function sinTildes($cadena) {

		$no_permitidas= array ('á','é','í','ó','ú','Á','É','Í','Ó','Ú','ñ','À','Ã','Ì','Ò','Ù','Ã™','Ã ','Ã¨','Ã¬','Ã²','Ã¹','ç','Ç','Ã¢','ê','Ã®','Ã´','Ã»','Ã‚','ÃŠ','ÃŽ','Ã”','Ã›','ü','Ã¶','Ã–','Ã¯','Ã¤','«','Ò','Ã','Ã„','Ã‹','Ñ','à','è','ì','ò','ù');

		$permitidas= array ('a','e','i','o','u','A','E','I','O','U','n','N','A','E','I','O','U','a','e','i','o','u','c','C','a','e','i','o','u','A','E','I','O','U','u','o','O','i','a','e','U','I','A','E','N','a','e','i','o','u');

		$texto = str_replace($no_permitidas, $permitidas ,$cadena);

		return $texto;

	}

    function urlToDomain($url){
            return implode(array_slice(explode('/', preg_replace('/https?:\/\/(www\.)?/', '', $url)), 0, 1));
	}

	public function curl_exec($ch, &$maxredirect = null) {
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);

		$user_agent = "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.7.5)".
					  " Gecko/20041107 Firefox/1.0";
        curl_setopt($ch, CURLOPT_USERAGENT, $user_agent );

        $mr = $maxredirect === null ? 5 : intval($maxredirect);
        if (ini_get('open_basedir') == '' && (ini_get('safe_mode') == 'Off' || ini_get('safe_mode')=='')) {
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, $mr > 0);
            curl_setopt($ch, CURLOPT_MAXREDIRS, $mr);
        } else {
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
            if ($mr > 0) {
                $original_url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
                $newurl = $original_url;

                $rch = curl_copy_handle($ch);

                curl_setopt($rch, CURLOPT_HEADER, true);
                curl_setopt($rch, CURLOPT_NOBODY, true);
                curl_setopt($rch, CURLOPT_FORBID_REUSE, false);
                curl_setopt($rch, CURLOPT_RETURNTRANSFER, true);
                do
                {
                    curl_setopt($rch, CURLOPT_URL, $newurl);
                    $header = curl_exec($rch);
                    if (curl_errno($rch)) {
                        $code = 0;
                    } else {
                        $code = curl_getinfo($rch, CURLINFO_HTTP_CODE);
                        if ($code == 301 || $code == 302) {
                            preg_match('/Location:(.*?)\n/i', $header, $matches);
                            $newurl = trim(array_pop($matches));
                            // if no scheme is present then the new url is a
                            // relative path and thus needs some extra care
                            if(!preg_match("/^https?:/i", $newurl)){
                                $newurl = $original_url . $newurl;
                            }
                        } else {
                            $code = 0;
                        }
                    }
                } while ($code && --$mr);

                curl_close($rch);

                if (!$mr)
                {
                    if ($maxredirect === null)
                        return false;
                    else
                        $maxredirect = 0;

                    return false;
                }
                curl_setopt($ch, CURLOPT_URL, $newurl);
            }
        }
        return curl_exec($ch);
	}
	
	public function curl($url) {
		$ch = curl_init($url);
		$html = $this->curl_exec($ch);
		curl_close($ch);
		return $html;
	}

	public function tr($parm, $s = NULL, $v = NULL) {
		if (isset($this->arr_lang[$parm])) {
			$str = $this->arr_lang[$parm];
			if (isset($s)) {
				$str = str_replace($s, $v . '', $str);
			}
			return $str;
		}
			
		return $parm;
	}

	public function website($website){
		if($website != ""){
			if  ( $ret = parse_url($website) ) {
				if ( !isset($ret["scheme"]) )
				{
					$website = "http://{$website}";
				}
			}
		}
		return $website;
	}
}

$functions = new functions();