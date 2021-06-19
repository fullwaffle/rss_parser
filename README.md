## Cron guide

```
MAILTO=""
SHELL=/bin/bash

* * * * * docker exec -t container_name_or_id php /var/www/html/public/index.php
```

