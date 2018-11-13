<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Customer]].
 *
 * @see Customer
 */
class CustomerQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Customer[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Customer|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function byYear($year) {
        return $this->andWhere('YEAR([[created_at]]) = :year',[':year' => $year]);
    }
    public function byMonth($month) {
        return $this->andWhere('MONTH([[created_at]]) = :month',[':month' => $month]);
    }
    public function byDay($day) {
        return $this->andWhere('DAY([[created_at]]) = :day',[':day' => $day]);
    }

}
