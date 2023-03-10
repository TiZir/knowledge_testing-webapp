<?php
    include('menu.php')
?>
<!DOCTYPE html>
<html lang="en, ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Testing System</title>
    <link rel="stylesheet" href="Style/General.css">
</head>
<body style="overflow: hidden;">
        <h1>Выпускная квалификационна работа</h1>
        <h2>"Разработка веб-приложения для тестирования знаний"</h2>
        <section>
            <article class="art1">
                <span class="artspan"><b>О создатели веб-приложения</b></span>
                <p>
                    О создатели веб-приложения
                    Приложение было создано студентом ФГБОУ ВО «Национальный исследовательский университет «МЭИ»,
                    обучающимся по направлению бакалавриата "Информатика и вычислительная техника", кафедра "ВМСС".<br/>
                    <br/>Тихонов Данила Вячеславович<br/>
                    <br/>Группа А-12-18.<br/>
                    <br/>Годы обучения 2017-2022
                </p> 
                <img style="margin: auto; width: 200px; height: 200px; display: block; margin-left: auto; margin-right: auto" src="\TestingSystem\Style\logo.png"/>
            </article>

            <article class="art2">
                <span class="artspan"><b>О веб-приложении</b></span>
                <p>
                    Данное веб-приложение было создано в качестве выпускной квалификационной работы.<br/>
                    В веб-приложении реализована возможность проходить и создавать тесты с заданиями 3-х типов форм.<br/>
                    <ul>
                        <li>
                            <i>Закрытой формы</i> - задания, имеющие готовые ответы и предполагающие выбор тестируемым варианта из предложенного набора.
                        </li>
                        <li>
                            <i>Полуоткрытой формы </i> - задания на распределение готовых ответов в нужном соотношении и требующие комбинаций с предлагаемым материалом для
                            образования определенных пар или последовательных рядов.
                        </li>
                        <li>
                        <i>Открытой формы</i> - задания со свободными ответами без предлагаемых ему готовых вариантов ответа для выбора. 
                        </li>
                    </ul>
                    <p>Есть два типа пользователей: респондент(студент) и интервьюер(преподаватель).<br/>
                        <b>Респондент(студент):</b> Может проходить тесты на любую тему cо своевременным получение результатом.
                        В большинстве случаев результат пройденного теста отображается в профиле студента сразу,
                        но иногда требуется проверка ответов открытого типа преподавателем.
                        <br/><b>Интервьюер(преподаватель):</b>
                        Может создавать и редактировать тесты. Также преподаватель может просматривать результаты студентов и давать 
                        им возможность на повторное прохождение теста.
                        В своем профиле, преподаватель может засчитывать или отклонять ответы студентов на задания открытой формы.
                    </p>
                </p>
            </article>

            <article class="art3">
            <span class="artspan"><b>Используемые инструменты</b></span>
                <p>
                    Работа с кодом оcуществлялась в редакторе исходного кода Visual Studio Code (VS Code)<br/><br/>
                    <b>Front-End:</b>
                    <ul>
                        <li>
                            <i>HTML5</i>, расширение  "HTML CSS Support” by ecmel v1.12.2 для VS Code
                        </li>
                        <li>
                            <i>CSS</i>, расширение  "HTML CSS Support” by ecmel v1.12.2 для VS Code
                        </li>
                        <li>
                            <i>JavaScript</i>, расширение  “JavaScript (ES6) code snippets” by charalampos karypidis v1.8.0 для VS Code
                        </li>
                    </ul>
                    <b>Back-End:</b>
                    <ul>
                        <li>
                            <i>PHP v8.0.11</i>, расширение “PHP Intelephense” by Ben Mewburn v1.8.2 для VS Code
                        </li>
                        <li>
                            <i>Локальный сервер Apache v2.4</i>
                        </li>
                        <li>
                            <i>Виртуальный хостинг Beget</i>
                        </li>
                        <li>
                            <i>CУБД mySQL v8.0.26</i> и ее веб–интерфейс для администрирования phpMyAdmin v5.1.1
                        </li>
                    </ul>
                </p> 
            </article>
        </section>
</body>
</html>