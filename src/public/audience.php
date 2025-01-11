<?php
include("../inc/init.php");
$backend=new Backend("Projects",true);
if($backend->extention=="owl")$backend->mimetype="application/rdf+xml";

$backend->data->Ontology->blank->comment="A vocabulary for linking audiences to Entertainment";
$backend->data->Ontology->blank->creator="http://lukeblaney.co.uk/#me";

$backend->data->Class->Entertainment->comment="A distinct creation intended to be consumed by an audience";
$backend->data->Class->{"po:Episode"}->subclassof="Entertainment";
$backend->data->Class->{"thea:Production"}->subclassof="Entertainment";
$backend->data->Class->{"mo:MusicalWork"}->subclassof="Entertainment";
$backend->data->Class->EntertainmentEvent->comment="An Event in which an audience can consume Entertainment";
$backend->data->Class->EntertainmentEvent->subclassof="event:Event";
$backend->data->Class->{"po:Broadcast"}->subclassof="EntertainmentEvent";
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
$backend->data->ObjectProperty->{"mo:performance_of"}->subpropertyof="eventOf";
if($backend->mimetype!="application/rdf+xml"){
	$backend->addTitle("Audience Ontology");
	$backend->addText("NB: This whole ontolgy is highly unstable for now.  Any feedback is appreciated.","p");
	$backend->addOutput("<img src=\"audience-schema\" alt=\"Schema Diagram\" style=\"max-width:100%\"/>");
}
$rootxmlns="http://purl.org/audience#";
include('../inc/ont.inc');
