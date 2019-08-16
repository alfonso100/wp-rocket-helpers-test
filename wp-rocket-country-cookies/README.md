# 3 WP Rocket | Country Cookie

A WP Rocket customer is displaying different content depending on the country of origin of its visitors, so he wants a different cache version based on the country. The country is saved as a cookie in the visitor browser, with the name *origin_country*.

- Using WP Rocket hooks, prevent serving the cache until a cookie named origin_country is set on the visitor browser.
- Using WP Rocket hooks, serve the corresponding cache version based on the value of the origin_country cookie.
