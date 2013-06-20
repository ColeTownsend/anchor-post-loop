The Post Loop
================

This is a simple post loop for anchor. You can use it on any page. Not all of this code is mine, most of it I gleaned from the Anchor Forums but I've changed a few things and wanted to share it here.

First we create a variable. I called it 'displayCats'. It's actually an array, which can contain several items. We want it to contain the IDs for the categories we want in this loop.

	$displayCats = array(1,2,3,4,5,6)

Now, if you have 6 categories, this would be all of them. By default, 'Uncategorized' is the first category. There is no '0' category, so don't try and call it.

## The HTML Stuff — ELI5
Here is where we call the function. So while we run **portf_list** function, for each  
item in the array **$displayCats**, we're creating a variable **$cat**. Then the **article_category_id** function scans all the categories checks for the ID AKA **$cat**. If **$cat** is indeed an ID for a category, it will call return the posts from that category in the structure within. 

In this little tidbit below you can see I have am creating a **li**st item for each post that is returned. In this case, it will return the title of the post, which is linked to the post. And below the post title will be the description, if one is filled out. View it in action over at [my blog](http://coletownsend.com/posts).

	<?php while(portf_list()): ?>
      <?php foreach($displayCats as $cat): ?>
          <?php if(article_category_id() == $cat): ?>
            <!-- Here Goes Whatever your want each item to display. 
            I currently use list items but you could forseeably use divs, table items, or flexbox goodies.
            <li>
              <a href="<?php echo article_url(); ?>">
              <h1 class="case-title"><?php echo article_title(); ?></h1>
              </a>
              <p class="case-deets"><?php echo article_description(); ?></p>
            </li>
            -->
            <?php endif; ?>
      <?php endforeach; ?>
	<?php endwhile; ?>
