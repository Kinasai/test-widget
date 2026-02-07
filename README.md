## Тестовая мини CRM с widget

### Первый запуск
- `git clone https://github.com/Kinasai/test-widget.git`
- `cd test-widget`
- `composer update`
- `cp .env.example .env && php artisan key:generate && php artisan storage:link`
- `php artisan migrate`
- `npm i`
- `npm run build`
  
### Тестовое наполнение таблицы

- `php artisan db:seed`

### Данные для авторизации
- `manager@gmail.com`
- `123456`

### Интеграция iframe
- `localhost/widget`

### API endpoint

- `GET /tickets/statistics` - статистика тикетов
- - Принимает параметр `period` значения `day`, `week`, `month`

- `POST /tickets`
- - `name` => Обязательное поле строка максимум 255 символов
- - `email` => Обязательное поле тип email
- - `phone_number` => Обязательное поле тип E164
- - `title` => Обязательное поле строка максимум 255 символов
- - `text` => Обязательное поле строка максимум 1000 символов
- - `file` => Необязательное поле тип image Формат jpeg,png,jpg,gif,webp Максимальный вес 5 MB
