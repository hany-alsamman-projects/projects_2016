    <div id="project_info">
    	<div id="title"><h2><b><?=$this->title?></b></h2></div>
        <div id="content"><?=$this->content?></div>
        <div id="more"></div>
    </div><!-- end project_info -->
      	
    <div style="margin:0 auto; " id="project<?=$_GET['my']?>"></div>
    
    <script type="text/javascript">
        // <![CDATA[
        var so = new SWFObject("images/monoslideshow.swf", "project<?=$_GET['my']?>", "100%", "500", "7", "#3f140c");
		so.addVariable("dataFile", "images/project<?=$_GET['my']?>.xml");
		so.addVariable("showLogo", "false");
        so.write("project<?=$_GET['my']?>");
        // ]]>
    </script>