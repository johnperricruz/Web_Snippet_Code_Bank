/*Change WP Menu*/

UPDATE wp_postmeta SET meta_value = REPLACE(meta_value,'OLD','NEW')
WHERE meta_key = '_menu_item_url'

/*Change WP Content*/
UPDATE wp_posts SET post_content = REPLACE(post_content,'OLD','NEW')
UPDATE wp_posts SET guid = REPLACE(guid,'OLD','NEW')

/*Change WP SITE URL's*/
UPDATE wp_options SET option_value = REPLACE(option_value,'OLD','NEW')