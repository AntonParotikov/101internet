## 101internet

Url for tests - http://101.8dehb.ru/

Routing - routes/web.php

Controller - app/Http/Controllers/ParserController.php

Model - app/Http/Models/Inquiry.php

View - resources/views/Parser/parseresult.blade.php

Migrations - /database/migrations/2017_07_04_110846_parse_table.php


Поскольку задание было некорректно из за отсутствия точной даты на сайте www.bills.ru в формате год-месяц-день часы:минуты:секунды, колонку date в бд пришлось сделать строкой чтобы в полной мере можно было пользоваться сервисом.