<?php
// Interface for abstraction between MasterPage class and HtmlTemplate

interface ITemplate {
	
	function setTemplate($filename);
	function getHTML($params);
}

