<?php
/**
 * Created by PhpStorm.
 * User: Владимир
 * Date: 07.01.2018
 * Time: 22:50
 */

namespace VkBrackets;

use VkBrackets\Exception\BracketsCheckError;

/**
 * @property-read $str: string
 * @property-read $result: boolean
 * @property-read $error: string
*/
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
        $this->str = $str;
    }

    public function check()
    {
        try {
            // Убираем из строки разрешённые символы за исключением скобок
            $str = str_replace([' ', "\n", "\t", "\r"], '', $this->str);
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
                        if ($open_brackets < 0) throw new BracketsCheckError("Incorrect closing braces in position $i");
                        break;
                    default:
                        throw new \InvalidArgumentException("Invalid character at position $i: {$str[$i]}");
                }
            }
            if ($open_brackets != 0) throw new BracketsCheckError("Not closed $open_brackets brackets");
            $this->result = true;
        } catch (BracketsCheckError $e) {
            $this->result = false;
            $this->error = $e->getMessage();
        }
        return $this->result;
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
        throw new \Exception('Unacceptable property '.$name);
    }

}