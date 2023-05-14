<?php

class Date
{
    protected $date;

    public function __construct($date = null) //Конструктор
    {
        if ($date == null) {
            $this->date = strtotime("now");
        } else {
            $this->date = strtotime($date);
        }
    }

    public function getDay() //Получить день
    {
        return date('d', $this->date);
    }

    public function getMonth() //Получить месяц
    {
        return date('m', $this->date);
    }

    public function getYear() //Получить год
    {
        return date('Y', $this->date);
    }

    public function addDay($value) //добавить день
    {
        $date = date('Y-m-d', $this->date);
        $this->date = strtotime("$date +$value day");
        return $this;
    }

    public function addMonth($value) //добавить месяц
    {
        $date = date('Y-m-d', $this->date);
        $this->date = strtotime("$date +$value month");
        return $this;
    }

    public function addYear($value) //добавить год
    {
        $date = date('Y-m-d', $this->date);
        $this->date = strtotime("$date +$value years");
        return $this;
    }

    public function subDay($value) //отнять день
    {
        $date = date('Y-m-d', $this->date);
        $this->date = strtotime("$date -$value day");
        return $this;
    }

    public function subMonth($value) //отнять месяц
    {
        $date = date('Y-m-d', $this->date);
        $this->date = strtotime("$date -$value month");
        return $this;
    }

    public function subYear($value) //отнять год
    {
        $date = date('Y-m-d', $this->date);
        $this->date = strtotime("$date -$value years");
        return $this;
    }

    public function getWeekDay($lang = null) // получить день недели
    {
        // возвращает день недели
        if (!$lang) {
            return date('N', $this->date);
        } else if ($lang == 'ru') {
            $days = array(1 => "Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота", "Воскресенье");
            $number_date = date('N', $this->date);
            return $days[$number_date];
        } else {
            return date('l', $this->date);
        }
    }

    public function __toString() //Получить дату магическим методом __toString
    {
        return date('Y-m-d', $this->date);
    }
}

class Interval
{
    private $date1;
    private $date2;

    public function __construct(Date $date1, Date $date2)
    {
        if ($date1 > $date2) {
            $this->date1 = strtotime($date1);
            $this->date2 = strtotime($date2);
        } else {
            $this->date1 = strtotime($date2);
            $this->date2 = strtotime($date1);
        }
    }

    public function toDays()
    {
        $interval = date_diff(date_create(date('Y-m-d', $this->date1)), date_create(date('Y-m-d', $this->date2)));
        return $interval->format('%d days');
        /*
        $toDays = $this->getDates($this->date1, $this->date2);
        return $toDays / 86400 . ' days';*/
    }

    public function toMonths()
    {
        $interval = date_diff(date_create(date('Y-m-d', $this->date1)), date_create(date('Y-m-d', $this->date2)));
        return $interval->format('%m months');
    }

    public function toYears()
    {
        $interval = date_diff(date_create(date('Y-m-d', $this->date1)), date_create(date('Y-m-d', $this->date2)));
        return $interval->format('%Y years');
    }
}


//Пример 1
/*
$date = new Date('2025-12-31');

echo $date->getYear();  // выведет '2025'
echo "<br>";
echo $date->getMonth(); // выведет '12'
echo "<br>";
echo $date->getDay();   // выведет '31'
echo "<br>";

echo $date->getWeekDay();     // выведет '3'
echo "<br>";
echo $date->getWeekDay('ru'); // выведет 'среда'
echo "<br>";
echo $date->getWeekDay('en'); // выведет 'wednesday'
echo "<br>";


echo (new Date('2025-12-31'))->addYear(1); // '2026-12-31'
echo "<br>";
echo (new Date('2025-12-31'))->addDay(1);  // '2026-01-01'
echo "<br>";

echo (new Date('2025-12-31'))->subDay(3)->addYear(1); // '2026-12-28'
*/

//Пример 2
/*
$date1 = new Date('2025-12-31');
$date2 = new Date('2027-11-30');

$interval = new Interval($date1, $date2);
echo $interval->toDays();
echo '<br>';
echo $interval->toMonths();
echo '<br>';
echo $interval->toYears();
echo '<br>';

echo $date1->addDay(30)->addYear(1)->addMonth(10);*/

