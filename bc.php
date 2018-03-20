<!doctype html>
<html>

<meta charset="utf-8">

<link rel="stylesheet" type="text/css" href="./EAN 13   SYMBOLOGY, SPECIFICATION, EXPLICATION, CHECKSUM_files/style.css">
<script async type="text/javascript" src="./EAN 13   SYMBOLOGY, SPECIFICATION, EXPLICATION, CHECKSUM_files/ca-pub-0877034056922383.js"></script><script type="text/javascript" src="./EAN 13   SYMBOLOGY, SPECIFICATION, EXPLICATION, CHECKSUM_files/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="./EAN 13   SYMBOLOGY, SPECIFICATION, EXPLICATION, CHECKSUM_files/jquery-ui-1.7.custom.min.js"></script>
<script type="text/javascript" src="./EAN 13   SYMBOLOGY, SPECIFICATION, EXPLICATION, CHECKSUM_files/jquery-barcode-last.min.js"></script>
<script type="text/javascript">
var menuTimer = [];
						var menuLocked = [];
						function menuHideAndLockYoyo($this){
							var id = $this.attr("id");
							menuLocked[id] = true;
							clearTimeout(menuTimer[id]);
							$(".menu-item-block", $this).slideUp("fast", function(){setTimeout("menuLocked['"+$(this).parent().attr("id")+"'] = false;", 20);});
						}
function computeEAN13(value){
			var sum = 0,
				odd = true;
			for(i=11; i>-1; i--){
				sum += (odd ? 3 : 1) * parseInt(value.charAt(i));
				odd = ! odd;
			}
			return (10 - sum % 10) % 10;
		}
$(function(){
$(".menu-item").each(function(){
									menuLocked[$(this).attr("id")] = false;
									$(this).hover(
										function(){
											var $this = $(this);
											var id = $this.attr("id");
											if ( menuLocked[id] ) return;
											$(".menu-item-block", $this).slideDown("fast");
											menuTimer[id] = setTimeout("menuHideAndLockYoyo($(\"#" + id + "\"));", 15000);
										},
										function(){
											menuHideAndLockYoyo($(this));
										}
									);
								});
								
								$(".menu-item-block-item")
									.click(function(){ window.location.href = $("a", $(this)).attr("href"); })
									.hover(function(){$(this).addClass("hover");}, function(){$(this).removeClass("hover");});
									
									
								$(".language")
								    .each(function(){
								        var $this = $(this);
								        var url = $("a", $this).attr("href");
								        $this.click(function(){ window.location.href = url });
								        $this.html("");
								    });
$("#ean13Message")
			.keyup(function(){
				var $this = $(this),
					text = $this.val(),
					filtered = "",
					c = '';
				for(var i=0; i<text.length; i++){
					c = text.charAt(i);
					if ( (c >= '0') && (c <= '9') ){
						filtered += c;
					}
				}
				$this.val(filtered);
				if (filtered.length == 12){
					$("#ean13Checksum").html( computeEAN13(filtered) );
				} else {
					$("#ean13Checksum").html("");
				}
			});
		
		$("#ean13Target").barcode("2109876543210", "ean13");
		
		$("#ean13generator")
			.keyup(function(){
				var $this = $(this),
					text = $this.val(),
					filtered = "",
					c = '';
				for(var i=0; i<text.length; i++){
					c = text.charAt(i);
					if ( (c >= '0') && (c <= '9') ){
						filtered += c;
					}
				}
				$this.val(filtered);
				if (filtered.length >= 12){
					$("#ean13Target").barcode(filtered, "ean13");
				} else {
					$("#ean13Target").html("");
				}
			});});</script>
            
      
            <head></head><body>
<h2>Online EAN 13 barcode generator</h2>
<p>Please fill in the code : 

<input type="text" id="ean13generator" maxlength="12" value="210987654321"></p>

<div id="ean13Target" class="barcodeTarget" style="padding: 0px; overflow: auto; width: 115px;">

