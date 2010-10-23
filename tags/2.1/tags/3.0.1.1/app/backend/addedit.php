<?php
global $rspro_categories;
if(isset($_GET['id']) and $_GET['id'] != "") {
	$isrspro = true;
	$id = $_GET['id'];
	$rspro = rspro_get_single($id);
}
?>

<div class="wrap">
  <div id="icon-users" class="icon32"><br>
  </div>
  <h2>
    <?php if($isrspro): ?>
    <?php echo stripslashes($product->title); ?>
    <?php else: ?>
    Add New Toolbar
    <?php endif; ?>
  </h2>
  <form method="post" enctype="multipart/form-data">
    <table class="form-table">
      <tbody>
        <tr>
          <th width="151"><label>Product Title</label></th>
          <td colspan="2"><input type="text" class="regular-text" value="<?php echo(isset($_POST['title'])?stripslashes($_POST['title']):stripslashes($rspro->title)); ?>" name="title" /></td>
        </tr>
		 
        <tr>
          <th><label>Product Price</label></th>
          <td colspan="2"><input type="text" class="regular-text" value="<?php echo(isset($_POST['price'])?stripslashes($_POST['price']):stripslashes($rspro->price)); ?>" name="price" /></td>
        </tr>

		
		
        <tr>
          <th><label>Product Description</label></th>
          <td colspan="2"><textarea class="tinymce" name="description"><?php echo(isset($_POST['description'])?stripslashes($_POST['description']):stripslashes($rspro->description)); ?></textarea></td>
        </tr>
        <tr>
          <th><label>Product Call To Action</label></th>
          <td colspan="2"><textarea class="tinymce" name="prod_excerpt"><?php echo(isset($_POST['prod_excerpt'])?stripslashes($_POST['prod_excerpt']):stripslashes($rspro->prod_excerpt)); ?></textarea></td>
        </tr>
        <tr>
          <th valign="top"><label>Image</label></th>
          <td width="218" valign="top"><input type="file" class="regular-text" name="product_image" /></td>
          <td width="357" valign="top"><?php if(strlen($rspro->product_image)>0){ ?><img src="<?php echo rspro_thumber($rspro->product_image,'product',150,120,true); ?>" style="border:1px solid #DDD; padding:2px;" /> <?php } ?></td>
        </tr>
        <tr>
          <th><label>Website</label></th>
          <td colspan="2"><input type="text" class="regular-text" value="<?php echo(isset($_POST['website'])?stripslashes($_POST['website']):stripslashes($rspro->website)); ?>" name="website" /></td>
        </tr>
        <tr>
          <th><label>Background Color</label></th>
          <td colspan="2"><input type="text" class="regular-text" id="rsporBgColor" value="<?php echo(isset($_POST['color'])?stripslashes($_POST['color']):stripslashes($rspro->color)); ?>" name="color" /><div class="description">Default is <code>#5c5c66</code></div></td>
        </tr>
        <tr>
          <th><label>Page/Post Target</label></th>
          <td colspan="2"><input type="text" name="pagetarget" id="pagetarget" value="<?php echo(isset($_POST['color'])?stripslashes($_POST['pagetarget']):stripslashes(substr($rspro->pagetarget,1,strlen($rspro->pagetarget)-2))); ?>" /><br />Insert page or post numbers and separate them with commas. Toolbar will only be visible here.</td>
        </tr>
		
<tr>
          <th><label>Exclude Post/Page</label></th>
          <td colspan="2"><input type="text" name="excludepost" id="excludepost" value="<?php echo(isset($_POST['color'])?stripslashes($_POST['excludepost']):stripslashes(substr($rspro->excludepost,1,strlen($rspro->excludepost)-2))); ?>" /><br />Insert page or post numbers and separate them with commas. Toolbar will be excluded from this pages/posts.</td>
        </tr>		
		
		
        <tr>
          <th><label>Post Category Target</label></th>
          <td colspan="2"><select name="categories" id="rspro_category">
              <option value="">Select a catgegory</option>
              <option value="">----------------</option>
              <?php foreach($rspro_categories as $key=>$value){ ?>
              <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
              <?php } ?>
            </select>
            <div id="rspro_categories" class="tagchecklist">
              <?php 
		$categories=@explode(",",$rspro->categories); 
		if(isset($_POST['rspro_categories']) && count((array)$_POST['rspro_categories'])>0){
			$categories=(array)$_POST['rspro_categories']+(array)$categories;
		}
		asort($categories);
		if(is_array($categories)){
			foreach($categories as $value){
				if(strlen($value)>0){
				?>
              <span class="rspro_category_btn" id="category_<?php echo strtoupper($value); ?>"><a class="ntdelbutton">X</a>&nbsp;<?php echo $rspro_categories[$value]; ?>
              <input type="hidden" name="rspro_categories[]" value="<?php echo strtoupper($value); ?>">
              </span>
              <?php
				}
			}
			}
		?>
            </div></td>
        </tr>
        <tr>
          <th valign="top"><label>Autoresponder Form HTML</label>
		 
		  <br /><br />
		  		  <div style="display:none"><a href="javascript:remove_attribute();" class="button-primary">Remove Attributes</a></div>
		  
		  </th>
          <td colspan="2">
