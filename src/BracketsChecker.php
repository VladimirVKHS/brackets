<?php
/**
 * Created by PhpStorm.
 * User: Владимир
 * Date: 07.01.2018
 * Time: 22:50
 */

namespace VkBrackets;

use VkBrackets\Exception\BracketsCheckError;

class BracketsChecker
{

    private $str = null; // Исходная строка
    private $result = null; // Результат операции
    private $error = null; // Описание ошибки

    /**
     * BracketsChecker constructor.
     * @param string $str
     */
    public function __construct(string $str)
    {
        try {
            $this->str = $str;
            // Убираем из строки разрешённые символы за исключением скобок
            $str = str_replace([' ', "\n", "\t", "\r", '\n', '\t', '\r'], '', $str);
            //Проверяем правильность открытия и закрытия скобок, наличие запрещённых символов
            $open_brackets = 0;
            for($i=0;$i<strlen($str);$i++)
            {
                switch ($str[$i]) {
                    case '(':
                        $open_brackets++;
                        break;
                    case ')':
                        $open_brackets--;
                        if ($open_brackets < 0) throw new BracketsCheckError("Некорректное закрытие скобок в позиции $i");
                        break;
                    default:
                        throw new \InvalidArgumentException("Некорректный символ в позиции $i: {$str[$i]}");
                }
            }
            if ($open_brackets != 0) throw new BracketsCheckError("Не закрыто $open_brackets скобок");
            $this->result = true;
        } catch (BracketsCheckError $e) {
            $this->result = false;
            $this->error = $e->getMessage();
        }
    }

    public function __get($name)
    {
        switch ($name) {
            case 'str': return $this->str;
                break;
            case 'result': return $this->result;
                break;
            case 'error': return $this->error;
                break;
        }
        throw new \Exception('Неизвестное свойство '.$name);
    }

}