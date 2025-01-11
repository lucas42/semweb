<?php
include("../inc/backend.php");
$backend=new Backend("Projects",true);
if($backend->extention=="owl")$backend->mimetype="application/rdf+xml";

$backend->data->Ontology->blank->comment="A vocabulary for theatrical data.  It defines concepts such as shows, productions, seasons etc.";
$backend->data->Ontology->blank->creator="http://lukeblaney.co.uk/#me";
$backend->data->Ontology->blank->priorVersion="http://bedlamtheatre.co.uk/schema#";
$backend->data->Class->Production->comment="The realisation of a theatrical work.";
$backend->data->Class->Production->subclassof="frbr:Expression";
$backend->data->Class->Season->comment="A collection of Productions and/or Performances";
$backend->data->Class->Season->examples="Edinburgh Fringe Festival 2010; Covent Garden Opera Company Season 1964/65";
$backend->data->Class->Position->comment="A set of responibilities.";
$backend->data->Class->Position->examples=array("http://en.wikipedia.org/wiki/Theatre_director" => "Director", "http://en.wikipedia.org/wiki/Composer" => "Composer", "Assistant Lighting Technician");
$backend->data->Class->{"participation:Role"}->comment="The occupation of a Position by an Agent for a particular Project.";
$backend->data->Class->Venue->comment="A Nestable Spatial Thing used for Theatrical Events.";
$backend->data->Class->Venue->subclassof="geo:SpatialThing";
$backend->data->Class->Venue->examples=array("http://www.fctt.org.uk/festival_theatre/" => "Edinburgh Festival Theatre", "http://www.shakespeares-globe.org/" => "The Globe");
$backend->data->Class->Workshop->comment="An event which involves participation, mainly with an educational focus.";
$backend->data->Class->Workshop->subclassof="ev:Event";
$backend->data->Class->Meeting->comment="An event which involves discussion/planning, often with a formal tone.";
$backend->data->Class->Meeting->subclassof="ev:Event";
$backend->data->Class->Rehersal->comment="An event which involves preparatory work for a Performance.";
$backend->data->Class->Rehersal->subclassof="ev:Event";
$backend->data->Class->Rehersal->status="archaic";
$backend->data->Class->Rehearsal->comment="An event which involves preparatory work for a Performance.";
$backend->data->Class->Rehearsal->subclassof="ev:Event";
$backend->data->Class->PressNight->subclassof="mo:Performance";
$backend->data->Class->PressNight->comment="A performance which reviewers are encouraged to attend.";
$backend->data->Class->RehersalReading->subclassof="mo:Performance";
$backend->data->Class->RehersalReading->comment="An unpolished performance in which the cast read from scripts.";
$backend->data->Class->RehersalReading->status="archaic";
$backend->data->Class->RehearsalReading->subclassof="mo:Performance";
$backend->data->Class->RehearsalReading->comment="An unpolished performance in which the cast read from scripts.";
$backend->data->Class->Portrayal->comment="A Position which involes portraying a Character.";
$backend->data->Class->Portrayal->subclassof="Position";
$backend->data->Class->AccessibilityProvision->comment="A Provision which makes an ev:Event more accessible";
$backend->data->Class->AccessibilityProvision->examples=array("http://en.wikipedia.org/wiki/British_Sign_Language" => "BSL signer", "http://en.wikipedia.org/wiki/Surtitles" => "Surtitles", "http://en.wikipedia.org/wiki/Audio_description" => "Audio Description");
$backend->data->Class->Voice->comment="The voice classification for a Singer or singing part.";
$backend->data->Class->Voice->subclassof="mo:Instrument";
$backend->data->Class->Voice->examples=array("http://en.wikipedia.org/wiki/Soprano" => "Soprano", "http://en.wikipedia.org/wiki/Contralto" => "Contralto", "http://en.wikipedia.org/wiki/Baritone" => "Baritone");
$backend->data->Class->ProductionCompany->comment="An Organisation which puts on Productions.";
$backend->data->Class->ProductionCompany->subclassof="foaf:Organization";
$backend->data->Class->ProductionCompany->examples=array("http://www.eno.org/" => "English National Opera", "http://eutc.org.uk/" => "Edinburgh University Theatre Company", "http://www.cirquedusoleil.com/" => "Cirque Du Soleil");
$backend->data->Class->Show->comment="The writing/devising which may enable a Production.";
$backend->data->Class->Show->subclassof="frbr:Work";
$backend->data->Class->Show->status = "archaic";
$backend->data->Class->PerformableProject->comment="A Project which intends to evoke a response from an Audience.";
$backend->data->Class->PerformableProject->subclassof="foaf:Project";
$backend->data->Class->PerformableProject->status = "archaic";

