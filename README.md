# knowledgetesting-webapp
Весь принцип работы и разработки описан в файле ТихоновДВ_отчёт.pdf

Веб-приложения сделанное локально с помощию веб-сервера Apache, а также было загруено на бесплатный веб-хостинг. Основной функционал деиться на 2 части.
Есть два типа пользователей: респондент(студент) и интервьюер(преподаватель).
Респондент(студент): Может проходить тесты на любую тему cо своевременным получение результатом.В большинстве случаев результат пройденного теста отображается в профиле студента сразу,но иногда требуется проверка ответов открытого типа преподавателем.
Интервьюер(преподаватель): Может создавать и редактировать тесты. Также преподаватель может просматривать результаты студентов и давать им возможность на повторное прохождение теста. В своем профиле, преподаватель может засчитывать или отклонять ответы студентов на задания открытой формы.
Для храннения использовалась БД MySQL (с веб-интерфейсом phpMyAdmin). Связь интерфейса и БД осуществлялась через PHP.