<div style="float: left; font-size: 0px; background-color: #FFFFFF; height: 50px; width: 10px"></div><div style="float: left; font-size: 0px; width:0; border-left: 1px solid #000000; height: 50px;"></div><div style="float: left; font-size: 0px; background-color: #FFFFFF; height: 50px; width: 1px"></div><div style="float: left; font-size: 0px; width:0; border-left: 1px solid #000000; height: 50px;"></div><div style="float: left; font-size: 0px; background-color: #FFFFFF; height: 50px; width: 2px"></div><div style="float: left; font-size: 0px; width:0; border-left: 1px solid #000000; height: 50px;"></div><div style="float: left; font-size: 0px; background-color: #FFFFFF; height: 50px; width: 2px"></div><div style="float: left; font-size: 0px; width:0; border-left: 2px solid #000000; height: 50px;"></div><div style="float: left; font-size: 0px; background-color: #FFFFFF; height: 50px; width: 1px"></div><div style="float: left; font-size: 0px; width:0; border-left: 4px solid #000000; height: 50px;"></div><div style="float: left; font-size: 0px; background-color: #FFFFFF; height: 50px; width: 1px"></div><div style="float: left; font-size: 0px; width:0; border-left: 1px solid #000000; height: 50px;"></div><div style="float: left; font-size: 0px; background-color: #FFFFFF; height: 50px; width: 2px"></div><div style="float: left; font-size: 0px; width:0; border-left: 3px solid #000000; height: 50px;"></div><div style="float: left; font-size: 0px; background-color: #FFFFFF; height: 50px; width: 1px"></div><div style="float: left; font-size: 0px; width:0; border-left: 1px solid #000000; height: 50px;"></div><div style="float: left; font-size: 0px; background-color: #FFFFFF; height: 50px; width: 1px"></div><div style="float: left; font-size: 0px; width:0; border-left: 2px solid #000000; height: 50px;"></div><div style="float: left; font-size: 0px; background-color: #FFFFFF; height: 50px; width: 3px"></div><div style="float: left; font-size: 0px; width:0; border-left: 1px solid #000000; height: 50px;"></div><div style="float: left; font-size: 0px; background-color: #FFFFFF; height: 50px; width: 3px"></div><div style="float: left; font-size: 0px; width:0; border-left: 1px solid #000000; height: 50px;"></div><div style="float: left; font-size: 0px; background-color: #FFFFFF; height: 50px; width: 2px"></div><div style="float: left; font-size: 0px; width:0; border-left: 1px solid #000000; height: 50px;"></div><div style="float: left; font-size: 0px; background-color: #FFFFFF; height: 50px; width: 2px"></div><div style="float: left; font-size: 0px; width:0; border-left: 1px solid #000000; height: 50px;"></div><div style="float: left; font-size: 0px; background-color: #FFFFFF; height: 50px; width: 3px"></div><div style="float: left; font-size: 0px; width:0; border-left: 1px solid #000000; height: 50px;"></div><div style="float: left; font-size: 0px; background-color: #FFFFFF; height: 50px; width: 1px"></div><div style="float: left; font-size: 0px; width:0; border-left: 1px solid #000000; height: 50px;"></div><div style="float: left; font-size: 0px; background-color: #FFFFFF; height: 50px; width: 1px"></div><div style="float: left; font-size: 0px; width:0; border-left: 1px solid #000000; height: 50px;"></div><div style="float: left; font-size: 0px; background-color: #FFFFFF; height: 50px; width: 1px"></div><div style="float: left; font-size: 0px; width:0; border-left: 3px solid #000000; height: 50px;"></div><div style="float: left; font-size: 0px; background-color: #FFFFFF; height: 50px; width: 1px"></div><div style="float: left; font-size: 0px; width:0; border-left: 1px solid #000000; height: 50px;"></div><div style="float: left; font-size: 0px; background-color: #FFFFFF; height: 50px; width: 2px"></div><div style="float: left; font-size: 0px; width:0; border-left: 3px solid #000000; height: 50px;"></div><div style="float: left; font-size: 0px; background-color: #FFFFFF; height: 50px; width: 1px"></div><div style="float: left; font-size: 0px; width:0; border-left: 1px solid #000000; height: 50px;"></div><div style="float: left; font-size: 0px; background-color: #FFFFFF; height: 50px; width: 2px"></div><div style="float: left; font-size: 0px; width:0; border-left: 1px solid #000000; height: 50px;"></div><div style="float: left; font-size: 0px; background-color: #FFFFFF; height: 50px; width: 1px"></div><div style="float: left; font-size: 0px; width:0; border-left: 1px solid #000000; height: 50px;"></div><div style="float: left; font-size: 0px; background-color: #FFFFFF; height: 50px; width: 4px"></div><div style="float: left; font-size: 0px; width:0; border-left: 1px solid #000000; height: 50px;"></div><div style="float: left; font-size: 0px; background-color: #FFFFFF; height: 50px; width: 1px"></div><div style="float: left; font-size: 0px; width:0; border-left: 1px solid #000000; height: 50px;"></div><div style="float: left; font-size: 0px; background-color: #FFFFFF; height: 50px; width: 4px"></div><div style="float: left; font-size: 0px; width:0; border-left: 1px solid #000000; height: 50px;"></div><div style="float: left; font-size: 0px; background-color: #FFFFFF; height: 50px; width: 1px"></div><div style="float: left; font-size: 0px; width:0; border-left: 3px solid #000000; height: 50px;"></div><div style="float: left; font-size: 0px; background-color: #FFFFFF; height: 50px; width: 2px"></div><div style="float: left; font-size: 0px; width:0; border-left: 3px solid #000000; height: 50px;"></div><div style="float: left; font-size: 0px; background-color: #FFFFFF; height: 50px; width: 2px"></div><div style="float: left; font-size: 0px; width:0; border-left: 1px solid #000000; height: 50px;"></div><div style="float: left; font-size: 0px; background-color: #FFFFFF; height: 50px; width: 1px"></div><div style="float: left; font-size: 0px; width:0; border-left: 1px solid #000000; height: 50px;"></div><div style="float: left; font-size: 0px; background-color: #FFFFFF; height: 50px; width: 1px"></div><div style="float: left; font-size: 0px; width:0; border-left: 1px solid #000000; height: 50px;"></div><div style="float: left; font-size: 0px; background-color: #FFFFFF; height: 50px; width: 10px"></div><div style="clear:both; width: 100%; background-color: #FFFFFF; color: #000000; text-align: center; font-size: 10px; margin-top: 5px;"></div></div>
<div id="google2">

</div>
<div id="googleRight">

				


</body>
</html>
