<div id="box1" class="box box-50"><!-- box full-width -->
					<div class="boxin">
						<div class="header">
							<h3>Shopping Cart</h3>
						</div>
						<div id="box1-tabular" class="content"><!-- content box 1 for tab switching -->
								<fieldset>

									<?php
                                    
                                        if(ORDERS::EMPTY_CART() == true){
                                            
                                            echo '<div class="msg msg-ok" style="margin: 15px; width: 80%;"><p>Your Shopping Cart Empty Now !</p></div>';
                                        }else{
                                            echo '<div class="msg msg-error" style="margin: 15px; width: 80%;"><p>Your Shopping Cart was Empty !</p></div>';
                                        }
                                    
                                    ?>
                                    
                                    
                                    
								</fieldset>
						</div><!-- .content#box-1-holder -->
                </div>
</div>