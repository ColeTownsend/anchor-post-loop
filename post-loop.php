<?php

  // displayCats is a variable that tells the function which categories you want to call. 
  // The category ID number is sometimes a bit hard to find. It is the number that comes up when editing a category. 
  // For instance http://mydomain.com/admin/categories/edit/4 would be the editing page for Category ID 4 — which happens to be posts from my 'Portfolio' category.
  // If you want to call multiple categories, you can change it to array(4,5,6) or whatever other ID's you want to include.

  $displayCats = array(4);

  function article_category_id() {
    if($category = Registry::prop('article', 'category')) {
      $categories = Registry::get('all_categories');
      return $categories[$category]->id;
    }
  }

function portf_list() {
  // only run on the first call
  if( ! Registry::has('rwar_post_archive')) {
    // capture original article if one is set
    if($article = Registry::get('article')) {
      Registry::set('original_article', $article);
    }
  }

  if( ! $posts = Registry::get('rwar_post_archive')) {
    $posts = Post::where('status', '=', 'published')->sort('created', 'desc')->get();

    Registry::set('rwar_post_archive', $posts = new Items($posts));
  }

  if($result = $posts->valid()) {
    // register single post
    Registry::set('article', $posts->current());

    // move to next
    $posts->next();
  }
  else {
    // back to the start
    $posts->rewind();

    // reset original article
    Registry::set('article', Registry::get('original_article'));

    // remove items
    Registry::set('rwar_post_archive', false);
  }

  return $result;
}

?>

<!-- This is the HTML portion, it might go within a <body> tag or whatever -->

<?php while(portf_list()): ?>
    <?php foreach($displayCats as $cat): ?>
        <?php if(article_category_id() == $cat): ?>
          <!-- Here Goes Whatever your want each item to display. I currently use list items but you could forseeably use divs, table items, or flexbox children.
          <li>
            <a href="<?php echo article_url(); ?>"><h1 class="case-title"><?php echo article_title(); ?></h1></a>
            <p><?php echo article_description(); ?></p>
          </li>
          -->
          <?php endif; ?>
    <?php endforeach; ?>
<?php endwhile; ?>