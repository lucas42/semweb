<?php ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title><?= $title ?></title>
	<link rel="stylesheet" type="text/css" href="/style" />
</head>
<body>
	<header>
		<span id="me">
			<a href="/">Luke's Semantic Web Sandbox</a>
		</span>
		<span id="about"></span>
		<nav id="mainnav">
			<ul>
				<li<? if ($_SERVER['REQUEST_URI'] == "/") print ' class="currentpage"'; ?>><a href="/" title="Luke's Semantic Web Sandbox">Welcome</a></li>
				<li<? if ($_SERVER['REQUEST_URI'] == "/theatre") print ' class="currentpage"'; ?>><a href="/theatre">Theatre Ontology</a></li>
				<li<? if ($_SERVER['REQUEST_URI'] == "/audience") print ' class="currentpage"'; ?>><a href="/audience">Audience Ontology</a></li>
			</ul>
		</nav>
	</header>
	<main>