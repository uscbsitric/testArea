<? if ( $row_p['status'] == 'pending' OR $row_p['status'] == 'sold' )  { ?>
	<div style="color: #990033; font-size: 23px; margin: 10px 0;">
	<? if ( $row_p['status'] == 'pending') { ?>
		Sale Pending
	<? } //endif ?>
	
	<? if ( $row_p['status'] == 'sold') { ?>
		Sold!
	<? } //endif ?>
	</div>
<? } //endif ?>

		<div class="property-generalInfo">
				
			<h4 class="title">General Information</h4>
			<div class="property-content">
				<dl style="min-width:257px;">
					<dt>Price:</dt>
					<dd>
						<? if ($row_p['price'] < 0 )
								echo 'Contact seller for price';
							else
								echo Money($row_p['price']);
						?>
					</dd>

					<dt>Acreage:</dt>
					<dd><? echo $row_p['lot_size']; ?> acres</dd>

					<dt>House Size:</dt>
					<dd>
						<?
							if ($row_p['sqft'])
								echo number_format($row_p['sqft']) . ' Square Feet';
							else
								echo 'n/a';
						?>
					</dd>
					
					<? if ($row_p['price'] AND $row_p['lot_size']) { ?>
					<dt>Price per Acre:</dt>
					<dd>
						<? echo Money($row_p['price'] / $row_p['lot_size']) ?> per acre		
					</dd>			
					<? } //endif ?>
				</dl>
				
				<dl class="col2">
					<dt>Address:</dt>
					<dd>
						<?
						if ($row_p['address'])
							echo $row_p['address'];
						else
							echo 'n/a';
						?>
					</dd>

					<dt>City / State / Zip:</dt>
					<dd><? echo $row_p['city'] . ", " . $row_p['state'] . " " . $row_p['zip']; ?></dd>

					<dt>Bed / Bath:</dt>
					<dd>
						<? if ($row_p['bed'] OR $row_p['bath']) {
								if ($row_p['bed'])
									echo $row_p['bed'] . ' bed';
								// separator
								if ($row_p['bed'] AND $row_p['bath'])
									echo ' / ';
								if ($row_p['bath'])
									echo $row_p['bath'] . ' bath';
						 } else
								echo 'n/a';
					  ?>
					</dd>
				</dl>
				</div><!-- property-content -->
		</div><!-- property-generalInfo -->
			
		<div class="oneCol">
			<h4 class="title">Tools</h4>
			<div class="property-content">
				<ul class="tools">
					<li class="btn">
<a target="_blank" href="https://maps.google.com/maps?saddr=Current+Location&daddr=<?php echo urlencode($row_p['address'].', '.$row_p['city'].', '.$row_p['state'].' '.$row_p['zip']); ?>">Map Location</a>
					</li>
					<li class="btn">
						<a href="<? echo $settings['domain']; ?>/Properties/Flyer/<? echo $_REQUEST['id']; ?>/">Print Flyer</a>
					</li>
					<li class="btn">
						<a href="<? echo $settings['domain']; ?>/Account/SaveListing/?id=<? echo $_REQUEST['id']; ?>">Save Listing</a>
					</li>
					<li class="btn">
						<a href="http://ruralpropertyfinder.com/creditscore">Credit Improvement</a>
					</li>
					<li class="btn">
						<a id="showContactNum">Click for phone number</a>
					</li>
				</ul>
			</div><!-- property-content -->
			<div id="contactNumber" style="display: none; border: #999999 solid 1px; padding: 15px 0px; text-align: center;">
						<?php if(isset($row_p['sellerName']) && isset($row_p['sellerPhone'])){ ?>
							<?php  echo $row_p['sellerName']; ?>: <?php echo $row_p['sellerPhone']; ?>
						<?php }else{ ?>
							No phone number
						<?php } ?>
			</div>
		</div><!-- oneCol -->
		
		<script type="text/javascript">
			$('#showContactNum').click(function(){
				
				if($('#contactNumber').css('display')=='none'){
					var leadDate = $('input[name="lead_date"]').val();			
					
					<?php if(isset($row_p['sellerName']) && isset($row_p['sellerPhone'])){ ?>

							  $.post("detail.php",
							  {
								lead_ajax:"true",
								property_id:"<?php echo $row_p['id'];?>",
								lead_type:"phone",
								lead_date:"<?php echo date("Y-m-d"); ?>"
							  },
							  function(data,status){
							  });					
					<?php } ?>
				}
				$('#contactNumber').slideToggle('slow');
				
				
			});
		</script>
		
		<div class="clear"></div>

<? include('slide.php'); ?>

<h4 class="title">Description</h4>

<div class="property-content">
	<? echo nl2br($row_p['description']); ?>
</div>

<? if ($row_p['privateFinancing']) { ?>
<p>Private financing is available.</p>
<? } ?>


<div class="twoCols">
	<h4 class="title">Contact Information</h4>
	<div class="property-content">
		<dl>
			
		<? if ($row_p['sellerTitle']) { ?>
			<dt>Company:</dt>
			<dd><? echo $row_p['sellerTitle']; ?></dd>
		<? } ?>
			<dt>Contact:</dt>
			<dd><? echo $row_p['sellerName']; ?></dd>

			<? if ($row_p['sellerPhone']) { ?>
			<dt>Phone:</dt>
			<dd><? echo $row_p['sellerPhone']; ?></dd>
			<? } ?>
			
			<dt>State:</dt>
			<dd><? echo $row_p['state']; ?></dd>
		</dl>
	</div><!-- property-content -->
</div><!-- twoCols -->
<div class="twoCols right">
	<h4 class="title">Property Details</h4>
	<div class="property-content">
		<dl>
			<dt>Listing ID:</dt>
			<dd><? echo $row_p['id']; ?></dd>

			<? if ($row_p['mls']) { ?>
			<dt>MLS #</dt>
			<? if ($row_p['mls_link'] != '')
					echo '<dd><a href="' . $row_p['mls_link'] . '">' . $row_p['mls'] . '</a></dd>';
				else
					echo '<dd>' . $row_p['mls'] . '</dd>';
			?>
			<? } ?>
			
			<? if ($row_p['cid']) {
				//fetch category title
				$query_c = "select * from categories where id = " . $row_p['cid']; 
				//echo $query_c;
				$c = mysql_query($query_c,$myconn) or die(mysql_error());
				$row_c = mysql_fetch_assoc($c);
				?>
				<dt>Property Type:</dt>
				<dd><? echo $row_c['title']; ?></dd>
			<? } ?>

			<? if ($row_p['year']) { ?>
				<dt>Year Built:</dt>
				<dd><? echo $row_p['year']; ?></dd>
			<? } 
				if ($row_p['level']) { ?>
				<dt>Level(s):</dt>
				<dd><? echo $row_p['level']; ?></dd>
			<? } 
				if ($row_p['subdiv']) { ?>
				<dt>Subdivision:</dt>
				<dd><? echo $row_p['subdiv']; ?></dd>
			<? } 
				if ($row_p['schoold']) { ?>
				<dt>School District:</dt>
				<dd><? echo $row_p['schoold']; ?></dd>
			<? } 
				if ($row_p['garage']) { ?>
				<dt>Garage:</dt>
				<dd><? echo $row_p['garage']; ?></dd>
			<? } ?>	
			<dt>Date Posted:</dt>
			<dd><? echo $row_p['pdate']; ?></dd>
			<dt>Views:</dt>
			<dd><? echo $row_p['hits']; ?></dd>
		</dl>							
	</div><!-- property-content -->
</div><!-- twoCols -->

<div class="clear"></div>
