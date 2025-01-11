<?php
include_once("init.php");
include_once("xmllibs.php");

if($backend->mimetype=="application/rdf+xml"){
print_rdf_head($rootxmlns);
  
foreach($backend->data as $typename=>$itemtype){
	foreach($itemtype as $name=>$item){
		if($name=="blank")$name="";
		$label=htmlspecialchars($name);
		$name=escapeOutput($name);
		if ($item->transitive and $typename == "ObjectProperty") $localtypename = "TransitiveProperty";
		else $localtypename = $typename;
		$backend->addOutput( "\t<owl:$localtypename rdf:about=\"".escapeOutput($name)."\">\n");
		if($item->comment)$backend->addOutput( "\t\t<rdfs:comment>".htmlspecialchars($item->comment)."</rdfs:comment>\n");
		if($label)$backend->addOutput( "\t\t<rdfs:label>".stripPrefix($label)."</rdfs:label>\n");
		if($item->creator)$backend->addOutput( "\t\t<dc:creator rdf:resource=\"".escapeOutput($item->creator)."\" />\n");
		if($item->subclassof)$backend->addOutput( "\t\t<rdfs:subClassOf rdf:resource=\"".escapeOutput($item->subclassof)."\" />\n");
		if($item->subpropertyof)$backend->addOutput( "\t\t<rdfs:subPropertyOf rdf:resource=\"".escapeOutput($item->subpropertyof)."\" />\n");
		if($item->domain) {
			if (is_array($item->domain)) {
				$backend->addOutput("<owl:unionOf rdf:parseType=\"Collection\">");
				foreach($item->domain as $domain) {
					$backend->addOutput( "\t\t<rdfs:domain rdf:resource=\"".escapeOutput($domain)."\" />\n");
				}
				$backend->addOutput("</owl:unionOf>");
			}
			else $backend->addOutput( "\t\t<rdfs:domain rdf:resource=\"".escapeOutput($item->domain)."\" />\n");
		}
		if($item->range) {
			if (is_array($item->range)) {
				$backend->addOutput("<owl:unionOf rdf:parseType=\"Collection\">");
				foreach($item->range as $range) {
					$backend->addOutput( "\t\t<rdfs:range rdf:resource=\"".escapeOutput($range)."\" />\n");
				}
				$backend->addOutput("</owl:unionOf>");
			}
			else $backend->addOutput( "\t\t<rdfs:range rdf:resource=\"".escapeOutput($item->range)."\" />\n");
		}
		if($item->sameas)$backend->addOutput( "\t\t<owl:sameAs rdf:resource=\"".escapeOutput($item->sameas)."\" />\n");
		if($item->priorVersion)$backend->addOutput( "\t\t<owl:priorVersion rdf:resource=\"".escapeOutput($item->priorVersion)."\" />\n");
		if($item->status)$backend->addOutput( "\t\t<vs:term_status>".htmlspecialchars($item->status)."</vs:term_status>\n");
		if($item->inverseOf)$backend->addOutput( "\t\t<owl:inverseOf rdf:resource=\"".escapeOutput($item->inverseOf)."\" />\n");
		$backend->addOutput( "\t</owl:$localtypename>\n");
	}
	$backend->addOutput( "\n");
}
print_rdf_foot();
}
foreach($backend->data as $typename=>$itemtype){
	foreach($itemtype as $name=>$item){
		if($name=="blank")continue;
		$class = "schemabox";
		if($item->status) $class .= " ".htmlspecialchars($item->status);
		$backend->addOutput("<div id=\"".htmlspecialchars($name)."\" class=\"{$class}\">");
		if($item->status)$backend->addOutput("<div class='term_status'>".htmlspecialchars($item->status)."</div>");
		$backend->addOutput(htmlspecialchars($typename).": ".linktoitem($name),"h3");
		if($item->comment)$backend->addText($item->comment);
		if($item->examples) {
			if (!is_array($item->examples))$item->examples = explode(';', $item->examples);
			$backend->addOutput("<div class='examples'>");
			$backend->addText("Examples", "h4");
			$backend->addOutput("<ul>");
			foreach($item->examples as $url => $eg) {
				if (is_numeric($url) or empty($url)) $backend->addText(trim($eg), "li");
				else {
					$backend->addOutput("<li><a href=\"".htmlspecialchars($url)."\">");
					$backend->addText(trim($eg));
					$backend->addOutput("</a></li>");
				}
			}
			$backend->addOutput("</ul>");
			$backend->addOutput("</div>");
		}
		if($item->subclassof)$backend->addOutput("<div>Subclass Of: ".linktoitem($item->subclassof)."</div>");
		if($item->subpropertyof)$backend->addOutput("<div>Subproperty Of: ".linktoitem($item->subpropertyof)."</div>");
		if($item->range)$backend->addOutput("<div>Range: ".linktoitem($item->range)."</div>");
		if($item->domain)$backend->addOutput("<div>Domain: ".linktoitem($item->domain)."</div>");
		if($item->transitive)$backend->addOutput("<div><strong>Transitive Property</strong></div>");
		if($item->inverseOf)$backend->addOutput("<div>Inverse of: ".linktoitem($item->inverseOf)."</div>");
		if($item->sameas)$backend->addOutput("<div>Same as: ".linktoitem($item->sameas)."</div>");
		$backend->addOutput("</div>\n");
	}
}

$backend->printit();

function linktoitem($name){
	global $xmlns;
	if (is_array($name)) {
		$output = array();
		foreach($name as $subname) {
			$output[] = linktoitem($subname);
		}
		return implode(", ", $output);
	}
	$url=htmlspecialchars($name);
	if (strpos($url,":")!==false){
		$ontology=substr($url,0,strpos($url,":"));
		if(isset($xmlns->{$ontology})){
			$url=substr($url,strrpos($url,":")+1);
			$url=$xmlns->{$ontology}.$url;
		}
		else throw new Exception("Can't find namespace '{$ontology}'");
	}
	else $url="#".$url;
	return "<a href=\"$url\">$name</a>";
}
function escapeOutput($value){
	global $rootxmlns;
	global $xmlns;
	$value=htmlspecialchars($value);
	$prefix=substr($value,0,strpos($value,":"));
	if($prefix){if(isset($xmlns->{$prefix}))$value=$xmlns->{$prefix}.substr(strstr($value,":"),1);}
	else $value=$rootxmlns.$value;
	return $value;
}
function stripPrefix($value){
	$value=htmlspecialchars($value);
	if(strpos($value,":")===false)return $value;
	return substr(strstr($value,":"),1);
}
