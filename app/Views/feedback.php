<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Форма обратной связи с отправкой сообщений">
    <title>Форма обратной связи</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

    <main>
        <h1>Форма обратной связи</h1>

        <form id="feedback-form" novalidate>

            <label for="full_name">ФИО:</label>
            <input
                type="text"
                id="full_name"
                name="full_name"
                placeholder="Иванов Иван Иванович"
                autocomplete="name"
                required
            >

            <label for="email">Email:</label>
            <input
                type="email"
                id="email"
                name="email"
                placeholder="example@mail.ru"
                autocomplete="email"
                required
            >

            <label for="message">Сообщение:</label>
            <textarea
                id="message"
                name="message"
                rows="5"
                maxlength="500"
                placeholder="Введите ваше сообщение..."
                required
            ></textarea>
            <small id="char-counter" class="char-counter">0 / 500</small>

            <button type="submit">Отправить</button>
        </form>

        <div id="form-errors" class="errors" role="alert"></div>

        <section id="messages-list">
            <h2>Ранее отправленные сообщения</h2>
            <ul id="messages"></ul>
        </section>
    </main>

    <script src="/js/app.js"></script>

</body>
</html>