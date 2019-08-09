# 1 - WP Rocket | Managed Hosting Inc. Compatibility	

A WP Rocket customer website is hosted on a managed offer with its own caching system. To prevent any incompatibility, they ask to disable WP Rocket cache only and still use the other features.

- Using WP Rocket hooks, disable the static file cache creation
- Using WP Rocket hooks, purge the host cache system when calling the clear cache in WP Rocket. The host function is: managed_clear_cache();