$backend->data->ObjectProperty->part_of_season->comment="Indicates that something is part of a season";
$backend->data->ObjectProperty->part_of_season->domain=array("Production", "Performance", "Season");
$backend->data->ObjectProperty->part_of_season->range="Season";
$backend->data->ObjectProperty->part_of_season->transitive = true;
$backend->data->ObjectProperty->production_of->comment="Indicates that a Production is an expression of a given work or production.";
$backend->data->ObjectProperty->production_of->domain="Production";
$backend->data->ObjectProperty->production_of->range=array("frbr:Work", "Production");
$backend->data->ObjectProperty->position->comment="Associates a Role with a Position.";
$backend->data->ObjectProperty->position->domain="participation:Role";
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
$backend->data->ObjectProperty->project->comment="Associates a Role with a Project.";
$backend->data->ObjectProperty->project->domain="participation:Role";
$backend->data->ObjectProperty->project->range=array("frbr:Work", "Production", "Season", "ev:Event");
$backend->data->ObjectProperty->project->inverseOf="credit";
$backend->data->ObjectProperty->credit->comment="Associates a Project with a Role.";
$backend->data->ObjectProperty->credit->domain=array("frbr:Work", "Production", "Season", "ev:Event");
$backend->data->ObjectProperty->credit->range="participation:Role";
$backend->data->ObjectProperty->credit->inverseOf="project";
$backend->data->ObjectProperty->credit->status="unstable";
$backend->data->ObjectProperty->portrays->comment="Associates a Portrayal with a Character.";
$backend->data->ObjectProperty->portrays->domain="Portrayal";
$backend->data->ObjectProperty->portrays->range="omb:Character";
$backend->data->ObjectProperty->performance->comment="Associates a Production with a Performance.";
$backend->data->ObjectProperty->performance->domain="Production";
$backend->data->ObjectProperty->performance->range="Performance";
$backend->data->ObjectProperty->performance->subpropertyof="event";
$backend->data->ObjectProperty->performance->inverseOf="performance_of";
$backend->data->ObjectProperty->performance_of->comment="Associates a Production with a Performance.";
$backend->data->ObjectProperty->performance_of->domain="Performance";
$backend->data->ObjectProperty->performance_of->range="Production";
$backend->data->ObjectProperty->performance_of->inverseOf="performance";
$backend->data->ObjectProperty->put_on_by->domain="Production";
$backend->data->ObjectProperty->put_on_by->range="ProductionCompany";
$backend->data->ObjectProperty->put_on_by->comment="The Company which puts on a Production";
$backend->data->ObjectProperty->sponsor->domain=array("Production", "Performance");
$backend->data->ObjectProperty->sponsor->range="foaf:Agent";
$backend->data->ObjectProperty->sponsor->comment="The Person or Organisation who sponsors a given production or performance";
$backend->data->ObjectProperty->audience_restriction->domain="Performance";
$backend->data->ObjectProperty->audience_restriction->range="xsd:string";
$backend->data->ObjectProperty->audience_restriction->comment="A restriction on who can attend a particular performance";
$backend->data->ObjectProperty->audience_restriction->examples="Schools only performance; Adult Audience Only";
$backend->data->ObjectProperty->time_of_day->domain="Performance";
$backend->data->ObjectProperty->time_of_day->range="xsd:string";
$backend->data->ObjectProperty->time_of_day->comment="A human readable indication of when in the day a performance occurs";
$backend->data->ObjectProperty->time_of_day->examples="Matinée; Evening Performance; Morning Matinée";
$backend->data->ObjectProperty->accessibility_provision->domain="ev:Event";
$backend->data->ObjectProperty->accessibility_provision->range="AccessibilityProvision";
$backend->data->ObjectProperty->accessibility_provision->comment="Associates an Accessibility Provision with an Event";
$backend->data->ObjectProperty->recorded_for->domain="mo:Performance";
$backend->data->ObjectProperty->recorded_for->range="po:Broadcast";
$backend->data->ObjectProperty->recorded_for->comment="A performance recorded for either Simulcast or later broadcast.";
$backend->data->ObjectProperty->genre->domain="frbr:Work";
$backend->data->ObjectProperty->genre->range="mo:Genre";
$backend->data->ObjectProperty->genre->comment="Associates a Genre with a Work.";
$backend->data->ObjectProperty->genre->examples = array("http://en.wikipedia.org/wiki/Opera" => "Opera", "http://en.wikipedia.org/wiki/Improvisational_theatre" => "Imrov Comedy", "http://en.wikipedia.org/wiki/Pantomime" => "Panto", "http://en.wikipedia.org/wiki/Interpretive_dance" => "Interpretative Dance");
$backend->data->ObjectProperty->based_on->domain="frbr:Work";
$backend->data->ObjectProperty->based_on->range="frbr:Work";
$backend->data->ObjectProperty->based_on->comment="Indicates a Work that another Work was based on .";
$backend->data->ObjectProperty->based_on->examples = "The Ballet of Romeo and Juliet by Prokofiev is based on the play of the same name by Shakespeare.";
$backend->data->ObjectProperty->scored_voice->domain="omb:Character";
$backend->data->ObjectProperty->scored_voice->range="Voice";
$backend->data->ObjectProperty->scored_voice->comment="Indicates the voice classification that a particular Operatic character has been written for.";
$backend->data->ObjectProperty->scored_voice->examples = "";
$backend->data->ObjectProperty->premiere->domain = array("Production");
$backend->data->ObjectProperty->premiere->range = "mo:Performance";
$backend->data->ObjectProperty->premiere->comment = "Indicates the first performance of a Show or Production in a particular area.";
$backend->data->ObjectProperty->premiere->status="unstable";
$backend->data->ObjectProperty->worldPremiere->domain = array("Production");
$backend->data->ObjectProperty->worldPremiere->range = "mo:Performance";
$backend->data->ObjectProperty->worldPremiere->comment = "Indicates the first performance of a Show or Production on a particular planet.";
$backend->data->ObjectProperty->worldPremiere->subpropertyof = "premiere";
$backend->data->ObjectProperty->worldPremiere->status="unstable";

