<form role="search" method="get" id="searchform" action="<?php echo home_url('/'); ?>">
    <div class="search-box">		
        <div class="search-input">
            <input type="text" value="" name="s" id="s" placeholder="<?php //_e('Search', 'jawtemplates'); ?>">
        </div>

        <div class="search-button">
            <button type="submit" id="searchsubmit" value="" class=""><span></span></button>
        </div>
    </div>
</form>