<?php
include("../backend/init.php");
$backend=new Backend("Projects",true);
if($backend->extention=="owl")$backend->mimetype="application/rdf+xml";

$backend->data->Ontology->blank->comment="A vocabulary for linking audiences to Entertainment";
$backend->data->Ontology->blank->creator="http://lukeblaney.co.uk/#me";

$backend->data->Class->Entertainment->comment="A distinct creation intended to be consumed by an audience";
//$backend->data->Class->{"po:Episode"}->comment="A particular episode, e.g. `Top Gear, first episode of the first series' or the film 'A Walk in the Sun'";
$backend->data->Class->{"po:Episode"}->subclassof="Entertainment";
//$backend->data->Class->{"thea:Production"}->comment="A theatrical Production.";
$backend->data->Class->{"thea:Production"}->subclassof="Entertainment";
//$backend->data->Class->{"mo:MusicalWork"}->comment="Distinct intellectual or artistic musical creation.";
$backend->data->Class->{"mo:MusicalWork"}->subclassof="Entertainment";
$backend->data->Class->EntertainmentEvent->comment="An Event in which an audience can consume Entertainment";
$backend->data->Class->EntertainmentEvent->subclassof="event:Event";
//$backend->data->Class->{"po:Broadcast"}->comment="A broadcast event.";
$backend->data->Class->{"po:Broadcast"}->subclassof="EntertainmentEvent";
//$backend->data->Class->{"mo:Performance"}->comment="A performance event.";
$backend->data->Class->{"mo:Performance"}->subclassof="EntertainmentEvent";
$backend->data->Class->Audience->comment="The group of agents who consumed Entertainment at an EntertaimentEvent";
$backend->data->Class->Audience->subclassof="foaf:Group";
$backend->data->Class->AudienceFigure->comment="An attempt to measure the number of people in an Audience";