// Archaic:
$backend->data->ObjectProperty->production->comment="Associates a Season with a Production.";
$backend->data->ObjectProperty->production->domain="Season";
$backend->data->ObjectProperty->production->range="Production";
$backend->data->ObjectProperty->production->status="archaic";
$backend->data->ObjectProperty->manifestation->comment="Associates a Performableproject with a Production.";
$backend->data->ObjectProperty->manifestation->domain="Performableproject";
$backend->data->ObjectProperty->manifestation->range="Production";
$backend->data->ObjectProperty->manifestation->status="archaic";
$backend->data->ObjectProperty->primary_season->comment="Associates a production with its commissioning season.";
$backend->data->ObjectProperty->primary_season->domain="Production";
$backend->data->ObjectProperty->primary_season->range="Season";
$backend->data->ObjectProperty->primary_season->status="archaic";
$backend->data->ObjectProperty->parent_season->domain="Season";
$backend->data->ObjectProperty->parent_season->range="Season";
$backend->data->ObjectProperty->parent_season->status="archaic";
$backend->data->ObjectProperty->parent_season->comment="Associates a season with its commissioning season.";
$backend->data->ObjectProperty->agent->comment="Associates a Role with an Agent.";
$backend->data->ObjectProperty->agent->domain="participation:Role";
$backend->data->ObjectProperty->agent->range="foaf:Agent";
$backend->data->ObjectProperty->agent->sameas="participation:holder";
$backend->data->ObjectProperty->agent->status="archaic";


if($backend->mimetype!="application/rdf+xml"){
	$backend->addTitle("Theatre Ontology");
	$backend->addText("An ontology for organising theatrical data.");
	$backend->addOutput("<img src=\"theatre-schema\" alt=\"\" class=\"blockimg\"/>");
}
$rootxmlns="http://purl.org/theatre#";
include('../inc/ont.inc');

