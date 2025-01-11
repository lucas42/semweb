<?php
require_once("conneg.php");
class Backend{
	private $output;
	function __construct($navpage=null,$rdfavail=false,$pdfavail=false) {
		$this->uri=$_SERVER['REQUEST_URI'];
		if(strpos($this->uri,"."))$this->noext=substr($this->uri,0,strpos($this->uri,"."));
		else $this->noext=$this->uri;
		$pages = explode('/', trim($this->uri, '/'));
		$this->subpage = (count($pages) > 1)?$pages[1]:null;
		$this->subsubpage = (count($pages) > 2)?$pages[2]:null;
		$this->extention=substr($this->uri,strrpos($this->uri,".")+1);
		$conq="application/xhtml+xml,text/html";
		$this->rdfavail=$rdfavail;
		$this->pdfavail=$pdfavail;
		if($this->rdfavail)$conq="application/rdf+xml, ".$conq;
		$conneg = new contentNegotiation();
		switch($this->extention){
			case "xml":
				$this->mimetype="application/xml";
			break;
			case "xhtml":
				$this->mimetype="application/xhtml+xml";
			break;
			case "html":
				$this->mimetype="text/html";
			break;
			case "rdf":
				$this->mimetype="application/rdf+xml";
			break;
			case "rss":
				$this->mimetype="application/rss+xml";
			break;
			case "pdf":
				$this->mimetype="application/pdf";
			break;
			case "ajax":
				$this->mimetype="application/ajax+xml";
			break;
			default:

				// If its IE,  then ignore what it tells us, because it lies.  Just send it html
				if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false) {
					$this->mimetype = 'text/html';
					break;
				}
				$this->mimetype=trim($conneg->compareQ($conq));
		}
		$this->charset="UTF-8";
		$this->title="Luke Blaney";
		$this->navpage=$navpage;
		$this->lang=$conneg->compareQ('en,ga', 'language');
		file_put_contents ('/srv/lukeblaney.co.uk/tmplog', $_SERVER['HTTP_ACCEPT']."|{$this->extention}|{$this->mimetype}\n", FILE_APPEND);
		file_put_contents ('/srv/lukeblaney.co.uk/tmplang', $_SERVER['HTTP_ACCEPT_LANGUAGE']."|{$this->lang}\n", FILE_APPEND);
	}
	function addTitle($title,$hh=1,$url=null,$clear=false){
		if($clear)$style=" style=\"clear:both\"";
		if($hh){
			$this->addOutput("<h{$hh}{$id}{$style}>");
			if($url)$this->addOutput("<a href=\"".htmlspecialchars($url)."\">");
			$this->addText($title);
			if($url)$this->addOutput("</a>");
			$this->addOutput("</h{$hh}>");
		}
		if($hh<2)$this->title.=" | ".$title;
	}
	function addOutput($output,$tag=null){
		if($tag)$this->output.="\n<".$tag.">";
		$this->output.=$output;
		if($tag)$this->output.="</".$tag.">";
	}
	function addText($text,$tag=null){
		$this->addOutput(htmlspecialchars($text),$tag);
	}
	function addWarning($text){
		$this->addOutput("<div class=\"warning\">");
		$this->addText($text);
		$this->addOutput("</div>");
	}
	function redirect($url){
		header("Status: 301 Moved");
		if(stripos($url,"://")===false)$url="http://".$_SERVER['HTTP_HOST'].$url;
		header("Location: ".$url);
		exit;
	}
	function printit(){
		header("Content-Type: {$this->mimetype};charset={$this->charset}\n\n");
		if ($this->mimetype=="application/xhtml+xml"||$this->mimetype=="text/html") include("header.php");
		print $this->output;
		if ($this->mimetype=="application/xhtml+xml"||$this->mimetype=="text/html") include("footer.php");
		exit;
	}
}
