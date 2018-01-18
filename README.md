# Brakets Checker

## Назначение

Проверка правильности расстановки скобок в строке.

Класс принимает строку вида `(()()()()))((((()()()))(()()()(((()))))))`

Возвращеат true, если строка корректна, все открытые скобки корректно открыты
и закрыты, или же false в противном случае.

Строка может включать символы “(“, “)”, “ ” (пробел), “\n” (перенос строки), “\t” (символ
табуляции), “\r” (перенос каретки). Если же строка содержит что-то кроме
перечисленных символов, то ваша библиотека должна выбрасывать исключение
InvalidArgumentException.

Ограничения на длину строки нет.

Для образовательных целей.

## Установка

    composer require vkhs/brackets 

## Использование

    use VkBrackets\BracketsChecker;      
    $str = "(()()())\n \t()";
    $checker = (new BracketsChecker($str))->check();
    $result = $checker->result;
    $error = $checker->error;
    $str = $checker->str;
