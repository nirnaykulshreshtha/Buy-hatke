<?php
/**
 * Created by IntelliJ IDEA.
 * User: daner
 * Date: 10/19/2016
 * Time: 9:40 AM
 */
?>
<section id="section_data">
    <div class="col-xs-8 col-xs-offset-1 ">
        <!--<input type="text" name="find_mobile" id="find_mobile" placeholder="Search Mobile" class="form-control"/>-->
        <div id="result_table" class=""></div>
        <?php
            foreach ($data as $row){
                print_r("<div class='col-sm-4'>
                            <div class='row'>
                                <div class='thumbnail left'>
                                    <a href=".$row['product_href']." "."target='_blank'>
                                        <img src=".$row['product_imgsrc'].">
                                    <div class='caption'> 
                                        <h4>".$row['product_name']."</h4>
                                        <p>".$row['product_price'].".00</p>
                                        <p>@".$row['product_source']."</p>
                                    </div>
                                    </a>
                                </div>
                            </div>
                        </div>");
                //print_r ($row['product_name']);
            }
        ?>
    </div>
</section>
<script>$(function(){
        $("#find_mobile").autocomplete({
            source: "http://localhost/Buy-hatke/find_mobile/get_mob" // path to the find_mobile method
        });
    });</script>
</body>
</html>