$backend->data->ObjectProperty->audience->comment="Associates an Entertainment Event with its Audience";
$backend->data->ObjectProperty->audience->domain="EntertainmentEvent";
$backend->data->ObjectProperty->audience->range="Audience";
$backend->data->ObjectProperty->audience->subpropertyof="dcterms:audience";
$backend->data->ObjectProperty->consumed->comment="Associates an Agent with Entertainment that they have consumed.";
$backend->data->ObjectProperty->consumed->domain="foaf:Agent";
$backend->data->ObjectProperty->consumed->range="Entertainment";
$backend->data->ObjectProperty->figure->comment="Associates an Audience Figure with an Audience";
$backend->data->ObjectProperty->figure->domain="Audience";
$backend->data->ObjectProperty->figure->range="AudienceFigure";
$backend->data->ObjectProperty->size->comment="The measured size of an Audience";
$backend->data->ObjectProperty->size->domain="AudienceFigure";
$backend->data->ObjectProperty->size->range="xsd:integer";
$backend->data->ObjectProperty->source->comment="The source for an Audience Figure";
$backend->data->ObjectProperty->source->domain="AudienceFigure";
$backend->data->ObjectProperty->source->range="foaf:Document";
$backend->data->ObjectProperty->audienceMember->comment="Relates an Audience to an Agent who is a member of that Audience";
$backend->data->ObjectProperty->audienceMember->domain="Audience";
$backend->data->ObjectProperty->audienceMember->range="foaf:Agent";
$backend->data->ObjectProperty->audienceMember->subpropertyof="foaf:member";
$backend->data->ObjectProperty->eventOf->comment="Relates an Entertainment Event to the instance of Entertainment";
$backend->data->ObjectProperty->eventOf->domain="EntertainmentEvent";
$backend->data->ObjectProperty->eventOf->range="Entertainment";
//$backend->data->ObjectProperty->{"mo:performance_of"}->comment="Associates a Performance to a musical work or an arrangement that is being used as a factor in it.";
$backend->data->ObjectProperty->{"mo:performance_of"}->subpropertyof="eventOf";
/*
$backend->data->ObjectProperty->->comment="";
$backend->data->ObjectProperty->->domain="";
$backend->data->ObjectProperty->->range="";
*/
if($backend->mimetype!="application/rdf+xml"){
	$backend->addTitle("Audience Ontology");
	$backend->addText("NB: This whole ontolgy is highly unstable for now.  Any feedback is appreciated.","p");
	$backend->addOutput("<img src=\"audience-schema\" alt=\"Schema Diagram\" style=\"max-width:100%\"/>");
}
$rootxmlns="http://purl.org/audience#";
include('../backend/ont.inc');
/*
$backend->data->Class->PerformableProject->comment="A Project which intends to evoke a response from an Audience.";
$backend->data->Class->PerformableProject->subclassof="foaf:Project";
$backend->data->Class->Production->comment="The manifestation of a performable project.";
$backend->data->Class->Production->subclassof="PerformableProject";
$backend->data->Class->Show->comment="The writing/devising which may enable a Production.";
$backend->data->Class->Show->subclassof="PerformableProject";
$backend->data->Class->Season->comment="A Project over a period of time which may involve a number of Productions.";
$backend->data->Class->Season->subclassof="foaf:Project";
$backend->data->Class->Position->comment="A set of responibilities.";
$backend->data->Class->Role->comment="The occupation of a Position by an Agent for a particular Project.";
$backend->data->Class->Role->sameas="participation:Role";
$backend->data->Class->Venue->comment="A Nestable Spatial Thing used for Theatrical Events.";
$backend->data->Class->Venue->subclassof="geo:SpatialThing";
$backend->data->Class->Workshop->comment="An event which involves participation, mainly with an educational focus.";
$backend->data->Class->Workshop->subclassof="ev:Event";
$backend->data->Class->Meeting->comment="An event which involves discussion/planning, often with a formal tone.";
$backend->data->Class->Meeting->subclassof="ev:Event";
$backend->data->Class->Rehersal->comment="An event which involves preparatory work for a Performance.";
$backend->data->Class->Rehersal->subclassof="ev:Event";
$backend->data->Class->SeasonType->comment="A type of Season.";
$backend->data->Class->ProductionType->comment="A type of Production.";
$backend->data->Class->Character->comment="A Fictional Agent.";
$backend->data->Class->Character->subclassof="foaf:Agent";
$backend->data->Class->Portrayal->comment="A Position which involes portraying a Character.";
$backend->data->Class->Portrayal->subclassof="Position";

$backend->data->ObjectProperty->production->comment="Associates a Season with a Production.";
$backend->data->ObjectProperty->production->domain="Season";
$backend->data->ObjectProperty->production->range="Production";
$backend->data->ObjectProperty->manifestation->comment="Associates a Performableproject with a Production.";
$backend->data->ObjectProperty->manifestation->domain="Performableproject";
$backend->data->ObjectProperty->manifestation->range="Production";
$backend->data->ObjectProperty->primary_season->comment="Associates a production with its commissioning season.";
$backend->data->ObjectProperty->primary_season->domain="Production";
$backend->data->ObjectProperty->primary_season->range="Season";
$backend->data->ObjectProperty->position->comment="Associates a Role with a Position.";
$backend->data->ObjectProperty->position->domain="Role";
$backend->data->ObjectProperty->position->range="Position";
$backend->data->ObjectProperty->venue->comment="Associates an Event with the Venue it is held in.";
$backend->data->ObjectProperty->venue->domain="Event";
$backend->data->ObjectProperty->venue->range="Venue";
$backend->data->ObjectProperty->venue->subpropertyof="ev:place";
$backend->data->ObjectProperty->parent_venue->comment="Associates a Venue with its containing Venue.";
$backend->data->ObjectProperty->parent_venue->domain="Venue";
$backend->data->ObjectProperty->parent_venue->range="Venue";
$backend->data->ObjectProperty->event->comment="Associates a Project with an Event.";
$backend->data->ObjectProperty->event->domain="foaf:Project";
$backend->data->ObjectProperty->event->range="ev:Event";
$backend->data->ObjectProperty->productionType->comment="Associates a Production with a ProductionType.";
$backend->data->ObjectProperty->productionType->domain="Production";
$backend->data->ObjectProperty->productionType->range="ProductionType";
$backend->data->ObjectProperty->seasonType->comment="Associates a Season with a SeasonType.";
$backend->data->ObjectProperty->seasonType->domain="Season";
$backend->data->ObjectProperty->seasonType->range="SeasonType";
$backend->data->ObjectProperty->parent_season->comment="Associates a season with its commissioning season.";
$backend->data->ObjectProperty->parent_season->domain="Season";
$backend->data->ObjectProperty->parent_season->range="Season";
$backend->data->ObjectProperty->project->comment="Associates a Role with a Project.";
$backend->data->ObjectProperty->project->domain="Role";
$backend->data->ObjectProperty->project->range="foaf:Project";
$backend->data->ObjectProperty->agent->comment="Associates a Role with an Agent.";
$backend->data->ObjectProperty->agent->domain="Role";
$backend->data->ObjectProperty->agent->range="foaf:Agent";
$backend->data->ObjectProperty->agent->sameas="participation:holder";
$backend->data->ObjectProperty->{"portrayal-of"}->comment="Associates a Portrayal with a Character.";
$backend->data->ObjectProperty->{"portrayal-of"}->domain="Portrayal";
$backend->data->ObjectProperty->{"portrayal-of"}->range="Character";
$backend->data->ObjectProperty->performance->comment="Associates a Production with a Performance.";
$backend->data->ObjectProperty->performance->domain="Production";
$backend->data->ObjectProperty->performance->range="Performance";
$backend->data->ObjectProperty->performance->subpropertyof="event";
*/

