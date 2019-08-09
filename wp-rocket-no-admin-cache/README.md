# 2 - WP Rocket | No cache for admins when user cache is enabled	

 A WP Rocket customer is using the user cache option to provide the cache to logged-in users. But he would like to prevent caching for administrators.

- By creating a plugin/mu-plugin, disable caching for administrators only.
- WP Rocket detects the DONOTCACHEPAGE constant value to determine if the current page should be cached