<textarea  cols="60" rows="8" name="aweber_html"><?php echo(isset($_POST['aweber_html'])?stripslashes($_POST['aweber_html']):stripslashes($rspro->aweber_html)); ?></textarea>		  
		  
</td>
        </tr>
        <tr>
          <th valign="top"><label>Autoresponder Text <strong>(below the form)</strong></label></th>
          <td colspan="2"><textarea name="aweber_text" class="tinymce" ><?php echo(isset($_POST['aweber_text'])?stripslashes($_POST['aweber_text']):stripslashes($rspro->aweber_text)); ?></textarea></td>
        </tr>
		
<tr>
          <th><label>Enable Epxand/Contract Mode&nbsp;(<b title="Select Whether You Want to Enable/Disable Auto Expand/Contract Toolbar">?</b>)</label></th>
          <td colspan="2">
		  

            <input type="radio" size="5" value="no" name="auto_vibration"<?php echo($rspro->auto_vibration=='no'?" checked=\"checked\"":""); ?>  />
            No
			<br />
			<input type="radio" size="5" value="yes"  name="auto_vibration"<?php echo($rspro->auto_vibration=='yes'?" checked=\"checked\"":""); ?> />
            Yes 
			
			</td>
        </tr>	
	
<tr>
          <th><label>Expand/Contract delay time&nbsp;(<b title="Duration in Second between Contract and Expand of the toolbar">?</b>)</label></th>
          <td colspan="2"><input type="text" class="regular-text" value="<?php echo(isset($_POST['vibration_time'])?stripslashes($_POST['vibration_time']):stripslashes($rspro->vibration_time)); ?>" name="vibration_time" />(In Sec)</td>
        </tr>		
	
<tr>
          <th><label>Time to Start Auto Expand/Contract&nbsp;(<b title="Enter Time in Second to start Auto Contract/Expand of the toolbar.">?</b>)</label></th>
          <td colspan="2"><input type="text" class="regular-text" value="<?php echo(isset($_POST['vibration_number'])?stripslashes($_POST['vibration_number']):stripslashes($rspro->vibration_number)); ?>" name="vibration_number" /></td>
        </tr>		
	
	
<tr>
          <th><label>Number of time to  Auto Expand/Contract&nbsp;(<b title="Enter number for  Auto Contract/Expand of the toolbar before mouseover.">?</b>)</label></th>
          <td colspan="2"><input type="text" class="regular-text" value="<?php echo(isset($_POST['vibration_count'])?stripslashes($_POST['vibration_count']):stripslashes($rspro->vibration_count)); ?>" name="vibration_count" /></td>
        </tr>		
					
		

		
        <tr>
          <th><label>Toolbar Weight&nbsp;(<b title="Toolbar Priority, 1 for highest priority if you have multiple toolbar">?</b>)</label></th>
          <td colspan="2"><input type="text" size="10" value="<?php echo(int)(isset($_POST['rspro_weight'])?stripslashes($_POST['rspro_weight']):$rspro->weight); ?>" name="rspro_weight" />
            <div class="description">Default is 1</div></td>
        </tr>
        <tr>
          <th><label>Toolbar Hits&nbsp;(<b title="How many times you like to show the toolbar, 0 for unlimited, 1 for just 1 time and so on">?</b>)</label></th>
          <td colspan="2"><input type="text" size="10" value="<?php echo(int)(isset($_POST['rspro_hit'])?stripslashes($_POST['rspro_hit']):$rspro->hit); ?>" name="rspro_hit" />
            <div class="description">Default is 0(unlimited)</div></td>
        </tr>
        <tr>
          <th><label>Toolbar Status</label></th>
          <td colspan="2"><input type="radio" size="5" value="1"  name="status"<?php echo($rspro->status==1?" checked=\"checked\"":""); ?> />
            Active <br />
            <input type="radio" size="5" value="2" name="status"<?php echo($rspro->status==2?" checked=\"checked\"":""); ?>  />
            Paused</td>
        </tr>
        <tr>
          <th><label>Toolbar Position</label></th>
          <td colspan="2"><input type="radio" size="5" value="top"  name="position"<?php echo($rspro->position=='top'?" checked=\"checked\"":""); ?> />
            Top <br />
            <input type="radio" size="5" value="bottom" name="position"<?php echo($rspro->position=='bottom'?" checked=\"checked\"":""); ?>  />
            Bottom</td>
        </tr>
		
