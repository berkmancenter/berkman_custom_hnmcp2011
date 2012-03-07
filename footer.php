      <div class="endFloat"></div>
    </div>
    <!-- end of content -->
    
    
  </div>
  <!-- end of wrapper-page -->
  <div id="footer"><div class="floatbox-980" id="footer-content">
    <div id="footer-inner-1"><div id="footer-inner-2">
    
      <?php $footerInfo = get_page_by_title( 'Footer' );
	setup_postdata($footerInfo);
	the_content(); ?>

    
    </div></div>
  </div><!-- end of footer inner --></div> <!-- end of footer --> 
</div>
<!-- end of wrapper-html -->
<?php wp_footer(); ?>
</body>
</html>