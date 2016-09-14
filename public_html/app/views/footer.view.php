<footer class="stretchFooter">
<div id="footer">
    <div style="padding-top: 20px; padding-bottom: 20px; font-style: italic;">  
       <div class="footer">
        <div class="row text-center">      
          <p>Copyright © 2016-2016 by DipArt</p>
          <br>
          <br>
        </div>    
       </div>
    </div>
</div>
</footer>   
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/static/js/bootstrap.min.js"></script>
    <?
        if($_GET['page'] == "upload"){
            echo"<script src='/static/js/auction.js'></script>";
        }
        elseif($_GET['page'] == "journals"){
            echo"<script src='/static/js/journal.js'></script>";
        }
        elseif($_GET['page'] == "commissions" || $_GET['page'] == "transactions" || $_GET['page'] == "profile"){
            echo"<script src='/static/js/commissions.js'></script>";
        }
        elseif($_GET['page'] == "conversation"){
            echo"<script src='/static/js/messages.js'></script>";
        }        
    
        ?>

        <script src='/static/js/jquery.justifiedGallery.min.js'></script>
        
        <?
        if($_GET['page'] != "upload"){
        ?>
        <script type="text/javascript">
                $('#myGallery').justifiedGallery({
                rowHeight : 230,
                maxRowHeight: 320,
                lastRow : 'nojustify',
                margins : 5
                });
        </script>
        <?
        } else { ?>
        <script type="text/javascript">
                $('#myGallery').justifiedGallery({
                rowHeight : 180,
                maxRowHeight: 220,
                lastRow : 'nojustify',
                margins : 5
                });
        </script>
        <? } ?>
  </body>
</html>