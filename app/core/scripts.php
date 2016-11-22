<?php

class Script 
{
	
	public function set($url)
	{
		if(file_exists($url))
			return "
<script>
".file_get_contents($url)."
</script>";
	}

	
}