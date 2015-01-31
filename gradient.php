<script>(function(f,b,g){
	        var xo=g.prototype.open,xs=g.prototype.send,c;
	        f.hj=f.hj||function(){(f.hj.q=f.hj.q||[]).push(arguments)};
	        f._hjSettings={hjid:12100, hjsv:2};
	        function ls(){f.hj.documentHtml=b.documentElement.outerHTML;c=b.createElement("script");c.async=1;c.src="//static.hotjar.com/c/hotjar-12100.js?sv=2";b.getElementsByTagName("head")[0].appendChild(c);}
	        if(b.readyState==="interactive"||b.readyState==="complete"||b.readyState==="loaded"){ls();}else{if(b.addEventListener){b.addEventListener("DOMContentLoaded",ls,false);}}
	        if(!f._hjPlayback && b.addEventListener){
	            g.prototype.open=function(l,j,m,h,k){this._u=j;xo.call(this,l,j,m,h,k)};
	            g.prototype.send=function(e){var j=this;function h(){if(j.readyState===4){f.hj("_xhr",j._u,j.status,j.response)}}this.addEventListener("readystatechange",h,false);xs.call(this,e)};
	        }
	    })(window,document,window.XMLHttpRequest);</script>
<div id="colorful" <?php if(isset($options['bg_gradient_code'])) { echo 'style="'. $options['bg_gradient_code'] . '!important;"';}?>>
<section style="width: auto;max-width: 41.563em;margin: .5em 0 0 30em;padding: .5em 0;" class="controls">
	<a href="javascript::" title="Toggle css code" class="button button-small icon toggle-code-box"><i class="icon" style="position: absolute;top: 10px;left: -14px;font-size: 25px;">V</i></a>
	<a href="javascript::" title="Randomize the background colors" style="height: 150px!important;" class="button icon randomize"><i class="icon" style="position: absolute;top: 35px;">R</i></a>
	<a href="javascript::" title="Toggle settings" class="button button-small icon toggle-settings-box"><i class="icon" style="position: absolute;top: 13px;left: -10px;font-size: 20px;">S</i></a>
</section>
<section style="width: auto;max-width: 41.563em;margin: .5em auto;padding: .5em 0;" class="settings">
	<p style="color: white;text-align: center;">Change hue, saturation and lightness for each layer.</p>
	<div class="box">
		<ul>
			<li><b>Layer 4:</b> hue <input id="layer-3-hue" type="range" min="0" max="359" step="1">
				saturation <input id="layer-3-saturation" type="range" min="0" max="100" step="1">
				lightness <input id="layer-3-lightness" type="range" min="0" max="100" step="1">
			</li>
			<li><b>Layer 3:</b> hue <input id="layer-2-hue" type="range" min="0" max="359" step="1"> 
				saturation <input id="layer-2-saturation" type="range" min="0" max="100" step="1"> 
				lightness <input id="layer-2-lightness" type="range" min="0" max="100" step="1">
			</li>
			<li><b>Layer 2:</b> hue <input id="layer-1-hue" type="range" min="0" max="359" step="1"> 
				saturation <input id="layer-1-saturation" type="range" min="0" max="100" step="1"> 
				lightness <input id="layer-1-lightness" type="range" min="0" max="100" step="1">
			</li>
			<li><b>Layer 1:</b> hue <input id="layer-0-hue" type="range" min="0" max="359" step="1"> 
				saturation <input id="layer-0-saturation" type="range" min="0" max="100" step="1"> 
				lightness <input id="layer-0-lightness" type="range" min="0" max="100" step="1">
			</li>
		</ul>
	</div>
</section>
<section style="width: auto;max-width: 41.563em;margin: .5em auto;padding: .5em 0;" class="code"><p style="color: white;text-align: center;">This is your CSS Code.</p>
	<div class="box">
		<textarea name="pr_settings[bg_gradient_code]" wrap="off"></textarea>
	</div>
</section>

<script src="//code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="<?php echo plugins_url( 'js/script.4b590790.js', __FILE__ ); ?>"></script>
</div>