/*
$xmlns->dc="http://purl.org/dc/elements/1.1/";
$xmlns->dcterms="http://purl.org/dc/terms/";
//$xmlns->ev="http://purl.org/NET/c4dm/event.owl#";
$xmlns->foaf="http://xmlns.com/foaf/0.1/";
//$xmlns->frbr="http://purl.org/vocab/frbr/core#";
//$xmlns->geo="http://www.w3.org/2003/01/geo/wgs84_pos#";
$xmlns->mo="http://purl.org/ontology/mo/";
$xmlns->po="http://purl.org/ontology/po/";
$xmlns->owl="http://www.w3.org/2002/07/owl#";
$xmlns->rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#";
$xmlns->rdfs="http://www.w3.org/2000/01/rdf-schema#";
$xmlns->thea="http://purl.org/theatre#";
$xmlns->event="http://purl.org/NET/c4dm/event.owl#";
$xmlns->xsd="http://www.w3.org/2001/XMLSchema#";
//$xmlns->participation="http://purl.org/vocab/participation/schema#";

//$xmlns->skos="http://www.w3.org/2004/02/skos/core#";
//$xmlns->tags="http://www.holygoat.co.uk/owl/redwood/0.1/tags/";
//$xmlns->tl="http://purl.org/NET/c4dm/timeline.owl#";
//$xmlns->vs="http://www.w3.org/2003/06/sw-vocab-status/ns#";

//$backend->addHeaderLink('canonical',$rootxmlns);
if($backend->mimetype=="application/rdf+xml"){
$backend->addOutput('<?xml version="1.0" encoding="utf-8"?>'."\n");
$backend->addOutput("<rdf:RDF\n");
foreach($xmlns as $label=>$url){
	$backend->addOutput( "\txmlns:$label=\"$url\"\n");
}

   $backend->addOutput("\txmlns=\"$rootxmlns\" xml:base=\"$rootxmlns\">\n");
  
foreach($backend->data as $typename=>$itemtype){
	foreach($itemtype as $name=>$item){
		if($name=="blank")$name="";
		$label=htmlspecialchars($name);
		$name=escapeOutput($name);
		$backend->addOutput( "\t<owl:$typename rdf:about=\"".escapeOutput($name)."\">\n");
		if($item->comment)$backend->addOutput( "\t\t<rdfs:comment>".htmlspecialchars($item->comment)."</rdfs:comment>\n");
		if($label)$backend->addOutput( "\t\t<rdfs:label>".stripPrefix($label)."</rdfs:label>\n");
		if($item->creator)$backend->addOutput( "\t\t<dc:creator rdf:resource=\"".escapeOutput($item->creator)."\" />\n");
		if($item->subclassof)$backend->addOutput( "\t\t<rdfs:subClassOf rdf:resource=\"".escapeOutput($item->subclassof)."\" />\n");
		if($item->subpropertyof)$backend->addOutput( "\t\t<rdfs:subPropertyOf rdf:resource=\"".escapeOutput($item->subpropertyof)."\" />\n");
		if($item->domain)$backend->addOutput( "\t\t<rdfs:domain rdf:resource=\"".escapeOutput($item->domain)."\" />\n");
		if($item->range)$backend->addOutput( "\t\t<rdfs:range rdf:resource=\"".escapeOutput($item->range)."\" />\n");
		if($item->sameas)$backend->addOutput( "\t\t<owl:sameAs rdf:resource=\"".escapeOutput($item->sameas)."\" />\n");
		$backend->addOutput( "\t</owl:$typename>\n");
	}
	$backend->addOutput( "\n");
}

$backend->addOutput("</rdf:RDF>");
$backend->printit();
}
$backend->addTitle("Audience Ontology");
$backend->addText("NB: This whole ontolgy is highly unstable for now.  Any feedback is appreciated.","p");
$backend->addOutput("<img src=\"audience-schema\" alt=\"Schema Diagram\" style=\"max-width:100%\"/>");
foreach($backend->data as $typename=>$itemtype){
	foreach($itemtype as $name=>$item){
		if($name=="blank")continue;
		$backend->addOutput("<div id=\"".htmlspecialchars($name)."\" class=\"schemabox\">");
		$backend->addOutput(htmlspecialchars($typename).": ".linktoitem($name),"h3");
		if($item->comment)$backend->addText($item->comment);
		if($item->subclassof)$backend->addOutput("<div>Subclass Of: ".linktoitem($item->subclassof)."</div>");
		if($item->subpropertyof)$backend->addOutput("<div>Subproperty Of: ".linktoitem($item->subpropertyof)."</div>");
		if($item->range)$backend->addOutput("<div>Range: ".linktoitem($item->range)."</div>");
		if($item->domain)$backend->addOutput("<div>Domain: ".linktoitem($item->domain)."</div>");
		if($item->sameas)$backend->addOutput("<div>Same as: ".linktoitem($item->sameas)."</div>");
		$backend->addOutput("</div>\n");
	}
}

$backend->printit();

function linktoitem($name){
	global $xmlns;
	$url=htmlspecialchars($name);
	if (strpos($url,":")!==false){
		$ontology=substr($url,0,strpos($url,":"));
		if(isset($xmlns->{$ontology})){
			$url=substr($url,strrpos($url,":")+1);
			$url=$xmlns->{$ontology}.$url;
		}
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
}*/