<tr>
          <th><label>Display Close Button&nbsp;(<b title="Select whether you like to show or hide close button on toolbar">?</b>)</label></th>
          <td colspan="2"><input type="radio" size="5" value="yes"  name="display_close"<?php echo($rspro->display_close=='yes'?" checked=\"checked\"":""); ?> />
            Yes <br />
            <input type="radio" size="5" value="no" name="display_close"<?php echo($rspro->display_close=='no'?" checked=\"checked\"":""); ?>  />
            No</td>
        </tr>		
		

<tr>
          <th width="151"><label>Display Powered By Text</label></th>
          <td colspan="2">
		  <input type="radio" size="5" value="yes"  name="product_text"<?php echo($rspro->product_text=='yes'?" checked=\"checked\"":""); ?> />
            Yes <br />
            <input type="radio" size="5" value="no" name="product_text"<?php echo($rspro->product_text=='no'?" checked=\"checked\"":""); ?>  />
            No
		  
		  </td>
        </tr>		
        <tr>
          <th>&nbsp;</th>
          <td colspan="2"><?php if(isset($isrspro)):
		  $rspro->url=get_bloginfo('home').'/?rspro-ajax=display&pid='.$rspro->id;
	?>
            <input type="hidden" name="popup_id" value="<?php echo $rspro->id;?>" />
            <input type="hidden" value="yes" name="rspro-update" />
            <input type="submit" class="button-primary" name="rspro-update" value="Update" />
            <?php else: ?>
            <input type="hidden" value="yes" name="rspro-add" />
            <input type="submit" value="Submit" class="button-primary" name="rspro-add" />
            <?php endif; ?></td>
        </tr>
        <?php if(isset($rspro->nhit) && $rspro->nhit<1){ ?>
        <tr>
          <th>&nbsp;</th>
          <td colspan="2"><a href="?page=<?php echo $_GET['page']; ?>&id=<?php echo $rspro->id; ?>&action=rspro-restart&pid=<?php echo $rspro->id; ?>" class="button-primary">Toolbar has expired. RESTART NOW</a></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </form>
  <?php
  
  ?>
</div>
</div>

<script>
function remove_attribute()
{
var strInputCode=tinyMCE.get('mce_2').getContent();
 			
 	 	
 		var strTagStrippedText = strInputCode.replace(/<table\/?[^>]+(>|$)/g, "");
		strTagStrippedText = strTagStrippedText.replace(/<div\/?[^>]+(>|$)/g, "");
		strTagStrippedText = strTagStrippedText.replace(/<frame\/?[^>]+(>|$)/g, "");
		strTagStrippedText = strTagStrippedText.replace(/<iframe\/?[^>]+(>|$)/g, "");
		strTagStrippedText = strTagStrippedText.replace(/<p\/?[^>]+(>|$)/g, "");
		strTagStrippedText = strTagStrippedText.replace(/<center>\/?[^>]+(>|$)/g, "");


		strTagStrippedText = strTagStrippedText.replace(/<br>\/?[^>]+(>|$)/g, "");

				strTagStrippedText = strTagStrippedText.replace('<p>', "");

				strTagStrippedText = strTagStrippedText.replace('</p>', "");
				strTagStrippedText = strTagStrippedText.replace("<br />", "");
				strTagStrippedText = strTagStrippedText.replace("<br>", "");
				
				


		strTagStrippedText = strTagStrippedText.replace(/<p\/?[^>]+(>|$)/g, "");
		strTagStrippedText = strTagStrippedText.replace(/<br>\/?[^>]+(>|$)/g, "");
				strTagStrippedText = strTagStrippedText.replace('<p>', "");
				strTagStrippedText = strTagStrippedText.replace('</p>', "");

				strTagStrippedText = strTagStrippedText.replace("<br />", "");
				strTagStrippedText = strTagStrippedText.replace("<br>", "");
				
				
								strTagStrippedText = strTagStrippedText.replace('<li>', "");

				strTagStrippedText = strTagStrippedText.replace('</li>', "");
								strTagStrippedText = strTagStrippedText.replace('<ul>', "");

				strTagStrippedText = strTagStrippedText.replace('</ul>', "");
								strTagStrippedText = strTagStrippedText.replace('<p>', "");

				strTagStrippedText = strTagStrippedText.replace('</p>', "");
document.getElementById('mce_2').value = strTagStrippedText;
tinyMCE.activeEditor.setContent(strTagStrippedText);
//tinyMCE.editors['mce_2'].setcontent ;//updateContent('mce_2');

}
</script>
