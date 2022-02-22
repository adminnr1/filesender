            <div id="footer">
                {tr:site_footer}
                
                <?php if(Disclosed::isDisclosed('version')) { ?>
                <div class="version"><?php echo Version::code() ?></div>
                <?php } ?>
            <?php
                //if(Config::get('site_showStats')) $versionDisplay .= $functions->getStats(); // TODO
            ?>
            </div>
            <!-- Mopinion Pastea.se  start -->
              <script type="text/javascript">(function(){var id="H2vABiB1k10dbZWtGMUlTzSUJwIkmhjl8q1Qbaxv";var js=document.createElement("script");js.setAttribute("type","text/javascript");js.setAttribute("src","//deploy.mopinion.com/js/pastease.js");js.async=true;document.getElementsByTagName("head")[0].appendChild(js);var t=setInterval(function(){try{Pastease.load(id);clearInterval(t)}catch(e){}},50)})();</script>
            <!-- Mopinion Pastea.se end -->
        </div>
        
        <!-- Version <?php //echo FileSender_Version::VERSION; ?> -->
    </body>
</html>
