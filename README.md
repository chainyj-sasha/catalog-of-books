Описание.

Для запуска приложения:
- выполнить миграции для добавления таблиц в базу данных ( php artisan migrate ).
- выполнить команду ( php artisan db:seed --class=UserSeeder ), для добавления в таблицу юзера со статусом "администратор". Логин администратора: "admin@example.com" Пароль: "password".
  Все юзеры зарегистрированные через форму регистрации получают статус "пользователь".

Необходимо реализовать приложение, для ведения каталога книг.
I. Приложение должно поддерживать следующие возможности:
1. Регистрацию и авторизацию пользователей.
2. Добавление новых и редактирования уже существующих разделов.
    - доступно только администратору.
3. Добавление новых и редактирования уже существующих авторов книг.
    - доступно только администратору.
4. Добавление новых и редактирование уже существующих книг.
    - добавление должно быть доступно только авторизованным пользователям.
    - редактирование, только пользователю, который добавил книгу и администратору.
5. Удаление / скрытие разделов и книг.
    - доступно только администратору.
6. Просмотр списка книг с возможностью поиска и сортировки по названию и автору.
    - доступно всем пользователям.
7. Просмотр детальной информации о выбранной книге.
    - доступно всем пользователям.
8. Возможность поиска и сортировки записей по названию и автору.
    - доступно всем пользователям.
    - Так же на страницах должна присутствовать пагинация. Вывод по 5 книг на страницу.

II. Требование к серверной части
1.Серверная часть должна быть реализована при помощи framework Laravel (последняя
версия).
2. В качестве БД допускается использование: sqllite, mysql или postgresql.
3. Таблица с разделами. Поля, которые должны присутствовать:
    - Название раздела – строка, обязательное, макс. 150 символов.
    - Описание раздела – строка, обязательное поле, макс. 500 символов.
    - Остальные поля на Ваше усмотрение.
4. Таблица со списком авторов. Поля, которые должны присутствовать:
    - ФИО автора – строка, обязательное, макс. 150 символов.
    - Страна рождения - строка, обязательное, макс. 100 символов.
    - Комментарий – строка, макс. 500 символов.
    - Остальные поля на Ваше усмотрение.
5. Таблица со списком книг. Поля, которые должны присутствовать:
    - Название — строка, обязательное, макс. 150 символов.
    - Автор — id из таблицы авторов, обязательное.
    - Год издания — число, необязательно, макс. 4 символа.
    - Описание — строка, обязательно, макс. 2000 символов.
    - Обложка — изображение в формате jpg/jpeg, png., макс. размер файла 500Kb.
    - Остальные поля на Ваше усмотрение.
      
